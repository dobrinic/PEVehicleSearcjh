<?php

namespace App\Console\Commands;

use App\Imports\VehiclesImport;
use Illuminate\Console\Command;

class ImportVehicles extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'import:vehicles';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Run this command to import vehicles.xlsx in to database';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $this->output->title('Starting import');
       
        (new VehiclesImport)->withOutput($this->output)->import(public_path('data/vehicles.xlsx'));

        $this->output->success('Import successful');
    }
}
