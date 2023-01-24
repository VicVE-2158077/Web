<!DOCTYPE html>
<head>
    <meta charset="UTF-8">
    <script src="<?php echo base_url('java/listing.js'); ?>"></script>
    <link rel="stylesheet" type="text/css" href=<?php echo base_url('css/LoginPage.css'); ?>>
    <link rel="stylesheet" type="text/css" href=<?php echo base_url('css/buypage.css'); ?>>
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('bootstrap-4.0.0-dist/css/bootstrap.min.css'); ?>">
    <title>BuyPage</title>
</head>
<?php 
if(!isset($_SESSION)) 
{ 
    session_start(); 
} 
$path = $_SERVER['DOCUMENT_ROOT'];
$path .= "/java/functions.php";
require_once $path;
if(isset($_GET['id']))
{
    $id = $_GET['id'];
    $product = db_query("select * from products where id = :id limit 1", "productlistings_db", ['id'=>$id]);
    $product = $product[0];
    if($product):?>
    
    <img src="<?=get_image($product['image'])?>">

    <table class="table-striped">

        <tr><th>Name</th><td><?=esc($product['name'])?></td></tr>
        <tr><th>Price</th><td><?=esc($product['price'])?></td></tr>
        <tr><th>Product type</th><td><?=esc($product['type'])?></td></tr>
        <tr><th>Region</th><td><?=esc($product['region'])?></td></tr>
        <tr><th>Sold by</th><td><?=esc($product['poster'])?></td></tr>
    </table>
        <form method="post" onsubmit="collect_data(event, 'buy')">   
    <div class="wrapper">
        <button type="submit" name="id" value="<?php echo $id?>">BUY</button>
        <a href=<?php echo base_url('ProductPage?id=' . $id)?>>
            <button type="button" Class="cancelButton">Cancel</button>
        </a>
    </div>
</form>
    <?php endif;
?>


<?php
}
if(!isset($_GET['id']) || !$product):?>
<h1>
    Sorry we cant find that product
</h1>
<?php endif;