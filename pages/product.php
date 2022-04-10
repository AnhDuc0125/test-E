<?php
  session_start();
    
  if(!empty($_GET['title'])){
      require_once('../database/utility.php');
      require_once('../database/dbcontext.php');
      $href = getGet('title');
      $sql = "select * from products where href_param = '$href'";
      $product = executeResult($sql, true);
  }

  if(!empty($_POST)){
    if(!isset($_SESSION['user'])){
        header("Location: login.php");
    }
    
    require_once('../database/utility.php');
    require_once('../database/dbcontext.php');
    
    $product_id = getPost('product_id');
    $quantity = getPost('quantity');
    $price = $product['price'];
    
    $rawPrice = str_replace(',', '', $price);
    
    $totalPrice = $quantity * $rawPrice;
    $createdAt = $updatedAt = date('Y-m-d H:i:s');

    if($product_id){
        //get cart of user
        $sqlCart = "select cart.* from users, cart where users.id = cart.user_id and cart.user_id = ". $_SESSION['user']['id'] ."";
        $cart = executeResult($sqlCart, true);

        //create a order
        $sql = "insert into orders(product_id, quantity, price, total_price, created_at, updated_at, cart_id) values ('$product_id', '$quantity', '$price', '$totalPrice', '$createdAt', '$updatedAt', '". $cart['id'] ."')";
        execute($sql);

        
    }
      
  }
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product</title>
    <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
    <link rel="stylesheet" href="./css/master.css">
    <link rel="stylesheet" href="./css/product.css">
</head>

<body>
    <!-- navbar start -->
    <?php
        include_once('layout/navbar.php');
    ?>
    <!-- navbar end -->

    <div id="body__container">
        <div id="body__container--header">
            <div class="manufacturer">
                <ul class="manufacturer__items">
                    <li class="manufacturer__item">
                        <a href="#" class="manufacturer__link">Apple</a>
                    </li>
                    <li class="manufacturer__item">
                        <a href="#" class="manufacturer__link">Samsung</a>
                    </li>
                    <li class="manufacturer__item">
                        <a href="#" class="manufacturer__link">Oppo</a>
                    </li>
                    <li class="manufacturer__item">
                        <a href="#" class="manufacturer__link">Huawei</a>
                    </li>
                    <li class="manufacturer__item">
                        <a href="#" class="manufacturer__link">Xiaomi</a>
                    </li>
                    <li class="manufacturer__item">
                        <a href="#" class="manufacturer__link">Nokia</a>
                    </li>
                    <li class="manufacturer__item">
                        <a href="#" class="manufacturer__link">Blackberry</a>
                    </li>
                    <li class="manufacturer__item">
                        <a href="#" class="manufacturer__link">LG</a>
                    </li>
                    <li class="manufacturer__item">
                        <a href="#" class="manufacturer__link">Sony</a>
                    </li>
                    <li class="manufacturer__item">
                        <a href="#" class="manufacturer__link">HTC</a>
                    </li>
                    <li class="manufacturer__item">
                        <a href="#" class="manufacturer__link">Lenovo</a>
                    </li>
                </ul>
            </div>
            <div class="slider">
                <div class="sliderImages">
                    <ion-icon name="chevron-back-outline" class="icon prev"></ion-icon>
                    <img src="photos/img1.png" />
                    <ion-icon name="chevron-forward-outline" class="icon next"></ion-icon>
                </div>
            </div>
        </div>
        <div id="body__container--main">
            <div class="product">
                <h2 class="title"><?=$product['title']?></h2>

            </div>
            <form method="post">
                <input type="number" name="quantity" value="1" min="1" max="3">
                <input type="hidden" name="product_id" value="<?=$product['id']?>">
                <button class="btn-add" name="action" value="addToCart">Add to cart</button>
            </form>
        </div>
</body>
<script src="./js/slider.js"></script>

</html>