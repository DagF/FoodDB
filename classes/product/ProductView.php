<?php

class ProductView extends Template{
    public function __construct( Product $product ){
        $this->file = "templates/product/product_view.tpl";
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
        $this->values["product_id"] = $product->getId();

    }
}