<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Events\TestEvent2;

class PushNotice2 extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'push:notice2';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Push notice to ws.';

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
        broadcast(new TestEvent2());
    }
}
