<meta charset="UTF-8" />
<?php
require('../config.php');
require('connection.php');

$sqlbd= "CREATE DATABASE IF NOT EXISTS ".BBDD." DEFAULT COLLATE latin1_spanish_ci;";

if(!$connect = $mysqli->query( $sqlbd)){
    printf("Falló la creación de la bade de datos: %s\n", $mysqli->connect_error);
    exit();    
}else{
    $mysqli->select_db(BBDD);
    
$query = 'CREATE TABLE IF NOT EXISTS ecomm_products (
        product_code  CHAR(5)      NOT NULL,
        name          VARCHAR(100) NOT NULL,
        description   MEDIUMTEXT,
        price         DEC(6,2)     NOT NULL,

        PRIMARY KEY(product_code)
    )';
$mysqli->query("SET NAMES 'utf8'");
if(!$mysqli->query($query))
    echo'<div class="alertFAIL">Error al crear la tabla</div>';



$query = 'CREATE TABLE IF NOT EXISTS ecomm_customers (
    customer_id INTEGER UNSIGNED NOT NULL AUTO_INCREMENT,
    first_name  VARCHAR(20)      NOT NULL,

    address_1   VARCHAR(50)      NOT NULL,

    email       VARCHAR(100)     NOT NULL,

    PRIMARY KEY (customer_id)
)';
$mysqli->query("SET NAMES 'utf8'");
if(!$mysqli->query($query))
    echo'<div class="alertFAIL">Error al crear la tabla</div>';




$query = 'CREATE TABLE IF NOT EXISTS ecomm_order_details (
        order_id     INTEGER UNSIGNED NOT NULL,
        order_qty    INTEGER UNSIGNED NOT NULL,
        product_code CHAR(5)          NOT NULL,

        FOREIGN KEY (order_id) REFERENCES ecomm_orders(order_id),
        FOREIGN KEY (product_code) REFERENCES ecomm_products(product_code)
    )';	
$mysqli->query("SET NAMES 'utf8'");
if(!$mysqli->query($query))
    echo'<div class="alertFAIL">Error al crear la tabla</div>';



$query = 'CREATE TABLE IF NOT EXISTS ecomm_temp_cart (
        session      CHAR(50)         NOT NULL,
        product_code CHAR(5)          NOT NULL,
        qty          INTEGER UNSIGNED NOT NULL,

        PRIMARY KEY (session, product_code),
        FOREIGN KEY (product_code) REFERENCES ecomm_products(product_code)
    )';	

$mysqli->query("SET NAMES 'utf8'");
if(!$mysqli->query($query))
    echo'<div class="alertFAIL">Error al crear la tabla</div>';


    //INSERT's


$query = 'INSERT INTO ecomm_products
        (product_code, name, description, price)
    VALUES
        ("00001",
        "CBA Logo T-shirt",
        "This T-shirt will show off your CBA connection. Our t-shirts are ' .
    'all made of high quality and 100% preshrunk cotton.",
         17.95),
         ("00002",
         "CBA Bumper Sticker", 
         "Let the world know you are a proud supporter of the CBA web site ' .
    'with this colorful bumper sticker.",
         5.95),
         ("00003",
         "CBA Coffee Mug",
         "With the CBA logo looking back at you over your morning cup of ' .
    'coffee, you are sure to have a great start to your day. Our mugs ' .
    'are microwave and dishwasher safe.",
         8.95),
         ("00004",
         "Superhero Body Suit",
         "We have a complete selection of colors and sizes for you to choose ' .
    'from. This body suit is sleek, stylish, and won\'t hinder either ' .
    'your crime-fighting skills or evil scheming abilities. We also ' .
    'offer your choice in monogrammed letter applique.",
         99.95),
         ("00005",
         "Small Grappling Hook",
         "This specialized hook will get you out of the tightest places. ' .
    'Specially designed for portability and stealth, please be aware ' .
    'that this hook does come with a weight limit.",
         139.95),
         ("00006",
         "Large Grappling Hook", 
         "For all your heavy-duty building-to-building swinging needs, this ' .
    'large version of our grappling hook will safely transport you ' .
    'throughout the city. Please be advised however that at 50 pounds ' .
    'this is hardly the hook to use if you are a lightweight.",
         199.95)';

$mysqli->query("SET NAMES 'utf8'");
if (!$resultado = $mysqli->query($query))
        echo'<div class="alertFAIL">Error al Insertar en '.$key.'-'.$v.'</div>';
}
$mysqli->close();
echo '<META http-equiv="refresh" content="1;URL=../index.php?index2=2">';
?>