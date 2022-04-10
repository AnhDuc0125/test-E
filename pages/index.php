<?php
  require_once("../database/dbcontext.php");
  session_start();

  //best seller query
  $sql = "select products.* from products, categories where products.category_id = categories.id and categories.name = 'Best seller' limit 10";
  $bestSellerList = executeResult($sql);

  //on sale query
  $sql = "select products.* from products, categories where products.category_id = categories.id and categories.name = 'On sale' limit 10";
  $onSellList = executeResult($sql);

  //popular products query
  $sql = "select products.* from products, categories where products.category_id = categories.id and categories.name = 'Popular' limit 10";
  $popularList = executeResult($sql);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
    <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
    <link rel="stylesheet" href="./css/master.css">
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
            <div id="best__seller" class="component">
                <br>
                <h1>Best Seller</h1>
                <br>
                <div class="card__container">
                    <?php
                      foreach($bestSellerList as $item){
                          echo '<a href="product.php?title='. $item['href_param'] .'" class="card">
                                    <div class="card__image">
                                        <img src="'. $item['thumbnail'] .'"
                                            alt="">
                                    </div>
                                    <div class="card__content">
                                        <h3 class="card__title">'. $item['title'] .'</h3>
                                        <p class="card__price">'. $item['price'] .'</p>
                                    </div>
                                </a>';
                      }
                    ?>
                </div>
            </div>
            <div id="on__sale" class="component">
                <h1>On Sale</h1>
                <br>
                <div class="card__container">
                    <?php
                      foreach($onSellList as $item){
                          echo '<a href="product.php?title='. $item['href_param'] .'" class="card">
                                    <div class="card__image">
                                        <img src="'. $item['thumbnail'] .'"
                                            alt="">
                                    </div>
                                    <div class="card__content">
                                        <h3 class="card__title">'. $item['title'] .'</h3>
                                        <p class="card__price">'. $item['price'] .'</p>
                                    </div>
                                </a>';
                      }
                    ?>
                </div>
            </div>
            <div id="popular" class="component">
                <h1>Popular</h1>
                <br>
                <div class="card__container">
                    <?php
                      foreach($popularList as $item){
                          echo '<a href="product.php?title='. $item['href_param'] .'" class="card">
                                    <div class="card__image">
                                        <img src="'. $item['thumbnail'] .'"
                                            alt="">
                                    </div>
                                    <div class="card__content">
                                        <h3 class="card__title">'. $item['title'] .'</h3>
                                        <p class="card__price">'. $item['price'] .'</p>
                                    </div>
                                </a>';
                      }
                    ?>
                </div>
            </div>
        </div>

</body>
<script src="./js/slider.js"></script>

</html>