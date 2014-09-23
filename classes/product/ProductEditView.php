<?php

class ProductEditView extends Template{
    public function __construct( Product $product, $new ){
        $this->file = "templates/product/product_edit.tpl";
        $this->values = [
            "name"          => $product->getName(),
            "kilojoule"     => $product->getKilojoule(),
            "kilokalorier"  => $product->getKilokalorier(),
            "fett"          => $product->getFett(),
            "karbohydrater" => $product->getKarbohydrater(),
            "protein"       => $product->getProtein(),
            "salt"          => $product->getSalt(),
            "g_per_piece"   => $product->getGPerPiece()
        ];
        if( isset( $new ) and $new === true ){
            $this->values["action"] = "Legg til";
            $this->values["product_id"] = "";
            $this->values["delete"] = "";
        }
        else{
            $this->values["action"] = "Oppdater";
            $this->values["product_id"] ="&id=" . $product->getId();
            $this->values["delete"] = '<input type="submit" name="action" value="delete">';
        }
    }
}
