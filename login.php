<?php

require_once( "classes/Template.php" );
require_once( "classes/LoginView.php" );

$title = "Login";

if( isset( $_POST["user"] ) ){
    if( $_POST["user"]["name"] == strrev( $_POST["user"]["password"] ) ){
        $_SESSION['verified'] = true;
        header( "Location: index.php" );
    }
    else{
        $_SESSION['verified'] = "failed";
    }
}

$login_view = new LoginView( $_SESSION['verified'] );

$content = $login_view->output();

$page = new Template( "templates/main.tpl");
$page->set("title", $title);
$page->set( "content", $content);
$page->set( "login_status", "active");
echo $page->output();