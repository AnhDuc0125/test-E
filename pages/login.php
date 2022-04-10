<?php
    session_start();

    require_once('../database/dbcontext.php');
    require_once('../database/utility.php');
    if(!empty($_POST)){
        $email = getPost('email');
        $password = getPost('password', true);
        $sql = "select * from users where email = '$email' and password = '$password'";

        $user = executeResult($sql, true);

        if($user != null) {
            $_SESSION['user'] = $user;
            header("Location: index.php");
        }
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
    <link rel="stylesheet" href="./css/login.css">
</head>

<body>
    <div class="form__outer">
        <form method="post" id="form--login" class="modalBox">
            <ion-icon name="close-outline" class="close__btn"></ion-icon>
            <div class="modalBox__header">
                <h1>Login</h1>
                <?php
                    if(!empty($_POST)){
                        echo "<h5 style='color: red'>Wrong email or password!</h5>";
                    }
                ?>
            </div>
            <div class="modalBox__body">
                <div class="form__item">
                    <input class="inputField" type="text" id="email" name="email" placeholder="Email">
                    <span class="message"></span>
                </div>
                <div class="form__item">
                    <input class="inputField" type="password" id="password" name="password" placeholder="Password">
                    <span class="message"></span>
                </div>

                <div class="modalBox__footer">
                    <button class="btn btn__login invalid hide">Log in</button>
                    <a href="#" class="switch">
                        <p style="color: black">Create an account</p>
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
    form: "#form--login",
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