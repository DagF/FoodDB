<?php

class PriceListColumn extends Template{
    public function __construct( $product_id, $product_name, $price ){
        $this->file = "templates/price/price_list_column.tpl";

        $this->values["product_id"] = $product_id;
        $this->values["product_name"] = $product_name;
        $this->values["price"] = $price;
    }
}