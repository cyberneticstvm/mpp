<?php

namespace App\Console;

use App\Mail\ScheduledPlanUpdateNotificationEmail;
use App\Models\Consultation;
use App\Models\Invoice;
use App\Models\InvoiceDetail;
use App\Models\MppSetting;
use App\Models\Referral;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\DB;

class Kernel extends ConsoleKernel
{
    /**
     * Define the application's command schedule.
     */

    protected function schedule(Schedule $schedule): void
    {
        $schedule->command('snapshot:create ' . time())->hourly();
        $schedule->command('snapshot:cleanup --keep=5')->hourly();

        $schedule->call(function () {
            $this->convertFreeToBasic();
        })->onSuccess(function () {
            $subject = "Scheduled Plan Updation Successfully Completed on " . Carbon::today()->format('d, M Y');
            $body = "Scheduled plan updation successfully completed at " . Carbon::now()->format('d, M Y h:i a');
            Mail::to(mpp()->email)->send(new ScheduledPlanUpdateNotificationEmail($subject, $body));
        })->onFailure(function () {
            $subject = "Scheduled Plan Updation Failed on" . Carbon::today()->format('d, M Y');
            $body = "Scheduled plan updation failed at " . Carbon::now()->format('d, M Y h:i a');
            Mail::to(mpp()->email)->send(new ScheduledPlanUpdateNotificationEmail($subject, $body));
        })->dailyAt('23:30');

        $schedule->call(function () {
            $this->generateInvoiceForBasic();
        })->monthlyOn(1, '00:15');

        $schedule->call(function () {
            $this->generateInvoiceForPremium();
        })->monthlyOn(1, '00:45');
    }

    /**
     * Register the commands for the application.
     */
    protected function commands(): void
    {
        $this->load(__DIR__ . '/Commands');

        require base_path('routes/console.php');
    }

    protected function convertFreeToBasic()
    {
        $users = User::whereDate('plan_expired_at', Carbon::today())->where('plan', 'free')->get();
        foreach ($users as $key => $user) :
            $user->update(['plan' => 'basic']);
        endforeach;
    }

    protected function generateInvoiceForBasic()
    {
        $mpp = MppSetting::findOrFail(1);
        $users = User::where('plan', 'basic')->get();
        $from = Carbon::now()->startOfMonth()->subMonth()->startOfDay();
        $to = Carbon::now()->endOfMonth()->subMonth()->endOfDay();
        foreach ($users as $key => $user) :
            $rcount = Referral::whereBetween('created_at', [$from, $to])->where('referral_code', $user->referral_code)->count();
            $consultations = Consultation::leftJoin('users as u', 'u.id', 'consultations.user_id')->whereBetween('consultations.created_at', [$from, $to])->where('consultations.user_id', $user->id)->whereDate('consultations.created_at', '>', 'u.plan_expired_at')->select('consultations.id')->get();
            $qty = $consultations->count();
            $qty_first = $consultations->take(1000)->count();
            $qty_second = $consultations->skip(1000)->take(4000)->count();
            $qty_third = $consultations->skip(5000)->count();
            $total_first = $qty_first * $mpp->basic_first;
            $total_second = $qty_second * $mpp->basic_second;
            $total_third = $qty_third * $mpp->basic_third;
            $invoice_number = generateInvoiceNumber()->ino;
            DB::transaction(function () use ($invoice_number, $user, $mpp, $qty, $qty_first, $qty_second, $qty_third, $total_first, $total_second, $total_third, $rcount) {
                $redeemed = ($rcount >= (100 / $mpp->referral_percentage)) ? (100 / $mpp->referral_percentage) : $rcount;
                $percentage = $redeemed * $mpp->referral_percentage;
                $amount = $total_first + $total_second + $total_third;
                $invoice = Invoice::create([
                    'invoice_number' => $invoice_number,
                    'user_id' => $user->id,
                    'month' => Carbon::now()->startOfMonth()->subMonth()->month,
                    'year' => Carbon::now()->startOfMonth()->subMonth()->year,
                    'qty' => $qty,
                    'amount' => $amount,
                    'referral_percentage' => $mpp->referral_percentage,
                    'total_referral_count' => $rcount,
                    'redeemed_referral_count' => $redeemed,
                    'redeemed_referral_amount' => ($amount * $percentage) / 100,
                    'balance_amount' => $amount - ($amount * $percentage) / 100,
                    'due_date' => Carbon::now()->addDays(9)->endOfDay(),
                    'payment_status' => 'pending',
                ]);
                InvoiceDetail::create([
                    'invoice_id' => $invoice->id,
                    'user_id' => $user->id,
                    'month' => Carbon::now()->startOfMonth()->subMonth()->month,
                    'year' => Carbon::now()->startOfMonth()->subMonth()->year,
                    'slab' => 'first',
                    'plan' => 'basic',
                    'qty' => $qty_first,
                    'price' => $mpp->basic_first,
                    'total' => $total_first,
                ]);
                InvoiceDetail::create([
                    'invoice_id' => $invoice->id,
                    'user_id' => $user->id,
                    'month' => Carbon::now()->startOfMonth()->subMonth()->month,
                    'year' => Carbon::now()->startOfMonth()->subMonth()->year,
                    'slab' => 'second',
                    'plan' => 'basic',
                    'qty' => $qty_second,
                    'price' => $mpp->basic_second,
                    'total' => $total_second,
                ]);
                InvoiceDetail::create([
                    'invoice_id' => $invoice->id,
                    'user_id' => $user->id,
                    'month' => Carbon::now()->startOfMonth()->subMonth()->month,
                    'year' => Carbon::now()->startOfMonth()->subMonth()->year,
                    'slab' => 'third',
                    'plan' => 'basic',
                    'qty' => $qty_third,
                    'price' => $mpp->basic_third,
                    'total' => $total_third,
                ]);
            });
        endforeach;
    }

