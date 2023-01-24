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

<div class="row col-lg-8 border rounded mx-auto mt-5 p-2 shadow-lg">
        <div class="col-md-4 text-center">
            <img src="<?php echo base_url('css/images/No_Image_Available.jpg')?>" class = "js-image img-fluid rounded" style="width: 180px;height:180px;object-fit: cover;">
            <div>
                <div class="mb-3">
                  <label for="formFile" class="form-label">Click below to select an image</label>
                  <input onchange="display_image(this.files[0])" class="js-image-input form-control" type="file" id="formFile">
                </div>
            </div>
        </div>
    
<form method="post" onsubmit="collect_data(event, 'register')">   
    <div class="wrapper">
        <label for="Username"><h1>Username</h1></label>
        <input type="text" placeholder="Userame" name="Username" required>

        <label for="Email"><h1>Email</h1></label>
        <input type="text" placeholder="Email" name="Email" required>

        <label for="Password"><h1>Password</h1></label>
        <input type="password" placeholder="Password" name="Password" required>
    
        <label for="RPassword"><h1>Repeat password</h1></label>
        <input type="password" placeholder="Repeat password" name="RPassword" required>
        <button type="submit">Register</button>
        <a href=<?php echo base_url()?>>
            <button type="button" Class="cancelButton">Cancel</button>
        </a>
    </div>
</form>
