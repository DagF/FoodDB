<?php
class Price{

    private $price;
    private $product_id;
    private $shop_id;
    private $date;

    public function __construct( ){
    }

    public static function withDatabaseArray( $db_array ){
        $instance = new self();
        $instance->price               = isset( $db_array["price"] )               ? $db_array["price"]            : "";
        $instance->product_id             = isset( $db_array["product_id"] )             ? $db_array["product_id"]          : "";
        $instance->shop_id             = isset( $db_array["shop_id"] )             ? $db_array["shop_id"]          : "";
        $instance->date             = isset( $db_array["date"] )             ? $db_array["date"]          : "";
        return $instance;

    }

    /**
     * @param mixed $price
     */
    public function setPrice($price)
    {
        $this->price = $price;
    }

    /**
     * @return mixed
     */
    public function getPrice()
    {
        return $this->price;
    }

    /**
     * @param mixed $product_id
     */
    public function setProductId($product_id)
    {
        $this->product_id = $product_id;
    }

    /**
     * @return mixed
     */
    public function getProductId()
    {
        return $this->product_id;
    }

    /**
     * @param mixed $shop_id
     */
    public function setShopId($shop_id)
    {
        $this->shop_id = $shop_id;
    }

    /**
     * @return mixed
     */
    public function getShopId()
    {
        return $this->shop_id;
    }

    /**
     * @param mixed $date
     */
    public function setDate($date)
    {
        $this->date = $date;
    }

    /**
     * @return mixed
     */
    public function getDate()
    {
        return $this->date;
    }




    public static function withInputArray( $input_array ){
        $instance = new self();
        $instance->price             = isset( $input_array["price"] )             ? $input_array["price"]          : "";
        $instance->product_id             = isset( $input_array["product_id"] )             ? $input_array["product_id"]          : "";
        $instance->shop_id             = isset( $input_array["shop_id"] )             ? $input_array["shop_id"]          : "";
        return $instance;
    }
}