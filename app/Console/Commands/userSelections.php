<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class userSelections extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'users:userSelections';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'If user s  picks are not in and registered that week then they will receive LOSTS or L that will register on their account  ';

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
        return 0;

    }
}
