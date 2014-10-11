<?php

require_once( "classes/Template.php" );

require_once( "common_functions.php");
require_once( "classes/LoginView.php" );


$title = "Main";
$content = "Move along";

if( isset( $_GET['action'] ) ){
    switch( $_GET['action'] ){

    }

}

$page = new Template( "templates/main.tpl");
$page->set("title", $title);
$page->set( "content", $content);
$page->set( "home_status", "active");
echo $page->output();