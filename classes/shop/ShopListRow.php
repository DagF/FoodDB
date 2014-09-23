<?php

class ShopListRow extends Template{
    public function __construct( Shop $shop ){
        $this->file = "templates/shop/shop_list_row.tpl";

        $this->values = [
            "navn" => $shop->getName(),
            "shop_id" => $shop->getId()
        ];
    }
}