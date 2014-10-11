<?php
/**
 * Created by PhpStorm.
 * User: DagF
 * Date: 27.09.14
 * Time: 23:08
 */

class LoginView extends Template{

    public function __construct( $verified ){
        $this->file = "templates/login_view.tpl";

        $message = "";

        if( $verified === "failed" ){
            $message = "Username or Password is incorrect.";
        }

        $this->set( "message", $message );
    }
} 