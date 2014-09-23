<?php

class ShopEditView extends Template{
    public function __construct( Shop $shop, $new ){
        $this->file = "templates/shop/shop_edit.tpl";
        $this->values = [
            "name"          => $shop->getName()
        ];
        if( isset( $new ) and $new === true ){
            $this->values["action"] = "Legg til";
            $this->values["shop_id"] = "";
            $this->values["delete"] = "";
        }
        else{
            $this->values["action"] = "Oppdater";
            $this->values["shop_id"] ="&id=" . $shop->getId();
            $this->values["delete"] = '<input type="submit" name="action" value="delete">';
        }
    }
}
