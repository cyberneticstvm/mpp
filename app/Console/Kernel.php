<?php

namespace App\Console;

use App\Mail\ScheduledInvoiceGeneration;
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
        })->onSuccess(function () {
            $subject = "Scheduled Invoice Generation for Basic Plan Successfully Completed on " . Carbon::today()->format('d, M Y');
            $body = "Scheduled Invoice Generation for Basic Plan successfully completed at " . Carbon::now()->format('d, M Y h:i a');
            Mail::to(mpp()->email)->send(new ScheduledInvoiceGeneration($subject, $body));
        })->onFailure(function () {
            $subject = "Scheduled Invoice Generation for Basic Plan Failed on " . Carbon::today()->format('d, M Y');
            $body = "Scheduled Invoice Generation for Basic Plan Failed at " . Carbon::now()->format('d, M Y h:i a');
            Mail::to(mpp()->email)->send(new ScheduledInvoiceGeneration($subject, $body));
        })->monthlyOn(1, '00:15');

        $schedule->call(function () {
            $this->generateInvoiceForPremium();
        })->onSuccess(function () {
            $subject = "Scheduled Invoice Generation for Premium Plan Successfully Completed on " . Carbon::today()->format('d, M Y');
            $body = "Scheduled Invoice Generation for Premium Plan successfully completed at " . Carbon::now()->format('d, M Y h:i a');
            Mail::to(mpp()->email)->send(new ScheduledInvoiceGeneration($subject, $body));
        })->onFailure(function () {
            $subject = "Scheduled Invoice Generation for Premium Plan Failed on " . Carbon::today()->format('d, M Y');
            $body = "Scheduled Invoice Generation for Premium Plan Failed at " . Carbon::now()->format('d, M Y h:i a');
            Mail::to(mpp()->email)->send(new ScheduledInvoiceGeneration($subject, $body));
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
            $invoice_number = generateInvoiceNumber()->ino;
            $redeemed = ($rcount >= (100 / $mpp->referral_percentage)) ? (100 / $mpp->referral_percentage) : $rcount;
            $percentage = $redeemed * $mpp->referral_percentage;
            $consultation = Consultation::where('user_id', $user->id)->whereBetween('created_at', [$from, $to]);
            $amount = $consultation->sum('mpp_cost');
            Invoice::create([
                'invoice_number' => $invoice_number,
                'user_id' => $user->id,
                'month' => Carbon::now()->startOfMonth()->subMonth()->month,
                'year' => Carbon::now()->startOfMonth()->subMonth()->year,
                'qty' => $consultation->count(),
                'amount' => $amount,
                'referral_percentage' => $mpp->referral_percentage,
                'total_referral_count' => $rcount,
                'redeemed_referral_count' => $redeemed,
                'redeemed_referral_amount' => ($amount * $percentage) / 100,
                'balance_amount' => $amount - ($amount * $percentage) / 100,
                'due_date' => Carbon::now()->addDays(9)->endOfDay(),
                'payment_status' => 'pending',
                'plan' => $user->plan,
            ]);
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
            $invoice_number = generateInvoiceNumber()->ino;
            $redeemed = ($rcount >= (100 / $mpp->referral_percentage)) ? (100 / $mpp->referral_percentage) : $rcount;
            $percentage = $redeemed * $mpp->referral_percentage;
            $consultation = Consultation::where('user_id', $user->id)->whereBetween('created_at', [$from, $to]);
            $amount = $consultation->sum('mpp_cost');
            Invoice::create([
                'invoice_number' => $invoice_number,
                'user_id' => $user->id,
                'month' => Carbon::now()->startOfMonth()->subMonth()->month,
                'year' => Carbon::now()->startOfMonth()->subMonth()->year,
                'qty' => $consultation->count(),
                'amount' => $amount,
                'referral_percentage' => $mpp->referral_percentage,
                'total_referral_count' => $rcount,
                'redeemed_referral_count' => $redeemed,
                'redeemed_referral_amount' => ($amount * $percentage) / 100,
                'balance_amount' => $amount - ($amount * $percentage) / 100,
                'due_date' => Carbon::now()->addDays(9)->endOfDay(),
                'payment_status' => 'pending',
                'plan' => $user->plan,
            ]);
        endforeach;
    }
}
