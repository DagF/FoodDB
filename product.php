<?php

require_once( "classes/Template.php" );

require_once("classes/product/Product.php");
require_once("classes/product/ProductView.php");
require_once("classes/product/ProductEditView.php");
require_once("classes/product/ProductListView.php");
require_once("classes/product/ProductListRow.php");



if( isset( $_GET['action'] ) ){
    $action = $_GET['action'];
}
else{
    $action = null;
}



function isProductFormDataAvailable(){
    return isset( $_POST['name'] );
}

function isProductIdGiven(){
    return isset( $_GET['id'] );
}



function isProductQualifiedForInsert(){
    return !isMarkedForDelete() and !isProductIdGiven();
}

function isProductQualifiedForUpdate(){
    return isProductIdGiven() and !isMarkedForDelete();
}

function isProductQualifiedForDelete(){
    return isProductIdGiven() and isMarkedForDelete();
}

if( isProductFormDataAvailable() && isVerified() ){
    $database = Database::Instance();
    if( isProductFormDataAvailable()  ){
        $product = Product::withInputArray( $_POST );
        if( isProductQualifiedForUpdate() ){
            $product->setId( $_GET['id'] );
            $database->updateProduct( $product );
        }
        else if( isProductQualifiedForInsert() ){
            $database->insertProduct( $product );
            header( "Location: product.php?action=edit&id={$product->getID()}");
        }
        else if( isProductQualifiedForDelete() ){
            $database->deleteProduct( $_GET['id'] );
        }
    }

    if( isProductIdGiven() and !isMarkedForDelete() ){
        $product = $database->getProductById( $_GET['id'] );

    }
}



function getFieldToOrderProductsBy(){
    $order_by = "name";
    if( isset( $_GET['order_by'] )){
        switch( $_GET['order_by'] ){
            case "salt":
                $order_by = "salt";
                break;
            case "kilojoule":
                $order_by = "kilojoule";
                break;
            case "kilokalorier":
                $order_by = "kilokalorier";
                break;
            case "fett":
                $order_by = "salt";
                break;
            case "karbohydrater":
                $order_by = "karbohydrater";
                break;
            case "protein":
                $order_by = "protein";
                break;
            case "g_per_piece":
                $order_by = "g_per_piece";
                break;
        }
    }
    return $order_by;
}


switch( $action ){
    case "add":
        $product = Product::withInputArray( array() );
        $is_new = true;
        $edit_product_view = new ProductEditView( $product, $is_new );
        $content = $edit_product_view->output();
        break;

    case "edit":
        $id = $_GET['id'];
        $product = $database->getProductById( $id );
        $is_new = false;
        $edit_product_view = new ProductEditView( $product, $is_new );
        $content = $edit_product_view->output();
        break;

    case "view":
        $id = $_GET['id'];
        $product = $database->getProductById( $id );
        $edit_product_view = new ProductView( $product );
        $content = $edit_product_view->output();
        break;

    default:
        $order_by = getFieldToOrderProductsBy();
        $products = $database->getProductsOrderedBy( $order_by );
        $product_list_view = new ProductListView( $products );
        $content = $product_list_view->output();
        break;

}

$title = "Product";

$page = new Template( "templates/main.tpl");
$page->set("title", $title);
$page->set( "content", $content);
$page->set( "product_status", "active");
$page->addAdminScript("script/product_live_editing.js");
echo $page->output();