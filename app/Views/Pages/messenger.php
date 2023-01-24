<!DOCTYPE html>
<head>
    <meta charset="UTF-8">
    <script src="<?php echo base_url('java/messages.js'); ?>"></script>
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('css/HomePage.css'); ?>">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('bootstrap-4.0.0-dist/css/bootstrap.min.css'); ?>">
    <title>messenger</title>
</head>

<?php
use CodeIgniter\HTTP\Message;

if(!isset($_SESSION)) 
{ 
    session_start(); 
} 
$path = $_SERVER['DOCUMENT_ROOT'];
$path .= "/java/functions.php";
require_once $path;






$id = $_SESSION['PROFILE'];
if(!isset($_GET['with'])){
$bought_from_users = db_query("select * from bought_product where buyer = :id", "bought_product_db", ['id'=>$id]);
if ($bought_from_users != false) {
foreach($bought_from_users as $bought_from_user)
?>
<a href=<?php echo base_url('messenger?with=' . $bought_from_user['poster']); ?>>
<button type="button" Class="button"><?=esc($bought_from_user['poster'])?>
<?php 
} else {
    echo "no messages";
}
?>

<?php

$rows = db_query("select distinct from_user from messages where to_user = :id", "direct_messenger_db", ['id'=>$id]);
if ($rows != false) {
    foreach ($rows as $row) 
    {?>
        <a href=<?php echo base_url('messenger?with=' . $row['from_user']); ?>>
        <button type="button" Class="button"><?= esc($row['from_user']) ?>
        <?php 
    }
} else {
    echo "no messages";
}
}
else
{
    $to = $_GET['with'];
    $message_data = [];
    $message_data['from'] = $_SESSION['PROFILE'];
    $message_data['to'] = $to;
    $messages = db_query("select * from messages where to_user = :to and from_user = :from or to_user = :from and from_user = :to ORDER BY timestamp", "direct_messenger_db", $message_data);
    if($messages != false){
    foreach($messages as $message)
    {
        echo $message['message'];
    }
    }?>
    <form method="post" onsubmit="collect_data(event, 'send')">   
    <div class="wrapper">
        <input type="text" placeholder="type here" name="message" required>
        <button type="submit" name="to" value="<?php echo $to?>">send</button>
    </div>
</form>

<?php }?>