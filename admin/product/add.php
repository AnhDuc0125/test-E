<?php
  require_once("../../database/dbcontext.php");
    if(!empty($_POST)){
  require_once("../../database/utility.php");
        $title = getPost('title');
        $thumbnail = getPost('thumbnail');
        $price = getPost('price');
        $price = priceVali($price);
        $star = getPost('star');
        $voucher = getPost('voucher');
        $manu = getPost('manufacturer');
        $status = getPost('status');
        $cate = getPost('category');
        $detail = getPost('detail');
        $updatedAt = $createdAt = date("Y-m-d H:i:s");
        $hrefParam = href($title);

        $sql = "insert into products (title, thumbnail, price, star, voucher, manufacturer_id, status_id, category_id, detail, created_at, updated_at, href_param) values ('$title', '$thumbnail', '$price', '$star', '$voucher', '$manu', '$status', '$cate', '$detail', '$createdAt', '$updatedAt', '$hrefParam')";
        execute($sql);

        header("Location: index.php");
    }

  $sql = "select * from manufacturers";
  $manuList = executeResult($sql);

  $sql = "select * from status";
  $statusList = executeResult($sql);

  $sql = "select * from categories";
  $cateList = executeResult($sql);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add</title>
    <!--bootstrap 5 and Jquery cdn -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous">
    </script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"
        integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>

</head>

<body>
    <div class="card m-5">
        <div class="card-header bg-primary text-white h4 mb-3">Add new product</div>
        <div class="card-body">
            <form method="POST">
                <div class="form-floating mb-3">
                    <input required type="text" class="form-control" name="title" id="floatingInput"
                        placeholder="name@example.com">
                    <label for="floatingInput" style="text-transform: capitalize">title</label>
                </div>
                <div class="form-floating mb-3">
                    <input required type="text" class="form-control" name="thumbnail" id="floatingInput"
                        placeholder="name@example.com">
                    <label for="floatingInput" style="text-transform: capitalize">thumbnail</label>
                </div>
                <div class="form-floating mb-3">
                    <input required type="number" class="form-control" name="price" id="floatingInput"
                        placeholder="name@example.com">
                    <label for="floatingInput" style="text-transform: capitalize">price</label>
                </div>

                <div class="form-floating mb-3">
                    <input type="number" class="form-control" name="star" id="floatingInput"
                        placeholder="name@example.com">
                    <label for="floatingInput" style="text-transform: capitalize">star</label>
                </div>
                <div class="form-floating mb-3">
                    <input type="text" class="form-control" name="voucher" id="floatingInput"
                        placeholder="name@example.com">
                    <label for="floatingInput" style="text-transform: capitalize">voucher</label>
                </div>
                <label for="">Manufacturer:</label>
                <select class="form-select mb-3" aria-label="Default select example" name="manufacturer">
                    <option selected>Open this select menu</option>
                    <?php
                      foreach($manuList as $item){
                          echo "<option value='". $item['id'] ."'>". $item['name'] ."</option>";
                      }
                    ?>
                </select>
                <label for="">Status:</label>
                <select class="form-select mb-3" aria-label="Default select example" name="status">
                    <option selected>Open this select menu</option>
                    <?php
                      foreach($statusList as $item){
                          echo "<option value='". $item['id'] ."'>". $item['name'] ."</option>";
                      }
                    ?>
                </select>
                <label for="">Category:</label>
                <select class="form-select mb-3" aria-label="Default select example" name="category">
                    <option selected>Open this select menu</option>
                    <?php
                      foreach($cateList as $item){
                          echo "<option value='". $item['id'] ."'>". $item['name'] ."</option>";
                      }
                    ?>
                </select>
                <div class="form-group mb-3">
                    <label for="exampleFormControlTextarea1">Detail: </label>
                    <textarea class="form-control" id="exampleFormControlTextarea1" rows="5" name="detail"></textarea>
                </div>
                <button type="submit" class="btn btn-success">Add</button>
                <a href="index.php"><button type="button" class="btn btn-warning">Back</button></a>
            </form>
        </div>
    </div>
</body>