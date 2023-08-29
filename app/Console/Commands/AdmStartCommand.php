<?php

namespace app\Console\Commands;

use App\Models\User;
use Illuminate\Console\Command;

class AdmStartCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'adm:start';

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
        $this->call('key:generate');
        $this->call('migrate:refresh');
        $this->call('migrate');
        $this->info("-- migrations done");
        $this->call('optimize:clear');

        $user = User::query()->where('email', 'admin@admin.com')->first();

        if(!$user) {
            $this->call('cache:clear');
            $this->call('db:seed');
            $this->info("-- data added to db");
        }

        $this->call('storage:link');
        $this->call('optimize:clear');
    }
}
