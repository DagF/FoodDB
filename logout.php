<?php

require_once( "classes/Template.php" );
require_once( "classes/LogoutView.php" );



$title = "Logout";

$_SESSION['verified'] = false;

$login_view = new LogoutView( $_SESSION['verified'] );

$content = $login_view->output();

$page = new Template( "templates/main.tpl");
$page->set("title", $title);
$page->set( "content", $content);
$page->set( "logout_status", "active");
echo $page->output();