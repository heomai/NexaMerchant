<?php
namespace Nicelizhi\OneBuy\Console\Commands\Imports;

use Exception;
use Illuminate\Console\Command;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Redis;
use Maatwebsite\Excel\Facades\Excel;

class ImportProductComments extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'onebuy:import:products:comment {--prod_id=} {--force=}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'import product comment {--prod_id=} {--force=}';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    private $cache_key = "checkout_v1_product_comments_";

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {

        $redis = Redis::connection('default');

        $prod_id = $this->option('prod_id');
        if(empty($prod_id)) {
            $this->error("prod id is empty");
            return false;
        }

        $force = $this->option("force");

        $this->cache_key = $this->cache_key.$prod_id;
        $this->info($this->cache_key);

        //var_dump($this->cache_key);exit;

        if($redis->exists($this->cache_key)) {
            
            if($force==true) {
                $redis->del($this->cache_key);
            }else{
                $this->error($this->cache_key." is online");
                return false;
            }
           
        }

        $prod_comment_file = storage_path("imports/")."comments_".$prod_id.".xlsx";
        if(!file_exists($prod_comment_file)) {
            $this->error("comment file not found, pls check the file".$prod_comment_file);
            return false;
        }

        Excel::import(new \Nicelizhi\OneBuy\Imports\ProdCommentsImport($prod_id), $prod_comment_file);
    }
}