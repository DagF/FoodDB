<?php

class PriceEditView extends Template{
    public function __construct( $price_list, $shop_list ){
        $this->file = "templates/price/price_edit.tpl";

        $this->values = [
            "product_list" => $price_list,
            "shop_list" => $shop_list
        ];
    }
}
