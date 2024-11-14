<?php

namespace App\Console\Commands;

use App\Models\Matches;
use Carbon\Carbon;
use Illuminate\Console\Command;

class AddRandomMatchResults extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'matches:add-random-match-results';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Add random results for matches that are played in the last 24 hours';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        //

        $matches = Matches::whereIn('date', [
            Carbon::now()->format('Y-m-d'),           // this is today's date
            Carbon::now()->subDay()->format('Y-m-d')  // this is yesterday's date
        ])
            ->whereNull('result')
            ->get();

        foreach ($matches as $match) {
            //random result: '3-1', '1-1', ...
            $randomResult = rand(0, 5) . '-' . rand(0, 5);
            $match->result = $randomResult;
            $match->save();
        }

        $this->info('Random match results have been added');
    }
}
