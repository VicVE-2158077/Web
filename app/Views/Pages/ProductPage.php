<?php

if(!isset($_SESSION)) 
{ 
    session_start(); 
} 
$path = $_SERVER['DOCUMENT_ROOT'];
$path .= "/java/functions.php";
require_once $path;

$id = $_GET['id'];

$product = db_query("select * from products where id = :id limit 1", "productlistings_db", ['id'=>$id]);

$amount_of_purchases = db_query("select count(buyer) from bought_product where id = :id limit 1", "bought_product_db", ['id'=>$id]);


$bought_data_arr = [];
$bought_data_arr['id'] = $id;
$bought_data_arr['email'] = $_SESSION['PROFILE'];

$bought = db_query("select buyer from bought_product where id = :id and buyer = :email", "bought_product_db", $bought_data_arr);
if (!empty($product)) 
{
    $product = $product[0];
}
?>
<!DOCTYPE html>
<head>
    <meta charset="UTF-8">
    <script src="<?php echo base_url('java/listing.js'); ?>"></script>
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('css/HomePage.css'); ?>">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('bootstrap-4.0.0-dist/css/bootstrap.min.css'); ?>">
    <title>Product</title>
</head>

<script src="<?php echo base_url('java/listing.js'); ?>"></script>
<?php if(!empty($product)):?>
    <div class="row col-lg-8 border rounded mx-auto mt-5 p-2 shadow-lg">
			<div class="col-md-4 text-center">
				<img src="<?=get_image($product['image'])?>" class="img-fluid rounded">
				<div>

            <?=esc($product['name'])?>
            <?=esc($product['price'])?>
            <?=esc($product['type'])?>
            <?=esc($product['description'])?>
        <?php
        endif;?>

<?php

if(!empty($product) && !empty($_SESSION['PROFILE'])): ?>
    <a href=<?php echo base_url('buypage?id=' . $product['id']); ?>>
        <button type="button" Class="button">BUY!</button>
    </a>
<?php endif;?>

<?php
if(!empty($product) && !empty($_SESSION['PROFILE'])): 
    if ($product['poster'] == $_SESSION['PROFILE']):?>
    <form method="post" onsubmit="collect_data(event, 'delete')">
    <div class="wrapper">
        <button type="submit" name="id" value="<?php echo $id?>">delete</button>
    </div>
</form>

<?php endif;?>
<?php endif;?>

<?php
if($bought != false): ?>
    <form method="post" onsubmit="collect_data(event, 'cancel_purchase')">
    <div class="wrapper">
        <button type="submit" name="id" value="<?php echo $id?>">cancel purchase</button>
    </div>
</form>

<?php endif;?>

<?php
if($bought != false): ?>
    <form method="post" onsubmit="collect_data(event, 'wishlist')">
    <div class="wrapper">
        <button type="submit" name="id" value="<?php echo $id?>">wishlist</button>
    </div>
</form>

<?php endif;?>

<?php
if(!isset($_GET['id']) || !$product):?>
<h1>
    Sorry we cant find that product
</h1>
<?php endif;

