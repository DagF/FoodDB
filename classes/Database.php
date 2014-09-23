<?php
final class Database{

    protected $connection;

    public static function Instance(){
        static $inst = null;
        if( $inst === null ){
            $inst = new Database();
        }
        return $inst;
    }

    private function __construct(){
        try{
            $connection = new PDO( 'mysql:host='.DATABASE_HOST.";dbname=".  DATABASE_NAME . ";charset=utf8" ,
                DATABASE_USER , DATABASE_PASSWORD );
            $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        }
        catch(PDOException $e){
            echo "Error: " . $e->getMessage();
        }

        $this->connection = $connection;
    }

    public function insertProduct( Product $product ){

        $query = "INSERT INTO products(`name`, `kilojoule`, `kilokalorier`, `fett`, `karbohydrater`, `protein`, `salt`,
        `g_per_piece` ) ".
            "VALUES( ?,?,?,?,?,?,?,? )";
        $stmt = $this->connection->prepare( $query );

        $stmt->bindParam( 1, $name );
        $stmt->bindParam( 2, $kilojoule );
        $stmt->bindParam( 3, $kilokalorier );
        $stmt->bindParam( 4, $fett );
        $stmt->bindParam( 5, $karbohydrater );
        $stmt->bindParam( 6, $protein );
        $stmt->bindParam( 7, $salt );
        $stmt->bindParam( 8, $g_per_piece );

        $name = $product->getName();
        $kilojoule = $product->getKilojoule();
        $kilokalorier = $product->getKilokalorier();
        $fett = $product->getFett();
        $karbohydrater = $product->getKarbohydrater();
        $protein = $product->getProtein();
        $salt = $product->getSalt();
        $g_per_piece = $product->getGPerPiece();

        $stmt->execute();

