<?php
use Nicelizhi\Lp\Models\Lp;
it('can check all the checkout page', function () {
    $items = Lp::where("status", 1)->select(['goto_url'])->get();
    foreach ($items as $item) {
        if(empty($item->goto_url)) continue;
        echo $item->goto_url."\r\n";
        $response = $this->get($item->goto_url);
        var_dump($response->status());
        //var_dump($response);
        //$response->assertStatus(200);
        sleep(1);
    }
});