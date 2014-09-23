(function(){
    var prices = document.getElementsByClassName("price");
    for( var i = 0; i < prices.length; i++ ){
        prices[i].ondblclick = openEditDialog;
    }

    function openEditDialog( e ){
        var price = new Price( e );
    }

    function Price( event ){
        this.target = event.target;
        this.parent = this.target.parentNode;
        this.name = this.parent.getElementsByTagName("th")[0].getElementsByTagName("a")[0].innerHTML;
        this.product_id = this.target.getAttribute("data-product-id");
        this.shop_id = this.target.getAttribute("data-shop-id");
        this.shop_name = this.target.getAttribute("data-shop-name");
        this.price = this.target.innerHTML;
        var new_price = prompt( "Skriv inn ny pris for produktet " + this.name + " hos butikken " + this.shop_name + ".\n Nåverende pris er: " + this.price );
        if( new_price.length > 0 ){
            var data = {
                "shop_id" : this.shop_id,
                "product_id" : this.product_id,
                "price" : new_price
            };
            sendData( data );
            this.target.innerHTML = parseFloat(Math.round( new_price * 100) / 100).toFixed(2);
        }
    }

    function EditDialogView(){

    }

    /*
    * based on https://developer.mozilla.org/en-US/docs/Web/Guide/HTML/Forms/Sending_forms_through_JavaScript
    * */

    function sendData( data ) {
        var xml_http_request = new XMLHttpRequest();
        var form_data  = new FormData();

        for(name in data) {
            form_data.append( name, data[name] );
        }

        xml_http_request.addEventListener('load', function(event) {
            toast('Yeah! Data sent and response loaded.');
        });

        xml_http_request.addEventListener('error', function(event) {
            toast('Oups! Something goes wrong.');
        });

        xml_http_request.open('POST', 'price.php');

        xml_http_request.send(form_data);
    }

})();