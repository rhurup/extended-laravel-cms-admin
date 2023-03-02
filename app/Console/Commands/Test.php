<?php

namespace App\Console\Commands;

use Encore\Admin\Auth\Database\Menu;
use Illuminate\Console\Command;

class Test extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'cms:test';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Testing Command';

    /**
     * Execute the console command.
     */
    public function handle(): void
    {
        echo "<pre>";
        var_dump(Menu::all()->toArray());
        echo "</pre>";
    }
}
