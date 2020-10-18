<?php

namespace App\Console\Commands;

use App\Imports\PartsImport;
use Illuminate\Console\Command;

class ImportParts extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'import:parts';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Run this command to import parts.csv in to database';

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

        (new PartsImport)->withOutput($this->output)->import(public_path('data/parts.csv'));

        $this->output->success('Import successful');
    }
}
