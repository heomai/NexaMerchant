<?php
namespace Nicelizhi\OneBuy\Console\Commands\Imports;

use Exception;
use Illuminate\Console\Command;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\Log;

class ImportProductComments extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'onebuy:import:products:comment {--prod_id=}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'import product comment {--prod_id=}';

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
        $prod_id = $this->option('prod_id');
        if(empty($prod_id)) {
            $this->error("prod id is empty");
            return false;
        }
    }
}