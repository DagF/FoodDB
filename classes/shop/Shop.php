<?php
class Shop{

    private $id;
    private $name;

    public function __construct( ){
    }

    public static function withDatabaseArray( $db_array ){
        $instance = new self();
        $instance->id               = isset( $db_array["id"] )               ? $db_array["id"]            : "";
        $instance->name             = isset( $db_array["name"] )             ? $db_array["name"]          : "";
        return $instance;

    }


    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }


    public function setName( $name ){
        $this->name = $name;
    }

    public function getName(){
        return $this->name;
    }

    public static function withInputArray( $input_array ){
        $instance = new self();
        $instance->name             = isset( $input_array["name"] )             ? $input_array["name"]          : "";
        return $instance;
    }
}