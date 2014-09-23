<?php
class Product{

    private $id;
    private $name;
    private $kilojoule;
    private $kilokalorier;
    private $fett;
    private $karbohydrater;
    private $protein;
    private $salt;
    private $g_per_piece;
    private $prices;

    public function __construct( ){
    }

    public static function withDatabaseArray( $db_array ){
        $instance = new self();
        $instance->id               = isset( $db_array["id"] )               ? $db_array["id"]            : "";
        $instance->name             = isset( $db_array["name"] )             ? $db_array["name"]          : "";
        $instance->kilojoule        = isset( $db_array["kilojoule"] )        ? $db_array["kilojoule"]     : null;
        $instance->kilokalorier     = isset( $db_array["kilokalorier"] )     ? $db_array["kilokalorier"]  : null;
        $instance->fett             = isset( $db_array["fett"] )             ? $db_array["fett"]          : null;
        $instance->karbohydrater    = isset( $db_array["karbohydrater"] )    ? $db_array["karbohydrater"] : null;
        $instance->protein          = isset( $db_array["protein"] )          ? $db_array["protein"]       : null;
        $instance->salt             = isset( $db_array["salt"] )             ? $db_array["salt"]          : null;
        $instance->g_per_piece      = isset( $db_array["g_per_piece"] )      ? $db_array["g_per_piece"]   : null;
        return $instance;

    }

    /**
     * @param mixed $fett
     */
    public function setFett($fett){
        $this->fett = $fett;
    }

    public function setPrices( $prices ){
        $this->prices = $prices;
    }

    public function getPrices(){
        return $this->prices;
    }
    /**
     * @return mixed
     */
    public function getFett()
    {
        return $this->fett;
    }

    /**
     * @param mixed $g_per_piece
     */
    public function setGPerPiece($g_per_piece)
    {
        $this->g_per_piece = $g_per_piece;
    }

    /**
     * @return mixed
     */
    public function getGPerPiece()
    {
        return $this->g_per_piece;
    }

    /**
     * @param mixed $id
     */
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

    /**
     * @param mixed $karbohydrater
     */
    public function setKarbohydrater($karbohydrater)
    {
        $this->karbohydrater = $karbohydrater;
    }

    /**
     * @return mixed
     */
    public function getKarbohydrater()
    {
        return $this->karbohydrater;
    }

    /**
     * @param mixed $kilojoule
     */
    public function setKilojoule($kilojoule)
    {
        $this->kilojoule = $kilojoule;
    }

    /**
     * @return mixed
     */
    public function getKilojoule()
    {
        return $this->kilojoule;
    }

    /**
     * @param mixed $kilokalorier
     */
    public function setKilokalorier($kilokalorier)
    {
        $this->kilokalorier = $kilokalorier;
    }

    /**
     * @return mixed
     */
    public function getKilokalorier()
    {
        return $this->kilokalorier;
    }

    /**
     * @param mixed $protein
     */
    public function setProtein($protein)
    {
        $this->protein = $protein;
    }

    /**
     * @return mixed
     */
    public function getProtein()
    {
        return $this->protein;
    }

    /**
     * @param mixed $salt
     */
    public function setSalt($salt)
    {
        $this->salt = $salt;
    }

    /**
     * @return mixed
     */
    public function getSalt()
    {
        return $this->salt;
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
        $instance->kilojoule        = isset( $input_array["kilojoule"] )        ? $input_array["kilojoule"]     : null;
        $instance->kilokalorier     = isset( $input_array["kilokalorier"] )     ? $input_array["kilokalorier"]  : null;
        $instance->fett             = isset( $input_array["fett"] )             ? $input_array["fett"]          : null;
        $instance->karbohydrater    = isset( $input_array["karbohydrater"] )    ? $input_array["karbohydrater"] : null;
        $instance->protein          = isset( $input_array["protein"] )          ? $input_array["protein"]       : null;
        $instance->salt             = isset( $input_array["salt"] )             ? $input_array["salt"]          : null;
        $instance->g_per_piece      = isset( $input_array["g_per_piece"] )      ? $input_array["g_per_piece"]   : null;
        return $instance;
    }
}