    protected function generateInvoiceForPremium()
    {
        $mpp = MppSetting::findOrFail(1);
        $users = User::where('plan', 'premium')->get();
        $from = Carbon::now()->startOfMonth()->subMonth()->startOfDay();
        $to = Carbon::now()->endOfMonth()->subMonth()->endOfDay();
        foreach ($users as $key => $user) :
            $rcount = Referral::whereBetween('created_at', [$from, $to])->where('referral_code', $user->referral_code)->count();
            $consultations = Consultation::leftJoin('users as u', 'u.id', 'consultations.user_id')->whereBetween('consultations.created_at', [$from, $to])->where('consultations.user_id', $user->id)->whereDate('consultations.created_at', '>', 'u.plan_expired_at')->select('consultations.id')->get();
            $qty = $consultations->count();
            $qty_first = $consultations->take(1000)->count();
            $qty_second = $consultations->skip(1000)->take(4000)->count();
            $qty_third = $consultations->skip(5000)->count();
            $total_first = $qty_first * $mpp->premium_first;
            $total_second = $qty_second * $mpp->premium_second;
            $total_third = $qty_third * $mpp->premium_third;
            $invoice_number = generateInvoiceNumber()->ino;
            DB::transaction(function () use ($invoice_number, $user, $mpp, $qty, $qty_first, $qty_second, $qty_third, $total_first, $total_second, $total_third, $rcount) {
                $redeemed = ($rcount >= (100 / $mpp->referral_percentage)) ? (100 / $mpp->referral_percentage) : $rcount;
                $percentage = $redeemed * $mpp->referral_percentage;
                $amount = $total_first + $total_second + $total_third;
                $invoice = Invoice::create([
                    'invoice_number' => $invoice_number,
                    'user_id' => $user->id,
                    'month' => Carbon::now()->startOfMonth()->subMonth()->month,
                    'year' => Carbon::now()->startOfMonth()->subMonth()->year,
                    'qty' => $qty,
                    'amount' => $amount,
                    'referral_percentage' => $mpp->referral_percentage,
                    'total_referral_count' => $rcount,
                    'redeemed_referral_count' => $redeemed,
                    'redeemed_referral_amount' => ($amount * $percentage) / 100,
                    'balance_amount' => $amount - ($amount * $percentage) / 100,
                    'due_date' => Carbon::now()->addDays(9)->endOfDay(),
                    'payment_status' => 'pending',
                ]);
                InvoiceDetail::create([
                    'invoice_id' => $invoice->id,
                    'user_id' => $user->id,
                    'month' => Carbon::now()->startOfMonth()->subMonth()->month,
                    'year' => Carbon::now()->startOfMonth()->subMonth()->year,
                    'slab' => 'first',
                    'plan' => 'premium',
                    'qty' => $qty_first,
                    'price' => $mpp->premium_first,
                    'total' => $total_first,
                ]);
                InvoiceDetail::create([
                    'invoice_id' => $invoice->id,
                    'user_id' => $user->id,
                    'month' => Carbon::now()->startOfMonth()->subMonth()->month,
                    'year' => Carbon::now()->startOfMonth()->subMonth()->year,
                    'slab' => 'second',
                    'plan' => 'premium',
                    'qty' => $qty_second,
                    'price' => $mpp->premium_second,
                    'total' => $total_second,
                ]);
                InvoiceDetail::create([
                    'invoice_id' => $invoice->id,
                    'user_id' => $user->id,
                    'month' => Carbon::now()->startOfMonth()->subMonth()->month,
                    'year' => Carbon::now()->startOfMonth()->subMonth()->year,
                    'slab' => 'third',
                    'plan' => 'premium',
                    'qty' => $qty_third,
                    'price' => $mpp->premium_third,
                    'total' => $total_third,
                ]);
            });
        endforeach;
    }
}
