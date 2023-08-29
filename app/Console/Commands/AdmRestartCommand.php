<?php

namespace App\Console\Commands;

use App\Models\User;
use Illuminate\Console\Command;

class AdmRestartCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'adm:restart';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle(): void
    {
        $this->call('optimize:clear');

        $this->call('migrate:refresh');
        $this->call('adm:start');

        $this->info("---------------------------- RESTARTED ----------------------------");
    }
}
