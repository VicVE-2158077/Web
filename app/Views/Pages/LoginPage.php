<?php 
if(!isset($_SESSION)) 
{ 
    session_start(); 
} 
$path = $_SERVER['DOCUMENT_ROOT'];
$path .= "/java/functions.php";
require_once $path;

if (logged_in()) 
{
    header("Location: homepage");
    exit();
}
?>


<!DOCTYPE html>
<head>
    <meta charset="UTF-8">
    <script src="<?php echo base_url('java/Accounts.js'); ?>"></script>
    <link rel="stylesheet" type="text/css" href=<?php echo base_url('css/LoginPage.css'); ?>>
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('bootstrap-4.0.0-dist/css/bootstrap.min.css'); ?>">
    <title>Log in</title>
</head>


<form method="post" onsubmit="collect_data(event, 'log in')">   
    <div class="wrapper">
        <label for="Email"><h1>E-mail</h1></label>
        <input type="text" placeholder="Email" name="Email" required>

        <label for="Password"><h1>Password</h1></label>
        <input type="password" placeholder="Password" name="Password" required>
    
        <button type="submit">Login</button>
        <a href=<?php echo base_url()?>>
            <button type="button" Class="cancelButton">Cancel</button>
        </a>
    </div>
</form>