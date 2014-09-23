<!DOCTYPE html>
<html>
    <head>
        <title>[@title]</title>
        <meta charset="utf-8">
        <link rel="stylesheet" href="style/main.css">
        <link rel="stylesheet" media="(min-width:800px)" href="style/desktop.css">
    </head>
    <body>
        <div id="wrapper">
            <header>
                <h1>[@title]</h1>
            </header>
            <nav>
                <ul>
                    <li><a class="[@home_status]" href="index.php">Hjem</a></li>
                    <li><a class="[@product_status]" href="product.php">Produkt liste</a></li>
                    <li><a class="[@price_status]" href="price.php">Pris liste</a></li>
                    <li><a class="[@shop_status]" href="shop.php">Butikk liste</a></li>
                </ul>
            </nav>
            <div id="content">[@content]</div>
            <footer></footer>
        </div>
        [@scripts]
    </body>
</html>