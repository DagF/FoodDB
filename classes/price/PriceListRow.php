<?php

class PriceListRow extends Template{
    public function __construct( $product_id, $product_name, $product_prices ){
        $this->file = "templates/price/price_list_row.tpl";

        $price_columns = "";

        foreach( $product_prices as $product_price ){
            $price_column = new PriceColumn( $product_price );
            $price_columns .= $price_column->output();
        }


        $this->values["price_columns"] = $price_columns;
        $this->values["product_id"] = $product_id;
        $this->values["product_id"] = $product_name;
    }
}