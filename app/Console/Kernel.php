<?php

namespace App\Console;

use App\Mail\ScheduledPlanUpdateNotificationEmail;
use App\Models\Consultation;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;
use Illuminate\Support\Facades\Mail;

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
            $subject = "Scheduled Plan Updation Successfully on" . Carbon::today()->format('d, M Y');
            $body = "Scheduled plan updation successfully completed at " . Carbon::today()->format('d, M Y h:i a');
            Mail::to(mpp()->email)->send(new ScheduledPlanUpdateNotificationEmail($subject, $body));
        })->onFailure(function () {
            $subject = "Scheduled Plan Updation Failed on" . Carbon::today()->format('d, M Y');
            $body = "Scheduled plan updation failed at " . Carbon::today()->format('d, M Y h:i a');
            Mail::to(mpp()->email)->send(new ScheduledPlanUpdateNotificationEmail($subject, $body));
        })->everyFiveMinutes();

        /*$schedule->call(function () {
            $this->generateInvoiceForBasic();
        })->monthlyOn(1, '00:15');

        $schedule->call(function () {
            $this->generateInvoiceForPremium();
        })->monthlyOn(1, '00:45');*/
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
        $users = User::where('plan', 'basic')->get();
        foreach ($users as $key => $user) :
            $consultations = Consultation::where('created_at')->where('user_id', $user->id);
        endforeach;
    }

    protected function generateInvoiceForPremium()
    {
        $users = User::where('plan', 'premium')->get();
    }
}
