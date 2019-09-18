<?php

namespace App\Console\Commands;

use App\Models\User;
use Illuminate\Console\Command;

class DeleteBots extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'delete:bots {count=10}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Delete bots';

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
     * @return mixed
     */
    public function handle()
    {
        User::where('role', User::ROLE_BOT)->orderBy('id','desc')->limit(intval($this->argument('count')))->delete();
    }
}
