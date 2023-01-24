<?php
use Config\Session;

if(!isset($_SESSION)) 
{ 
    session_start(); 
} 
$path = $_SERVER['DOCUMENT_ROOT'];
$path .= "/java/functions.php";
require_once $path;

$data = [];
$data['user'] = $_SESSION['PROFILE'];
$purchased_list = db_query("select * from bought_product where poster = :user", "bought_product_db", $data);
?>
<!DOCTYPE html>
<head>
    <meta charset="UTF-8">
    <script src="<?php echo base_url('java/listing.js'); ?>"></script>
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('bootstrap-4.0.0-dist/css/bootstrap.min.css'); ?>">
    <title>Store Name</title>
    <meta name="description" content="Energy emporium">
</head>
<body>
<div id="Page">
    <!--Main-->
    <div>
        <!--Home Text-->
        <section id="home-text">
            <?php
            if($purchased_list != false): 
            foreach($purchased_list as $purchased)
            {
                $data = [];
                $data['id'] = $purchased['id'];
                $product = db_query("select * from products where id = :id", "productlistings_db", $data);
                $product = $product[0];?>
                <form method="post" onsubmit="collect_data(event, 'finished')">
                    <button type="transparant" name="buyer" value="<?php echo $purchased['buyer']?>"></button>
                    <div class="wrapper">
                        <button type="submit" name="id" value="<?php echo $product['id']?>"><?php echo $purchased['buyer']?> has bought <?php echo $product['name']?></button>
                    </div>
                </form>
            </a>
            <?php }
            endif;?>
        </section>
    </div>
</div>
</body>