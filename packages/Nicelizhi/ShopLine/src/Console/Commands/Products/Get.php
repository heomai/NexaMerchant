<?php

namespace Nicelizhi\ShopLine\Console\Commands\Products;

use Illuminate\Console\Command;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\Log;
use Webkul\Attribute\Repositories\AttributeFamilyRepository;
use Webkul\Inventory\Repositories\InventorySourceRepository;
use Webkul\Product\Repositories\ProductRepository;
use Webkul\Product\Repositories\ProductAttributeValueRepository;
use Webkul\Product\Repositories\ProductDownloadableLinkRepository;
use Webkul\Product\Repositories\ProductDownloadableSampleRepository;
use Webkul\Product\Repositories\ProductInventoryRepository;
use Webkul\Attribute\Models\AttributeOption;
use Webkul\Attribute\Models\AttributeOptionTranslation;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\Facades\Storage;
use Webkul\Product\Models\ProductImage;
use Nicelizhi\ShopLine\Models\ShoplineStore;

class Get extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'shopline:product:get';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Get Products List';

    private $store_id = "";

    private $category_id = 0;

    private $lang = "en";

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct(
        protected AttributeFamilyRepository $attributeFamilyRepository,
        protected InventorySourceRepository $inventorySourceRepository,
        protected ProductRepository $productRepository,
        protected ShoplineStore $ShoplineStore,
    )
    {
        $this->store_id = "hatme";
        $this->lang = "en";
        $this->category_id = 9;
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        
        $pro_id = "16063129577034182883153770";

        $client = new Client();

        $Store = $this->ShoplineStore->where('store_id', $this->store_id)->first();

        if(is_null($Store)) {
            $this->error("no store");
            return false;
        }

        $ShoplineStore = $Store->toArray();


        

        /**
         * 
         * @link https://developer.shopline.com/docsv2/ec20/cdb180dc069f7d8d6877c0cdffe96f73/P0FAlOwy?version=v20240601
         * 
         */
        $created_at_min = date("Y-m-d")."T00:00:00-00:00";
        $response = $client->get($ShoplineStore['app_host_name'].'/admin/openapi/v20240601/products/products.json?ids='.$pro_id.'&limit=1', [
            'headers' => [
                'Content-Type' => 'application/json',
                'Accept' => 'application/json',
                'Authorization' => "Bearer ".$ShoplineStore['admin_access_token'],
            ]
        ]);

        $body = json_decode($response->getBody(), true);

        $body = $response->getBody();
        $body = json_decode($body, true);
        foreach($body['products'] as $key=>$item) {
            $Product = \Nicelizhi\ShopLine\Models\ShoplineProduct::where("product_id", $item['id'])->first();
            if(is_null($Product)) {
                $Product = new \Nicelizhi\ShopLine\Models\ShoplineProduct();
                $item['product_id'] = $item['id'];
                unset($item['id']);
                $item['store_id'] = $this->store_id;
                $item['body_html'] = $item['body_html'];
                $item['title'] = $item['title'];
                $item['variants'] = $item['variants'];
                $item['options'] = $item['options'];
                $item['images'] = $item['images'];
                $item['image'] = $item['image'];
                $Product::create($item);
            }else{
                //$shopifyProduct::where("product_id", $item['id'])->update($item);
            }
        }

        
        $this->syncProductToLocal($pro_id);

        // 处理目录权限
        $this->Permissions();

    }

    protected function Permissions() {
        $local_image_path = "storage/product/";
        $path = public_path($local_image_path);
        $execPath = "chown www:www ". $path."* -R";   
        $this->error($execPath);
        //exit;     
        exec($execPath);
    }

    private $locales = [
        'en',
        'fr',
        'nl',
        'tr',
        'es',
        'de',
        'it',
        'ru',
        'uk'
    ];

    /**
     * 
     * sync product to local product
     * 
     */
    public function syncProductToLocal($pro_id) {
        $items = \Nicelizhi\Shopline\Models\ShoplineProduct::where("store_id", $this->store_id)->where("product_id", $pro_id)->get();
        foreach($items as $key=>$item) {
            // if($item['product_id']!='8126562107640') continue;

            $this->info($item['product_id']);

            //var_dump($item->options);exit;

            // 23 color
            // 24 size
            // ba_attribute_options
            // ba_attribute_option_translations
            $options = $item->options;
            $shopifyVariants = $item->variants;
            $shopifyImages = $item->images;
            $color = [];
            $size = [];
            $error = 0;
            foreach($options as $kk => $option) {
                $attr_id = 0;
                if(strpos($option['name'], "Size")!==false) $attr_id = 24;
                if(strpos($option['name'], "GRÖSSE")!==false) $attr_id = 24;
                if(strpos($option['name'], "尺码") !==false) $attr_id = 24;
                if(strpos($option['name'], "Length") !==false) $attr_id = 24;
                if(strpos($option['name'], "Color") !==false) $attr_id = 23;
                if(strpos($option['name'], "颜色") !==false) $attr_id = 23;
                if(strpos($option['name'], "FARBE") !==false) $attr_id = 23;
                //var_dump($option['name'], $attr_id); exit;
                //if($option['position']==2) $attr_id = 24;
                if(empty($attr_id)) {
                    $this->error(json_encode($item));
                    Log::info(json_encode($item));
                    $error = 1;
                    continue;
                    //exit;
                }
                $this->info("attr id ". $attr_id);

                $values = $option['values'];
                foreach($values as $kky => $value) {
                    $this->info($value);
                    if($value==35 && $attr_id==23) {
                        var_dump($item);exit;
                    }
                    //ba_attribute_options
                    $attr_option = AttributeOption::where("attribute_id", $attr_id)->where("admin_name", $value)->first();
                    if(is_null($attr_option)) {
                        $attr_option = new AttributeOption();
                        $attr_option->attribute_id = $attr_id;
                        $attr_option->admin_name = $value;
                        $attr_option->save();
                        $attribute_option_id = $attr_option->id;
                    }else{
                        $attribute_option_id = $attr_option->id;
                    }

                    //var_dump($attr_opt_tran);exit;
                    foreach($this->locales as $kl => $locale) {
                        $attr_opt_tran = AttributeOptionTranslation::where("attribute_option_id", $attribute_option_id)->where("locale", $locale)->first();
                        if(is_null($attr_opt_tran)) {
                            $attr_opt_tran = new AttributeOptionTranslation();
                            if($locale==$this->lang) {
                                $attr_opt_tran->label = $value;
                            } else{
                                $attr_opt_tran->label = "";
                            }
                            $attr_opt_tran->locale = $locale;
                            $attr_opt_tran->attribute_option_id = $attribute_option_id;
                            $attr_opt_tran->save();
                        }
                    }
                    if($attr_id==23) $color[$attribute_option_id] = $attribute_option_id; //array_push($color, $attribute_option_id); 
                    if($attr_id==24) $size[$attribute_option_id] = $attribute_option_id;
                }
            }

            if($error==1) continue;


            
            // add product

            $data = [];
            $data['attribute_family_id'] = 1;
            $data['sku'] = $item['product_id'];
            $data['type'] = "configurable";
            $super_attributes['color'] = $color;
            $super_attributes['size'] = $size;
            $data['super_attributes'] = $super_attributes;
            //$data['family'] = [];

            //var_dump($data);exit;
            Event::dispatch('catalog.product.create.before');

            // check product info
            $product = $this->productRepository->where("sku", $item['product_id'])->first();
            if(is_null($product)) {
                $product = $this->productRepository->create($data);
                $id = $product->id;
            }else{
                $id = $product->id;
            }
            Event::dispatch('catalog.product.create.after', $product);

            $updateData = [];
            $updateData['product_number'] = 1000;
            $updateData['name'] = $item['title'];
            $updateData['url_key'] = $item['product_id'];
            $updateData['short_description'] = $item['title'];
            $updateData['description'] = $item['title'];
            $updateData['new'] = 1;
            $updateData['featured'] = 1;
            $updateData['visible_individually'] = 1;
            $updateData['status'] = 1;
            $updateData['guest_checkout'] = 1;
            $updateData['channel'] = "default";
            $updateData['locale'] = $this->lang;
            $categories[] = $this->category_id;
            $updateData['categories'] = $categories;

            $updateData['description'] = $item['body_html'];

            $updateData['compare_at_price'] = $item['compare_at_price'];

            $variants = $variantCollection = $product->variants()->get()->toArray();

            //var_dump(count($shopifyVariants));

            $newShopifyVarants = [];
            foreach($shopifyVariants as $sv => $shopifyVariant) {
                //var_dump($shopifyVariant);
                $newkey = $shopifyVariant['product_id'];
                $color = AttributeOption::where("attribute_id", 23)->where("admin_name", $shopifyVariant['option1'])->first();
                $size = AttributeOption::where("attribute_id", 24)->where("admin_name", $shopifyVariant['option2'])->first();

                if(is_null($color) || is_null($size)) {
                    $this->info("error");
                    var_dump($color, $size, $shopifyVariant);
                    exit;
                }

                $newkey .="_".$color->id."_".$size->id;

                $newShopifyVarant = [];

                $newShopifyVarant['id'] = $shopifyVariant['id'];
                $newShopifyVarant['price'] = $shopifyVariant['price'];
                $newShopifyVarant['title'] = $shopifyVariant['title'];
                $newShopifyVarant['weight'] = $shopifyVariant['weight'];
                $newShopifyVarant['sku'] = $shopifyVariant['sku'];
                $newShopifyVarant['option1'] = $shopifyVariant['option1'];
                $newShopifyVarant['option2'] = $shopifyVariant['option2'];
                $newShopifyVarants[$newkey] = $newShopifyVarant;
            }

            //var_dump($newShopifyVarants);exit;

            /**
             * 
             * variants[440][sku]: 8007538966776-variant-1375-1376
             * variants[440][name]: Variant 1375 1376
             * variants[440][price]: 0.0000
             * variants[440][weight]: 0
             * variants[440][status]: 1
             * variants[440][color]: 1375
             * variants[440][size]: 1376
             * variants[440][inventories][1]: 0
             * 
             * 
             */
            $newVariants = [];
            foreach($variants as $k => $variant) {
                //Log::info(json_encode($variant));
                //var_dump($variant);
                $newkey = $item['product_id']."_".$variant['color']."_".$variant['size'];
                if($variant['size']=='1403') {
                    //var_dump($variant);exit;
                }
                $this->info($newkey);
                if(!isset($newShopifyVarants[$newkey])) continue;
                //var_dump($newkey);exit;
                $newVariant['sku'] = $item['product_id'].'-'.$newShopifyVarants[$newkey]['id'];
                $newVariant['name'] = $newShopifyVarants[$newkey]['title'];
                $newVariant['price'] = $newShopifyVarants[$newkey]['price'];
                $newVariant['weight'] = $newShopifyVarants[$newkey]['weight'];
                $newVariant['status'] = 1;
                $newVariant['color'] = $variant['color'];
                $newVariant['size'] = $variant['size'];
                $newVariant['inventories'][1] = 1000;
                $categories[] = 5;
                $newVariant['categories'] = $categories;
                $newVariant['guest_checkout'] = 1;
                $newVariant['compare_at_price'] = $item['compare_at_price'];
                $newVariants[$variant['id']] = $newVariant;
            }

            //var_dump(count($newVariants));exit;

            $updateData['variants'] = $newVariants;

            // images
            /**
             * 
             * 
             * 
             * images[files][32]: 
             * images[files][]: （二进制）
             * 
             * 
             */

             $arrContextOptions=array(
                "ssl"=>array(
                      "verify_peer"=>false,
                      "verify_peer_name"=>false,
                  ),
              ); 
            $images = [];
            foreach($shopifyImages as $key=>$shopifyImage) {

                //var_dump($shopifyImage);
                $info = pathinfo($shopifyImage['src']);

                //var_dump($shopifyImage);

                $this->info($info['filename']);

               
                //var_dump($info);exit;
                $image_path = "product/".$id."/".$info['filename'].".webp";
                $local_image_path = "storage/".$image_path;
                $this->info(public_path($local_image_path));
                if(!file_exists(public_path($local_image_path))) {
                    $this->error("copy [ ".$local_image_path);
                    $this->info($shopifyImage['src']);
                    //var_dump($shopifyImage['src'],"hello");
                    $contents = file_get_contents($shopifyImage['src'], false, stream_context_create($arrContextOptions));
                    //var_dump($contents);
                    Storage::disk("images")->put($local_image_path, $contents);
                    sleep(1);
                    //exit;
                    //var_dump($local_image_path);exit;
                }
                $images[] = $image_path;
            }

            $product = $this->productRepository->update($updateData, $id);

            Event::dispatch('catalog.product.update.after', $product);

            foreach($shopifyImages as $key=>$shopifyImage) {

                //var_dump($shopifyImage);
                $info = pathinfo($shopifyImage['src']);

                //var_dump($shopifyImage);

                $this->info($info['filename']);

                $image_path = "product/".$id."/".$info['filename'].".webp";
                $local_image_path = "storage/".$image_path;
                $this->info(public_path($local_image_path));
                if(!file_exists(public_path($local_image_path))) {
                    $this->error("copy [ ".$local_image_path);
                    $this->info($shopifyImage['src']);
                    $contents = file_get_contents($shopifyImage['src'], false, stream_context_create($arrContextOptions));
                    Storage::disk("images")->put($local_image_path, $contents);
                    sleep(1);
                }
                $images[] = $image_path;
            }

            foreach($images as $key=>$image) {
                $checkImg = ProductImage::where("product_id", $id)->where("path", $image)->first();
                if(is_null($checkImg)) {
                    $checkImg = new ProductImage();
                    $checkImg->product_id = $id;
                    $checkImg->path = $image;
                    $checkImg->type = "images";
                    $checkImg->save();
                }
            }

            //更新对应的分类
            $sku_products = $this->productRepository->where("parent_id", $id)->get();
            foreach($sku_products as $key=>$sku) {

                $this->info("process ".$sku->id);

                Event::dispatch('catalog.product.create.after', $sku);

                $updateData = [];

                $updateData['new'] = 1;
                $updateData['featured'] = 1;
                $updateData['visible_individually'] = 1;
                $updateData['status'] = 1;
                $updateData['guest_checkout'] = 1;
                $updateData['channel'] = "default";
                $updateData['locale'] = $this->lang;
                $categories[] = $this->category_id;
                $updateData['categories'] = $categories;

                $this->productRepository->update($updateData, $sku->id);

                Event::dispatch('catalog.product.update.after', $sku);

                $images = [];
                foreach($shopifyImages as $key=>$shopifyImage) {

                    //var_dump($shopifyImage);
                    $info = pathinfo($shopifyImage['src']);
    
                    //var_dump($shopifyImage);
    
                    $this->info($info['filename']);
    
                    $image_path = "product/".$sku->id."/".$info['filename'].".webp";
                    $local_image_path = "storage/".$image_path;
                    $this->info(public_path($local_image_path));
                    if(!file_exists(public_path($local_image_path))) {
                        $this->error("copy [ ".$local_image_path);
                        $this->info($shopifyImage['src']);
                        $contents = file_get_contents($shopifyImage['src'], false, stream_context_create($arrContextOptions));
                        Storage::disk("images")->put($local_image_path, $contents);
                        sleep(1);
                    }
                    $images[] = $image_path;
                }
    
                foreach($images as $key=>$image) {
                    $checkImg = ProductImage::where("product_id", $sku->id)->where("path", $image)->first();
                    if(is_null($checkImg)) {
                        $checkImg = new ProductImage();
                        $checkImg->product_id = $sku->id;
                        $checkImg->path = $image;
                        $checkImg->type = "images";
                        $checkImg->save();
                    }
                }
            }


            // exit;


            sleep(1);
            //var_dump($product);exit;
            

            //var_dump($product);exit;

            // add product_attr


            // add product_images
            // add product_sku



        }
    }
}
