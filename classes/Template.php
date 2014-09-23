<?php

class Template{
    protected $file;
    protected $values = array();
    protected $scripts = [
        "script/toast.js"
    ];

    public function __construct( $file ){
        $this->file = $file;
        $this->values = [
            "home_status" => "",
            "product_status" => "",
            "price_status" => "",
            "shop_status" => ""
        ];
    }

    public function set( $key, $value ){
        $this->values[ $key ] = $value;
    }

    public function addScript( $script_link ){
        array_push( $this->scripts, $script_link );
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
        $output = str_replace( "[@scripts]", $page_scripts, $output );
        return $output;
    }
}