<?php
class PriceListView extends Template{
    public function __construct( $shops ){
        $this->file = "templates/price/price_list.tpl";

        $price_list_header = "<th>Product</th>";

        $database = Database::Instance();

        foreach( $shops as $shop ){
            $price_list_header .= '<th><a href="shop.php?action=view&id=' . $shop->getId() . '">' . $shop->getName() . '</a></th>';
        }

        $products = $database->getProductsOrderedBy("name");
        foreach( $products as $product ){
            $product->setPrices( $database->getProductPricesByProductId( $product->getId() ) );
        }

        $price_list = "";
        foreach( $products as $product ){
            $product_id = $product->getId();
            $product_name = $product->getName();
            $product_prices = $product->getPrices();
            $price_list .= '<tr><th><a href="product.php?action=view&id=' . $product_id . '">'.$product_name.'</a></th>';
            foreach( $shops as $shop ){
                $price = isset( $product_prices[$shop->getName()] ) ? $product_prices[$shop->getName()] : "";
                $price_list .= "<td class='price' data-product-id='{$product_id}' data-shop-id='{$shop->getId()}' data-shop-name='{$shop->getName()}' >$price</td>";
            }

            $price_list .= '</tr>';
        }

        $this->values["price_list"] = $price_list;
        $this->values["price_list_header"] = $price_list_header;
    }
}