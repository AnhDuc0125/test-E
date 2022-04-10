<?php
  function getMD5code($value){
    $value = md5("ducanhvu".$value."vuducanh");
    return $value;
  }

  function getPost($key, $isPassword = false, $slash = "\'") {
    if(isset($_POST[$key])){
      //Get value from POST method
      $OriginValue = $_POST[$key];

      //Fix syntax value
      $perfectValue = str_replace($slash, "\\".$slash, $OriginValue);
    }
    if($isPassword == true) {
      $perfectValue = getMD5code($perfectValue);
    }
    return $perfectValue;
  }

  function getGet($key, $slash = "\'") {
    if(isset($_GET[$key])){
      //Get value from GET method
      $OriginValue = $_GET[$key];
      
      //Fix syntax value
      $perfectValue = str_replace($slash, "\\".$slash, $OriginValue);
      
      return $perfectValue;
    }
  }

  function validateLogin(){
    if(isset($_SESSION['currentUser'])){
      return $_SESSION['currentUser'];
    }

    if(isset($_COOKIE['token'])){
      $token = $_COOKIE['token'];
      $query = "select * from users where token = '$token'";
      $currentUser = executeResult($query, true);
      if($currentUser != null){
        $_SESSION['currentUser'] = $currentUser;
        return $currentUser;
      }
    }
    return null;
  }

  function href($string){
    $string = trim($string);
    $string = str_replace(['a', 'á', 'à', 'ã', 'ạ', 'ả'], 'a', $string);
    $string = str_replace(['ă', 'ắ', 'ằ', 'ẵ', 'ặ', 'ẳ'], 'a', $string);
    $string = str_replace(['â', 'ấ', 'ầ', 'ẫ', 'ậ', 'ẩ'], 'a', $string);
    $string = str_replace('đ', 'd', $string);
    $string = str_replace(['e', 'é', 'è', 'ẽ', 'ẹ', 'ẻ'], 'e', $string);
    $string = str_replace(['ê', 'ế', 'ề', 'ễ', 'ệ', 'ể'], 'e', $string);
    $string = str_replace(['i', 'í', 'ì', 'ĩ', 'ị', 'ỉ'], 'i', $string);
    $string = str_replace(['o', 'ó', 'ò', 'õ', 'ọ', 'ỏ'], 'o', $string);
    $string = str_replace(['ô', 'ố', 'ồ', 'ỗ', 'ộ', 'ổ'], 'o', $string);
    $string = str_replace(['ơ', 'ớ', 'ờ', 'ỡ', 'ợ', 'ở'], 'o', $string);
    $string = str_replace(['u', 'ú', 'ù', 'ũ', 'ụ', 'ủ'], 'u', $string);
    $string = str_replace(['ư', 'ứ', 'ừ', 'ữ', 'ự', 'ử'], 'u', $string);
    $string = str_replace(['y', 'ý', 'ỳ', 'ỹ', 'ỵ', 'ỷ'], 'y', $string);
    $string = str_replace(' ', '-', $string);

    return $string;
  }

  function priceVali($rawPrice){
    $rawPrice = str_replace([',', '.'], '', $rawPrice);
    $rawPrice = trim($rawPrice);
    return $price = number_format($rawPrice);
  }
?>