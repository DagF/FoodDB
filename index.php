<?php
session_start();
$_SESSION['verified'] = 1;

require_once( "constants.php" );
require_once( "classes/Database.php" );
$database = Database::Instance();


require_once( "classes/Template.php" );



require_once("classes/OptionListRow.php");

require_once( "function_dmp.php" );

$title = "Main";
$content = "Move along";

if( isset( $_GET['action'] ) ){
    switch( $_GET['action'] ){

        //**************************** shop *************************


        //************************* price ****************************

    }

}

$page = new Template( "templates/main.tpl");
$page->set("title", $title);
$page->set( "content", $content);
$page->set( "home_status", "active");
echo $page->output();