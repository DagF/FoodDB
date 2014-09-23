<?php

class ProductListRow extends Template{
    public function __construct( Product $product ){
        $this->file = "templates/product/product_list_row.tpl";

        $this->values = [
            "navn" => $product->getName(),
            "kilojoule" => $product->getKilojoule(),
            "kilokalorier" => $product->getKilokalorier(),
            "fett" => $product->getFett(),
            "karbohydrater" => $product->getKilokalorier(),
            "protein" => $product->getProtein(),
            "salt" => $product->getSalt(),
            "gram_per" => $product->getGPerPiece(),
            "product_id" => $product->getId()
        ];
    }
}