<?php
class ProductListView extends Template{
    public function __construct( $products ){
        $this->file = "templates/product/product_list.tpl";
        $product_list = "";
        foreach( $products as $product ){
            $p = new ProductListRow( $product );
            $product_list .= $p->output();
        }
        $this->values["product_list"] = $product_list;
    }
}