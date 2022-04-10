<?php
  include_once("config.php");

  function executeResult($query, $isOnly = false){
    $connect = new mysqli(HOST, ROOT, PASSWORD, DATABASE);

    if($connect -> connect_error) {
      die("Failed to connect to DATABASE".$connect -> connect_error);
    }

    $connect -> set_charset("utf8");

    $resultSet = $connect -> query($query);
 
    $connect -> close();
    if($isOnly){
      $data = mysqli_fetch_assoc($resultSet);
    } else {
      $data = [];
      while($rows = mysqli_fetch_assoc($resultSet)){
        $data[] = $rows;
      }
    }
    return $data;
  }

  function execute($query) {
    $connect = new mysqli(HOST, ROOT, PASSWORD, DATABASE);

    if($connect -> connect_error){
      die("Failed to connect to DATABASE".$connect -> connect_error);
    }

    $connect -> set_charset("utf8");

    $connect -> query($query);

    $connect -> close();

    return true;
  }
?>