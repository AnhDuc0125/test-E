<link rel="stylesheet" href="./css/navbar.css">

<nav>
    <div class="nav__container">
        <ul class="nav__list">
            <li class="nav__item id">
                <a href="#" class="nav__item--link" id="logo">
                    Cell<span class="highlight">Mart</span>
                </a>
            </li>
            <li class="nav__item">
                <div class="nav__item--link" id="search">
                    <input type="text" class="search__field">
                    <div class="search__btn">
                        <ion-icon name="search-outline"></ion-icon>
                    </div>
                </div>

            </li>
            <li class="nav__item link">
                <a href="#" class="nav__item--link" id="contact">
                    <div class="contact__box box">
                        <ion-icon class="icon__class" name="call-outline"></ion-icon>
                        <div class="contact__text">
                            <p>Contact Us</p>
                            <p>0909.0123</p>
                        </div>
                    </div>
                </a>
            </li>
            <li class="nav__item link">
                <a href="#" class="nav__item--link" id="cart">
                    <div class="cart__box box">
                        <ion-icon class="icon__class" name="cart-outline"></ion-icon>
                        <div class="cart__text">
                            <p>Your</p>
                            <p>Cart</p>
                        </div>
                    </div>
                </a>
            </li>
            <li class="nav__item link">
                <div class="nav__item--link" id="member">
                    <div class="member__box">
                        <ion-icon class="icon__class" name="person-circle-outline"></ion-icon>
                        <div class="member__text">
                            <p>
                                <?php
                                  if(isset($_SESSION['user'])){
                                      echo $_SESSION['user']['username'];
                                  } else {
                                      echo "Member";
                                  }
                                ?>
                            </p>
                        </div>
                    </div>
                </div>
            </li>
        </ul>
    </div>
</nav>