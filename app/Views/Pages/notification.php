
<?php

if(!isset($_SESSION)) 
{ 
    session_start(); 
} 
$path = $_SERVER['DOCUMENT_ROOT'];
$path .= "/java/functions.php";
require_once $path;
$user = [];
$user['user'] = $_SESSION['PROFILE'];

$notifs = db_query("select * from notifications where person = :user", "notification_db", $user);

?>
<!DOCTYPE html>
<head>
    <meta charset="UTF-8">
    <script src="<?php echo base_url('java/listing.js'); ?>"></script>
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('css/HomePage.css'); ?>">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('bootstrap-4.0.0-dist/css/bootstrap.min.css'); ?>">
    <title>Product</title>
</head>
<ul>
<?php
if ($notifs != false) {
    foreach ($notifs as $notif) {
        if ($notif['type'] == "finished") 
        { ?> 
            <li>
            <a href=<?php echo base_url('reviewpage?id=' . $notif['productid']); ?>>
                <button type="button" Class="button"><?php echo $notif['notif'] ?> </button>
            </a>
        </li>
        <?php } 
        elseif ($notif['type'] == "buy") 
        {?>
            <a href=<?php echo base_url('purchased'); ?>>
                <button type="button" Class="button"><?php echo $notif['notif'] ?> </button>
            </a>
        <?php } 
        elseif ($notif['type'] == "cancel_purchase") 
        {?>
            <a href=<?php echo base_url('purchased'); ?>>
                <button type="button" Class="button"><?php echo $notif['notif'] ?> </button>
            </a>
        <?php } 
        elseif ($notif['type'] == "available") 
        {?>
            <a href=<?php echo base_url('productpage?id=' . $notif['productid']); ?>>
                <button type="button" Class="button"><?php echo $notif['notif'] ?> </button>
            </a>
        <?php } 
    }
}
else
{?>
no notifications
<?php }?>
