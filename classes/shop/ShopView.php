<?php

class ShopView extends Template{
    public function __construct( Shop $shop ){
        $this->file = "templates/shop/shop_view.tpl";
        $this->values = [
            "name"          => $shop->getName()
        ];
        $this->values["shop_id"] = $shop->getId();

    }
}