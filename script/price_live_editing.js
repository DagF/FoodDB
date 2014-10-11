(function(){
    var prices = document.getElementsByClassName("price");
    for( var i = 0; i < prices.length; i++ ){
        prices[i].ondblclick = openEditDialog;
    }

    function openEditDialog( e ){
        var price = getExistingPrice( e );
        var new_price = prompt( "Skriv inn ny pris for produktet " + price.getProductName() + " hos butikken " + price.getShopName() + ".\n Nåverende pris er: " + price.getPrice() );
        if( new_price.length > 0 ){
            price = new Price(price.getProductName(), price.getProductId(), price.getShopName(), price.getShopId(), new_price);
            updateDatabaseRecord( price );
            e.target.innerHTML = parseFloat(Math.round( new_price * 100) / 100).toFixed(2);
        }
    }

    function getExistingPrice( event ){
        var target = event.target;
        var parent = target.parentNode;

        var product_name = parent.getElementsByTagName("th")[0].getElementsByTagName("a")[0].innerHTML;
        var product_id = target.getAttribute("data-product-id");
        var shop_id = target.getAttribute("data-shop-id");
        var shop_name = target.getAttribute("data-shop-name");
        var price = target.innerHTML;

        return new Price(product_name, product_id, shop_name,shop_id,price);
    }

    function Price( product_name, product_id, shop_name, shop_id, price ){

        this.getPrice = function (){
            return price;
        }

        this.getProductName = function (){
            return product_name;
        }

        this.getProductId = function (){
            return product_id;
        }

        this.getShopId = function (){
            return shop_id;
        }

        this.getShopName = function (){
            return shop_name;
        }


    }



    /*
    * based on https://developer.mozilla.org/en-US/docs/Web/Guide/HTML/Forms/Sending_forms_through_JavaScript
    * */

    function updateDatabaseRecord( price ) {
        var xml_http_request = new XMLHttpRequest();
        var form_data  = new FormData();

        form_data.append( "product_id", price.getProductId() );
        form_data.append( "shop_id", price.getShopId() );
        form_data.append( "price", price.getPrice() );

        xml_http_request.addEventListener('load', function(event) {
            new Toast('Yeah! Data sent and response loaded.');
        });

        xml_http_request.addEventListener('error', function(event) {
            toast('Oups! Something goes wrong.');
        });

        xml_http_request.open('POST', 'price.php');

        xml_http_request.send(form_data);
    }

})();