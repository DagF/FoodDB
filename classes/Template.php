<?php
session_start();


require_once( "constants.php" );
require_once( "classes/Database.php" );
$database = Database::Instance();

require_once("classes/OptionListRow.php");
require_once( "common_functions.php");

class Template{
    protected $file;
    protected $values = array();
    protected $scripts = [
        "script/toast.js",
        "script/alert.js",
        "script/prompt.js"
    ];

    protected $admin_scripts = [];

    public function __construct( $file ){
        $this->file = $file;
        $this->values = [
            "home_status" => "",
            "product_status" => "",
            "price_status" => "",
            "shop_status" => "",
            "login_status" => "",
            "logout_status" => ""
        ];

        if( isVerified() ){
            $this->set("display_login", "display");
            $this->set("display_logout", "hide");
        }
        else{
            $this->set("display_login", "hide");
            $this->set("display_logout", "display");
        }
    }

    public function set( $key, $value ){
        $this->values[ $key ] = $value;
    }

    public function addScript( $script_link ){
        array_push( $this->scripts, $script_link );
    }

    public function addAdminScript( $script_link ){
        array_push( $this->admin_scripts, $script_link );
    }

    public function output(){
        if( !file_exists( $this->file ) ){
            return "Error loading template file ({$this->file}).";
        }
        $output = file_get_contents( $this->file );

        foreach( $this->values as $key => $value ){
            $tag_to_replace = "[@$key]";
            $output = str_replace( $tag_to_replace, $value, $output );
        }
        $page_scripts = "";
        foreach( $this->scripts as $script ){
            $page_scripts .= '<script src="'. $script .'"></script>' . "\n";
        }
        if( isVerified() ){

            foreach( $this->admin_scripts as $script ){
                $page_scripts .= '<script src="'. $script .'"></script>' . "\n";
            }
        }
        $output = str_replace( "[@scripts]", $page_scripts, $output );
        return $output;
    }
}