<?php 

    if(!isset($_SESSION)) 
    { 
        session_start(); 
    } 
    $path = $_SERVER['DOCUMENT_ROOT'];
    $path .= "/java/functions.php";
    require_once $path;

?>

<!DOCTYPE html>
<head>
    <meta charset="UTF-8">
    <script src="<?php echo base_url('java/listing.js'); ?>"></script>
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('css/HomePage.css'); ?>">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('bootstrap-4.0.0-dist/css/bootstrap.min.css'); ?>">
    <title>Product</title>
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

<form method="post" onsubmit="collect_data(event, 'creatingProduct')">   
    <div class="wrapper">
        <label for="ProductName"><h1>ProductName</h1></label>
        <input type="text" placeholder="ProductName" name="ProductName" required>

        <label for="ProductPrice"><h1>ProductPrice</h1></label>
        <input type="number" placeholder="ProductPrice" name="ProductPrice" required>

        <label for="ProductType"><h1>ProductType</h1></label>
        <select name="ProductType">
            <option selected value="">--Select Product Type--</option>
            <option value="Energy Sharing">Energy Sharing</option>
            <option value="Gas">Gas</option>
            <option value="Oil">Oil</option>
            <option value="Wood">Wood</option>
        </select>
    
        <label for="region"><h1>region</h1></label>
        <input type="text" placeholder="region" name="region" required>

        <label for="Description"><h1>Description</h1></label>
        <input type="text" placeholder="Description" name="Description" required>

        <button type="upload">create</button>
        <a href="homepage.html">
            <button type="button" Class="cancelButton">Cancel</button>
        </a>
    </div>
</form>