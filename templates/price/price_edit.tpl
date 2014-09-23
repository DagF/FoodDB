<form action="?action=add" method="post">
    <label>Pris</label>
    <input type="number" value="" name="price"><br>

    <label>Product</label>
    <select name="product_id">
        [@product_list]
    </select>

    <label>Butikker</label>
    <select name="shop_id">
        [@shop_list]
    </select>
    <input type="submit" value="Legg til pris">
</form>
<a href="price.php?action=add">Legg til ny pris</a>
