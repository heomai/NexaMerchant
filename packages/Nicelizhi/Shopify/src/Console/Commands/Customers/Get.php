<?php

namespace Nicelizhi\Shopify\Console\Commands\Customers;

use Illuminate\Console\Command;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\Log;

use Webkul\Sales\Repositories\OrderRepository;
use Webkul\Sales\Repositories\OrderCommentRepository;
use Webkul\Sales\Repositories\ShipmentRepository;
use Webkul\Sales\Repositories\OrderItemRepository;
use Illuminate\Support\Facades\Cache;


use Nicelizhi\Shopify\Models\ShopifyOrder;
use Nicelizhi\Shopify\Models\ShopifyStore;
use GuzzleHttp\Exception\ClientException;

class Get extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'shopify:customers:get {--shopify_store_id=} {--force=} {--ids=}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Get Customers List';

    private $lang = null;
    private $shopify_store_id = null;

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct(
        protected OrderRepository $orderRepository,
        protected ShopifyOrder $ShopifyOrder,
        protected ShopifyStore $ShopifyStore,
        protected ShipmentRepository $shipmentRepository,
        protected OrderItemRepository $orderItemRepository,
        protected OrderCommentRepository $orderCommentRepository
    )
    {
        $this->shopify_store_id = config('shopify.shopify_store_id');
        $this->lang = config('shopify.store_lang');
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $shopifyStore = Cache::get("shopify_store_".$this->shopify_store_id);

        if(empty($shopifyStore)){
            $shopifyStore = $this->ShopifyStore->where('shopify_store_id', $this->shopify_store_id)->first();
            Cache::put("shopify_store_".$this->shopify_store_id, $shopifyStore, 3600);
        }
        if(is_null($shopifyStore)) {
            $this->error("no store");
            return false;
        }
        $shopify = $shopifyStore->toArray();

        $client = new Client();

        $force = $this->option('force');

        if($force==true) {
            Cache::put("shopify_day", 1);
        }

        // $created_at_min = date("c", strtotime("-3 days"));
        // $created_at_max = date("c");

        $day = Cache::get("shopify_day");

        if(empty($day)) $day = 0;

        $day = $day + 1;

        $start = $day - 1;
        $end = $day - 2;


        $created_at_min = date("c", strtotime("-".$start." days"));
        $created_at_max = date("c", strtotime("-".$end." days"));

        $created_at_min = date("c", strtotime("-3 days"));
        $created_at_max = date("c");

        $this->info("processed at min ". $created_at_min);
        $this->info("processed at max ". $created_at_max);
        //exit;

        


        // @https://shopify.dev/docs/api/admin-rest/2023-10/resources/customer#get-customers?ids=207119551,1073339482
        $base_url = $shopify['shopify_app_host_name'].'/admin/api/2023-10/customers.json?created_at_min='.$created_at_min.'&created_at_max='.$created_at_max.'&limit=250';
        //$base_url = $shopify['shopify_app_host_name'].'/admin/api/2023-10/customers.json?limit=2&ids=7927054762214'; // for test
        $this->error("base url ". $base_url);
        $response = $client->get($base_url, [
            'headers' => [
                'Content-Type' => 'application/json',
                'Accept' => 'application/json',
                'X-Shopify-Access-Token' => $shopify['shopify_admin_access_token'],
            ]
        ]);

        $body = $response->getBody();
        $body = json_decode($body, true);
        $i = 1;
        foreach($body['customers'] as $customer) {
            $this->error($i."---");

            $i++;
            //var_dump($customer);
            $this->info($customer['id']." start");
            if(!isset($customer['email_marketing_consent']['state'])) continue; //when user don't use email
            if($customer['email_marketing_consent']['state'] == "not_subscribed") { //
                $this->error($customer['email']);


                $cusPut = [];
                $email_marketing_consent['state'] = "subscribed";
                $email_marketing_consent['opt_in_level'] = "confirmed_opt_in";
                $email_marketing_consent['consent_updated_at'] = date("c");
                $cusPut['customer']['email_marketing_consent'] = $email_marketing_consent;
                $base_url = $shopify['shopify_app_host_name'].'/admin/api/2023-10/customers/'.$customer['id'].'.json';
                $this->info($base_url);

                //var_dump($cusPut);exit;

                try {
                    $response = $client->put($base_url, [
                        'http_errors' => true,
                        'headers' => [
                            'Content-Type' => 'application/json',
                            'Accept' => 'application/json',
                            'X-Shopify-Access-Token' => $shopify['shopify_admin_access_token'],
                        ],
                        'body' => json_encode($cusPut)
                    ]);

                    //var_dump($response->getBody(), $cusPut);

                }catch(ClientException $e) {
                    //var_dump($e);
                    //var_dump($e->getMessage());exit;
                    Log::error(json_encode($e->getMessage()));
                    \Nicelizhi\Shopify\Helpers\Utils::send($e->getMessage().'--' .$id. " 需要手动解决 ");
                    //continue;
                    return false;
                }



                sleep(1);
            }


            $cus = \Nicelizhi\Shopify\Models\ShopifyCustomer::where("email", $customer['email'])->first();
            if(is_null($cus)) $cus = new \Nicelizhi\Shopify\Models\ShopifyCustomer();
            $cus->email = $customer['email'];
            $cus->cus_id = $customer['id'];
            $cus->created_at = $customer['created_at'];
            $cus->updated_at = $customer['updated_at'];
            $cus->first_name = isset($customer['first_name']) ? $customer['first_name'] : "";
            $cus->last_name = isset($customer['last_name']) ? $customer['last_name'] : "";
            $cus->orders_count = $customer['orders_count'];
            $cus->state = $customer['state'];
            $cus->total_spent = $customer['total_spent'];
            $cus->last_order_id = isset($customer['last_order_id']) ? $customer['last_order_id'] : "";
            $cus->note = $customer['note'];
            $cus->verified_email = $customer['verified_email'];
            $cus->multipass_identifier = $customer['multipass_identifier'];
            $cus->tax_exempt = $customer['tax_exempt'];
            $cus->tags = $customer['tags'];
            $cus->currency = $customer['currency'];
            $cus->phone = isset($customer['phone']) ? $customer['phone'] : "" ;
            $cus->addresses = $customer['addresses'];
            $cus->accepts_marketing = $customer['accepts_marketing'];
            $cus->accepts_marketing_updated_at = isset($customer['accepts_marketing_updated_at']) ? $customer['accepts_marketing_updated_at'] : "";
            $cus->marketing_opt_in_level = $customer['marketing_opt_in_level'];
            $cus->tax_exemptions = $customer['tax_exemptions'];
            $cus->email_marketing_consent = $customer['email_marketing_consent'];
            $cus->sms_marketing_consent = isset($customer['sms_marketing_consent']) ? $customer['sms_marketing_consent'] : [];
            $cus->admin_graphql_api_id = $customer['admin_graphql_api_id'];
            $cus->default_address = isset($customer['default_address']) ? $customer['default_address'] : [] ;
            $cus->save();


        }

        Cache::put("shopify_day", $day);

    }
}