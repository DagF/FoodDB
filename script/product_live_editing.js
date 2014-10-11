(function(){
    var prices = document.getElementsByClassName("");
    for( var i = 0; i < prices.length; i++ ){
        prices[i].ondblclick = openEditDialog;
    }
})();