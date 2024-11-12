<?php

namespace App\Console\Commands;

use App\Models\Vehicle;
use Carbon\Carbon;
use Illuminate\Console\Command;

class delete_softDeleted_expired extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'vehicles:delete';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Delete soft deleted vehicles and vehicles with expired insurance';

    /**
     * Execute the console command.
     */
    public function handle()
    {

        Vehicle::onlyTrashed()->forceDelete();

        $now = Carbon::now();
        Vehicle::where('insurance_date', '<', $now)->delete();

        $this->info('Expired and soft-deleted vehicles have been deleted.');
    }
}
