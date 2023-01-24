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
<form method="post" onsubmit="collect_data(event, 'review')">   
    <div class="wrapper">
        <label for="review"><h1>review</h1></label>
        <input type="text" placeholder="type review here" name="review" required>

        <label for="rating"><h1>rating</h1></label>
        <select name="rating">
            <option selected value="5">5</option>
            <option value="4">4</option>
            <option value="3">3</option>
            <option value="2">2</option>
            <option value="1">1</option>
        </select>
        <button type="submit" name="id" value="<?php echo $product['id']?>">post</button>
        <a href=<?php echo base_url()?>>
            <button type="button" Class="cancelButton">Cancel</button>
        </a>
    </div>
</form>
<?php endif;?>

<?php
if(!isset($_GET['id']) || !$product):?>
<h1>
    Sorry we cant find that product
</h1>
<?php endif;