        $product->setId( $this->connection->lastInsertId() );
    }

    public function updateProduct( Product $product ){
        $query = "UPDATE products SET `name`=?, `kilojoule`=?, `kilokalorier`=?, `fett`=?, `karbohydrater`=?,
        `protein`=?, `salt`=?, `g_per_piece`=? WHERE id=?";
        $stmt = $this->connection->prepare( $query );

        $stmt->bindParam( 1, $name );
        $stmt->bindParam( 2, $kilojoule );
        $stmt->bindParam( 3, $kilokalorier );
        $stmt->bindParam( 4, $fett );
        $stmt->bindParam( 5, $karbohydrater );
        $stmt->bindParam( 6, $protein );
        $stmt->bindParam( 7, $salt );
        $stmt->bindParam( 8, $g_per_piece );
        $stmt->bindParam( 9, $id );

        $name = $product->getName();
        $kilojoule = $product->getKilojoule();
        $kilokalorier = $product->getKilokalorier();
        $fett = $product->getFett();
        $karbohydrater = $product->getKarbohydrater();
        $protein = $product->getProtein();
        $salt = $product->getSalt();
        $g_per_piece = $product->getGPerPiece();
        $id = $product->getId();

        $stmt->execute();
    }

    public function deleteProduct( $product_id ){
        $query = "DELETE FROM products WHERE id = ?";
        $stmt = $this->connection->prepare( $query );
        $stmt->bindParam( 1, $id );
        $id = $product_id;

        $stmt->execute();
    }

    public function getProductById( $id ){
        $query = "SELECT * FROM products WHERE id = ?";
        $stmt = $this->connection->prepare( $query );
        $stmt->bindParam( 1, $id );

        $stmt->execute();
        $result = $stmt->fetch() ;
        $product = new Product();
        if( $result != null ){
            $product = Product::withDatabaseArray( $result );
        }
        return $product;
    }

    public function getProductsOrderedBy( $order_by ){
        $query = "SELECT * FROM products ORDER BY $order_by";
        $stmt = $this->connection->prepare( $query );

        $stmt->execute();
        $products = array();
        while( $product_row = $stmt->fetch() ){
            $product = Product::withDatabaseArray( $product_row );
            array_push( $products, $product );
        }
        return $products;
    }

    //******************************* shop **************************************

    public function insertShop( Shop $shop ){

        $query = "INSERT INTO shops(`name`) VALUES( ? )";
        $stmt = $this->connection->prepare( $query );

        $stmt->bindParam( 1, $name );

        $name = $shop->getName();

        $stmt->execute();

        $shop->setId( $this->connection->lastInsertId() );
    }

    public function updateShop( Shop $shop ){
        $query = "UPDATE shops SET `name`=? WHERE id=?";
        $stmt = $this->connection->prepare( $query );

        $stmt->bindParam( 1, $name );
        $stmt->bindParam( 2, $id );

        $name = $shop->getName();
        $id = $shop->getId();

        $stmt->execute();
    }

    public function deleteShop( $shop_id ){
        $query = "DELETE FROM shops WHERE id = ?";
        $stmt = $this->connection->prepare( $query );
        $stmt->bindParam( 1, $id );
        $id = $shop_id;

        $stmt->execute();
    }

    public function getShopById( $id ){
        $query = "SELECT * FROM shops WHERE id = ?";
        $stmt = $this->connection->prepare( $query );
        $stmt->bindParam( 1, $id );

        $stmt->execute();
        $result = $stmt->fetch() ;
        $shop = new Shop();
        if( $result != null ){
            $shop = Shop::withDatabaseArray( $result );
        }
        return $shop;
    }

    public function getShopsOrderedByName( ){
        $query = "SELECT * FROM shops ORDER BY name";
        $stmt = $this->connection->prepare( $query );

        $stmt->execute();
        $shops = array();
        while( $shop_row = $stmt->fetch() ){
            $shop = Shop::withDatabaseArray( $shop_row );
            array_push( $shops, $shop );
        }
        return $shops;
    }

  public function getProductPricesByProductId( $product_id ){
      $product_id = is_nan( $product_id ) ? "" : $product_id;
      $query = "SELECT price, shops.name FROM `prices`, shops WHERE prices.shop_id = shops.id and product_id = $product_id and price in ( ".
      "select price from prices where product_id = $product_id and `date` in (select max(date) from prices where product_id = $product_id group by shop_id)  )";
      $stmt = $this->connection->prepare( $query );

      $stmt->execute();
      $prices = array();
      while( $price_row = $stmt->fetch() ){
          $shop = $price_row['name'];
          $price = $price_row['price'];
          $prices[$shop] = $price;
      }
      return $prices;

  }


    public function getProductOptionList(){
        $query = "SELECT id, name FROM products ORDER BY name";
        $stmt = $this->connection->prepare( $query );

        $stmt->execute();
        $option_list = "";
        while( $product_row = $stmt->fetch() ){
            $option_list_row = new OptionListRow( $product_row['name'], $product_row['id'] );
            $option_list .= $option_list_row->output();
        }
        return $option_list;
    }

    public function getShopOptionList(){
        $query = "SELECT id, name FROM shops ORDER BY name";
        $stmt = $this->connection->prepare( $query );

        $stmt->execute();
        $option_list = "";
        while( $product_row = $stmt->fetch() ){
            $option_list_row = new OptionListRow( $product_row['name'], $product_row['id'] );
            $option_list .= $option_list_row->output();
        }
        return $option_list;
    }



    public function insertPrice( Price $price ){
        $query = "INSERT INTO prices (price, product_id, shop_id ) VALUES ( ?, ?, ? )";
        $stmt = $this->connection->prepare( $query );


        $stmt->bindParam( 1, $p );
        $stmt->bindParam( 2, $product_id );
        $stmt->bindParam( 3, $shop_id );

        $p = $price->getPrice();
        $product_id = $price->getProductId();
        $shop_id = $price->getShopId();

        $stmt->execute();
    }
}