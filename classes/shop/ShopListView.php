<?php
class ShopListView extends Template{
    public function __construct( $shops ){
        $this->file = "templates/shop/shop_list.tpl";
        $shop_list = "";
        foreach( $shops as $shop ){
            $p = new ShopListRow( $shop );
            $shop_list .= $p->output();
        }
        $this->values["shop_list"] = $shop_list;
    }
}