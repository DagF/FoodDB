<?php
session_start();
$_SESSION['verified'] = 1;

require_once( "constants.php" );
require_once( "classes/Database.php" );
$database = Database::Instance();

require_once( "classes/Template.php" );

require_once("classes/shop/Shop.php");
require_once("classes/shop/ShopView.php");
require_once("classes/shop/ShopEditView.php");
require_once("classes/shop/ShopListView.php");
require_once("classes/shop/ShopListRow.php");

require_once("classes/OptionListRow.php");

require_once( "function_dmp.php" );


if( isset( $_GET['action'] ) ){
    $action = $_GET['action'];
}
else{
    $action = null;
}

function isShopFormDataAvailable(){
    return isset( $_POST['name'] );
}

function isShopIdGiven(){
    return isset( $_GET['id'] );
}

function isShopQualifiedForInsert(){
    return !isMarkedForDelete() and !isShopIdGiven();
}

function isShopQualifiedForUpdate(){
    return isShopIdGiven() and !isMarkedForDelete();
}

function isShopQualifiedForDelete(){
    return isShopIdGiven() and isMarkedForDelete();
}

function editShop(){
    $database = Database::Instance();
    if( isShopFormDataAvailable()  ){
        $shop = Shop::withInputArray( $_POST );
        if( isShopQualifiedForUpdate() ){
            $shop->setId( $_GET['id'] );
            $database->updateShop( $shop );
        }
        else if( isShopQualifiedForInsert() ){
            $database->insertShop( $shop );
            header( "Location: shop.php?action=edit&id={$shop->getID()}");
        }
        else if( isShopQualifiedForDelete() ){
            $database->deleteShop( $_GET['id'] );
        }
    }

    if( isShopIdGiven() and !isMarkedForDelete() ){
        $shop = $database->getShopById( $_GET['id'] );

    }
    return $shop;
}

function getShopContent( $shop ){
    $content = "I don't know what to do";
    if( isset( $shop ) and !isMarkedForDelete() ){
        $is_new = false;
        $edit_shop_view = new ShopEditView( $shop, $is_new );
        $content = $edit_shop_view->output();
    }
    else if( isMarkedForDelete() ){
        $content = "Shop deleted";
    }
    return $content;
}

    switch( $action ){
        case "add":
            $shop = Shop::withInputArray( array() );
            $is_new = true;
            $edit_shop_view = new ShopEditView( $shop, $is_new );
            $content = $edit_shop_view->output();
            break;

        case "edit":
            $product = editShop();
            $content = getShopContent( $product );

            break;

        case "view":
            $id = $_GET['id'];
            $shop = $database->getShopById( $id );
            $shop_view = new ShopView( $shop );
            $content = $shop_view->output();
            break;

        default:
            $shops = $database->getShopsOrderedByName( );
            $shop_list_view = new ShopListView( $shops );
            $content = $shop_list_view->output();
            break;
    }

$title = "Butikk";

$page = new Template( "templates/main.tpl");
$page->set("title", $title);
$page->set( "content", $content);
$page->set( "shop_status", "active");
echo $page->output();