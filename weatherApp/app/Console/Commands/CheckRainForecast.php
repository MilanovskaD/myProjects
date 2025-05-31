<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Mail\RainAlertMail;
use App\Models\Subscription;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Support\Facades\Http as HttpClient;
use Illuminate\Support\Facades\Mail;

class CheckRainForecast extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:check-rain-forecast';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'app:check-rain-forecast';
    protected function schedule(Schedule $schedule): void
    {
        $schedule->command('app:check-rain-forecast')->hourly();
    }

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $subs = \App\Models\Subscription::all();

        foreach ($subs as $sub) {
            $response = HttpClient::get('https://api.openweathermap.org/data/2.5/forecast', [
                'q' => $sub->city,
                'appid' => config('services.openweather.key'),
                'units' => 'metric'
            ]);

            if ($response->failed()) continue;

            $data = $response->json();

            // Look for rain in upcoming 9 hours
            $rainComing = collect($data['list'])->take(3)->contains(fn ($item) =>
            str_contains(strtolower($item['weather'][0]['main']), 'rain')
            );

            if ($rainComing) {
                Mail::to($sub->email)->send(new \App\Mail\RainAlertMail($sub->city));
            }
        }
        $this->info("✔ Rain forecast check complete.");

    }
}
