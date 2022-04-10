<?php
    session_start();
    
    $haveUsername = false;
    $haveEmail = false;
  if(!empty($_POST)){
      require_once('../database/dbcontext.php');
      require_once('../database/utility.php');

      $username = getPost('username');
      $fullname = getPost('fullname');
      $phoneNum = getPost('phone');
      $address = getPost('address');
      $email = getPost('email');
      $password = getPost('password', true);

      $checkUser = "select * from users where username = '$username'";
      $checkEmail = "select * from users where email = '$email'";

      $usernameResult = executeResult($checkUser, true);
      $emailResult = executeResult($checkUser, true);

      if($emailResult == null && $usernameResult == null){
          $sql = "insert into users(username, fullname, email, password, address, phone_num) values ('$username', '$fullname', '$email', '$password', '$address', '$phoneNum')";
          execute($sql);

          $idSql = "select * from users where email = '$email'";
          $user = executeResult($idSql, true);

          $cartSql = "insert into cart(user_id) values ('". $user['id'] ."')";
          execute($cartSql);
          
          header("Location: login.php");
      }

      $haveUsername = true;
      $haveEmail = true;
  }
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign up</title>
    <link rel="stylesheet" href="./css/master.css">
    <link rel="stylesheet" href="./css/signup.css">
</head>

<body>
    <div class="form__outer">
        <form method="post" id="form--signup" class="modalBox">
            <ion-icon name="close-outline" class="close__btn"></ion-icon>
            <div class="modalBox__header">
                <h1>Signup</h1>
            </div>
            <div class="modalBox__body">
                <div class="form__item">
                    <input class="inputField" type="text" id="username" name="username" placeholder="Username">
                    <span class="message">
                        <?php 
                            if($haveUsername == true){
                                echo "Đã có username này!";
                            }
                        ?>
                    </span>
                </div>
                <div class="form__item">
                    <input class="inputField" type="text" id="fullname" name="fullname" placeholder="Full name">
                    <span class="message">
                        <?php 
                            if($haveEmail == true){
                                echo "Email này đã được sử dụng!";
                            }
                        ?>
                    </span>
                </div>
                <div class="form__item">
                    <input class="inputField" type="text" id="address" name="address" placeholder="Address">
                    <span class="message"></span>
                </div>
                <div class="form__group double">
                    <div class="form__item">
                        <input class="inputField" type="email" id="email" name="email" placeholder="Email">
                        <span class="message"></span>
                    </div>
                    <div class="form__item">
                        <input class="inputField" type="number" id="phone" name="phone" placeholder="Phone number">
                        <span class="message"></span>
                    </div>
                </div>
                <div class="form__group double">
                    <div class="form__item">
                        <input class="inputField" type="password" id="password" name="password" placeholder="Password">
                        <span class="message"></span>
                    </div>
                    <div class="form__item">
                        <input class="inputField" type="password" id="passwordConfirm" placeholder="Confirm">
                        <span class="message"></span>
                    </div>
                    <!-- </div>
                            Your password must have:
                            <ul>
                                <li>- At least 8 characters</li>
                                <li>- At least 1 uppercase letter</li>
                                <li>- At least 1 lowercase letter</li>
                                <li>- At least 1 number</li>
                                <li>- At least 1 special character</li>
                            </ul> -->
                </div>
                <div class="modalBox__footer">
                    <button class="btn btn__signup invalid hide">Sign up</button>
                    <a href="#" class="switch">
                        <p style="color: black">Already have an account?</p>
                    </a>
                </div>
            </div>
        </form>
    </div>
</body>
<!-- Javascript -->
<script src="./js/validation.js"></script>
<script>
//Validation Input
validateForm({
    form: "#form--signup",
    rules: [
        isRequired("#username"),
        isRequired("#fullname"),
        isRequired("#email"),
        isRequired("#phone"),
        isRequired("#password"),
        isRequired("#passwordConfirm"),
        minLength("#username", 5),
        minLength("#fullname", 7),
        isEmail("#email"),
        isPhone("#phone"),
        isStrongPw("#password"),
        confirmPassword("#passwordConfirm", function() {
            return document.querySelector("#password").value;
        }),
    ],
});
</script>

</html>