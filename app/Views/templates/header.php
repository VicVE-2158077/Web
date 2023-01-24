<?php
if(!isset($_SESSION)) 
{ 
    session_start(); 
} 
$path = $_SERVER['DOCUMENT_ROOT'];
$path .= "/java/functions.php";
require_once $path;
?>


<!doctype html>
<html>
<head>
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('css/HomePage.css'); ?>">
</head>
<body>
<nav>
        <!--Menu-->
        <ul class = "header">
            <?php if (!logged_in()) { ?> 
            <li class = "header"><a href="<?php echo base_url('RegisterPage'); ?>">Register</a>
            <li class = "header"><a href="<?php echo base_url('LoginPage'); ?>">Log In</a></li>
            <?php } 
            else {?>
            <li class = "header"><a href="<?php echo base_url('ProfilePage'); ?>">Profile</a></li>
            <li class = "header"><a href="<?php echo base_url('CreateProduct'); ?>">Create</a></li>
            <li class = "header"><a href="<?php echo base_url('messenger'); ?>">Messenger</a></li>
            <li class = "header"><a href="<?php echo base_url('notification'); ?>">noti <?php
            $arr = [];
               $arr['user'] = $_SESSION['PROFILE'];
               $number = db_query("select * from notifications where person = :user", "notification_db", $arr);
               echo count($number);
            ?>
            </a></li>
            <?php }?> 
            <li class = "header"><a href="<?php echo base_url('ListingsPage'); ?>">Products</a></li>
            <li class = "header"><a href="<?php echo base_url(); ?>">Home</a></li>
        </ul>
    </nav>
    <div id="HomeBanner">
    </div>

