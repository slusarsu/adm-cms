<?php

namespace App\Console\Commands;

use App\Models\Category;
use App\Models\Post;
use App\Models\Tag;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Artisan;

class AdmDemoRemoveCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'adm:demo-remove';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Adding demo data';

    /**
     * Execute the console command.
     */
    public function handle(): void
    {
        $this->call('migrate');
        $this->info("-- migrations done");
        $this->call('optimize:clear');

        $this->call('cache:clear');
        Post::query()->where('type', 'demo')->forceDelete();
        Category::query()->where('type', 'demo')->forceDelete();
        Tag::query()->where('type', 'demo')->forceDelete();
        $this->info("-- data added to db");
        $this->call('optimize:clear');
    }
}
