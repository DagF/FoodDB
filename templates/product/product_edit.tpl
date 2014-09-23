<form action="product.php?action=edit[@product_id]" method="post">
    <label>Name</label>
    <input type="text" value="[@name]" name="name" maxlength="100"><br>

    <label>Kilojoule</label>
    <input type="number" value="[@kilojoule]" name="kilojoule"><br>

    <label>Kilokalorier</label>
    <input type="number" value="[@kilokalorier]" name="kilokalorier"><br>

    <label>Fett</label>
    <input type="number" value="[@fett]" name="fett"><br>

    <label>Karbohydrater</label>
    <input type="number" value="[@karbohydrater]" name="karbohydrater"><br>

    <label>Protein</label>
    <input type="number" value="[@protein]" name="protein"><br>

    <label>Salt</label>
    <input type="number" value="[@salt]" name="salt"><br>

    <label>Gram per</label>
    <input type="number" value="[@g_per_piece]" name="g_per_piece"><br>

    <input type="submit" value="[@action] Product" name="action" value="">
    [@delete]
</form>
<a href="product.php?action=add">Legg til nytt product</a>
