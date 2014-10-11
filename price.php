<?php

require_once( "classes/Template.php" );

require_once("classes/shop/Shop.php");

require_once("classes/product/Product.php");

require_once("classes/price/Price.php");
require_once("classes/price/PriceView.php");
require_once("classes/price/PriceEditView.php");
require_once("classes/price/PriceListView.php");
require_once("classes/price/PriceListRow.php");
require_once("classes/price/PriceListColumn.php");


if( isset( $_GET['action'] ) ){
    $action = $_GET['action'];
}
else{
    $action = null;
}

function isPriceFormDataAvailable(){
    return isset( $_POST['price'] );
}

if( isPriceFormDataAvailable() && isVerified() ){
    $price = Price::withInputArray( $_POST );
    $database->insertPrice( $price );
    header( "Location: price.php?action=list");
}

switch( $action ){
    case "add":
        $product_list = $database->getProductOptionList();
        $shop_list = $database->getShopOptionList();
        $add_price_view = new PriceEditView( $product_list, $shop_list );
        $content = $add_price_view->output();
        break;

    default:
        $shops = $database->getShopsOrderedByName();
        $price_list_view = new PriceListView( $shops );
        $content = $price_list_view->output();
        break;
}

$title = "Pris";

$page = new Template( "templates/main.tpl");
$page->set("title", $title);
$page->set( "content", $content);
$page->set( "price_status", "active");
$page->addAdminScript("script/price_live_editing.js");
echo $page->output();