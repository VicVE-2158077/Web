<?php 
    if(!isset($_SESSION)) 
    { 
        session_start(); 
    } 
    $path = $_SERVER['DOCUMENT_ROOT'];
    $path .= "/java/functions.php";
    require_once $path;

    if (!logged_in()) 
    {
        header("Location: LoginPage");
        exit();
    }
	$email = $_SESSION['PROFILE'];
	$account = db_query("select * from users where Email = :email limit 1", "profile_db",['email'=>$email]);

	$listings = db_query("select * from products where poster = :email", "productlistings_db",['email'=>$email]);

    $pending_buys = db_query("select * from bought_product where buyer = :email", "bought_product_db",['email'=>$email]);
?>

<!DOCTYPE html>
<head>
    <meta charset="UTF-8">
    <script src="<?php echo base_url('java/Accounts.js'); ?>"></script>
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('bootstrap-4.0.0-dist/css/bootstrap.min.css'); ?>">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('css/profilePage.css'); ?>">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('css/products.css'); ?>">

    <title>Profile</title>
</head>
<div class="card shadow mt-3">
	<img src="<?=get_image($account[0]['Image'])?>" class="img-fluid rounded">

    <div class="h2"><?=esc($account[0]['Username'])?></div>
    <table class="table-striped">
        <?php if($account != false):?>
        <tr><th>Email</th><td><?=esc($account[0]['Email'])?></td></tr>

        <?php if(!empty($listings)):?>
                <tr><th>listings</th><td>
                    <ul class="products">
        <?php foreach($listings as $listing):?>
            <li class="product">
            <a href=<?php echo base_url('ProductPage?id=' . $listing['id']); ?>>
            <button type="button" Class="button"><?=esc($listing['name'])?>
            <?php if($listing['image'] != null):?>
                                    <img class = "onbutton" src="<?=get_image($listing['image'])?>">
                                    <?php endif;?></button>
            </a>
            </li>
        <?php endforeach;
endif;?></td></tr>
<?php if(!empty($pending_buys)):?>
                <tr><th>pending purchases</th><td>
                    <ul class="products">
        <?php foreach($pending_buys as $pending_buy):
                        $arr = [];
                        $arr['id'] = $pending_buy['id'];
                        $buy = db_query("select * from products where id = :id", "productlistings_db",$arr);
                        $buy = $buy[0]
                        ?>
                        <li class="product">
            <a href=<?php echo base_url('ProductPage?id=' . $buy['id']); ?>>
    <button type="button" Class="button"><?=esc($buy['name'])?>
    <?php if($buy['image'] != null):?>
                                    <img class = "onbutton" src="<?=get_image($buy['image'])?>">
                                    <?php endif;?></button>
</a>
                        </li>
        <?php endforeach;?>
                    </ul>
        <?php
endif;?></td></tr>
        <?php endif;?>

    </table>
</div>
<a href="<?php echo base_url('logout'); ?>">
    <button type="button" Class="Logout">Logout</button>
</a>

<form method="post" onsubmit="collect_data(event, 'delete')">
    <div class="wrapper">
        <button type="submit" name="email" value="<?php echo $_SESSION['PROFILE'] ?>">delete</button>
    </div>
</form>
