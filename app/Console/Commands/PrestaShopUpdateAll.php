<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class PrestaShopUpdateAll extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'prestashop:update-all';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Update DB from Prestashop';

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
        // app()->call('App\Http\Controllers\PrestashopDataController@prestashopUpdateAll');
        $this->info(app()->call('App\Http\Controllers\PrestashopDataController@updateDataFromPrestashop'));
    }
}
