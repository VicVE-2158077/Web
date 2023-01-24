<!DOCTYPE html>
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('bootstrap-4.0.0-dist/css/bootstrap.min.css'); ?>">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('css/products.css'); ?>">
    <title>listings</title>
    <meta name="description" content="Energy emporium">
</head>

<?php 
    if(!isset($_SESSION)) 
    { 
        session_start(); 
    } 
    $path = $_SERVER['DOCUMENT_ROOT'];
    $path .= "/java/functions.php";
    require_once $path;
?>
            <div class="col-md-3">
                <form action="" method="GET">
                    <div class="float-left card shadow mt-3">
                        <div class="card-header">
                            <h5>Filter 
                                <button type="submit" class="btn btn-primary btn-sm float-end">Search</button>
                            </h5>
                        </div>
                        <div class="card-body">
                            <h6>Energy types</h6>
                            <hr>
                            <?php
                                $rows = db_query("select distinct type from products", "productlistings_db");
                            if ($rows != false) {
                                    foreach ($rows as $row) {
                                        $checked = [];
                                        if (isset($_GET['type'])) {
                                            $checked = $_GET['type'];
                                        }
                                        ?>
                                            <div>
                                                <input type="checkbox" name="type[]" value="<?= $row['type']; ?>" 
                                                    <?php if (in_array($row['type'], $checked)) {
                                                        echo "checked";
                                                    } ?>
                                                 />
                                                <?= $row['type']; ?>
                                            </div>
                                        <?php
                                    }
                                } else {
                                    echo "No types available please check back later";
                                }
                            ?>

                            <label for="MaxPrice"><h1>max price</h1></label>
                            <input type="number" min="1" placeholder="" value = "500" name="maxprice">
                            <?php if(isset($_GET['maxprice'])){ echo $_GET['maxprice']; }?>

                            <label for="minPrice"><h1>min price</h1></label>
                            <input type="number" min="1" placeholder="" value = "1" name="minprice">
                            <?php if(isset($_GET['minprice'])){ echo $_GET['minprice']; }?>
                            </div>
                    </div>
                            </div>
                            <div class="float right card shadow mt-3">
                            <?php
                            $filters = [];
                            $filters['type'] = [];


                            if (isset($_GET['type'])) {
                                foreach ($_GET['type'] as $selectedtype):
                                    $given_filters = [];
                                    $given_filters['type'] = $selectedtype;
                                    $minprice_qry = "";
                                    $maxprice_qry = "";
                                    if (isset($_GET['maxprice'])) {
                                        $given_filters['max'] = $_GET['maxprice'];
                                        $maxprice_qry = " and price <= :max";
                                    }
                                    if (isset($_GET['minprice'])) {
                                        $given_filters['min'] = $_GET['minprice'];
                                        $minprice_qry = " and price >= :min";
                                    }

                                    $rows = db_query("select * from products where type = :type".$minprice_qry . $maxprice_qry, "productlistings_db", $given_filters);
                                    if ($rows != false) {
                                        ?><ul class="products"><?php
                                        foreach ($rows as $row): ?>
                                        <li class="product">
                                    <a href=<?php echo base_url('ProductPage?id=' . $row['id']); ?>>
                                    <button type="button" Class="button"><?=esc($row['name'])?>
                                    <?php if($row['image'] != null):?>
                                        <img class = "onbutton" src="<?=get_image($row['image'])?>">
                                    <?php endif;?></button>
                                </a>
                                </button>
                                    </li>
                                        <?php endforeach;
                                        ?></ul><?php
                                    }
                                endforeach;
                            }
                            ?>
                        </div>
                    </div>
                </form>
                            </div>


