<?php
  require_once("../../database/dbcontext.php");

  $id = "";
  
  if(!empty($_POST)){
    require_once("../../database/utility.php");
    $id = getPost('id');
    $sql = "delete from products where id = '$id'";
    execute($sql);
  }

  $sql = "select * from products";
  $productList = executeResult($sql);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Page</title>
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
        <div class="card-header bg-primary text-white h4 mb-3">
            <a href="add.php"><button class="btn btn-success">Add Product</button></a>
            Product Management
        </div>
        <div class="card-body">
            <table class="table table-bordered">
                <tr>
                    <th style="width: 50px">No</th>
                    <th>Title</th>
                    <th>Thumbnail</th>
                    <th>Price($)</th>
                    <th>Voucher</th>
                    <th>Created_at</th>
                    <th>Updated_at</th>
                    <th></th>
                    <th></th>
                </tr>
                <?php
                  if(!empty($productList)){
                    $counter = 0;
                    foreach($productList as $item){
                      echo  "<tr>
                                <th>". ++$counter ."</th>
                                <th>". $item['title'] ."</th>
                                <th><img style='width: 150px' src='". $item['thumbnail'] ."'></th>
                                <th>". $item['price'] ."</th>
                                <th>". $item['voucher'] ."</th>
                                <th>". $item['created_at'] ."</th>
                                <th>". $item['updated_at'] ."</th>
                                <th><a href='edit.php?id=". $item['id'] ."'><button class='btn btn-warning'>Edit</button></a></th>
                                <th><form method='post'><button class='btn btn-danger' onclick='remove(". $item['id'] .")'>Remove</button></form></th>
                            </tr>";
                    }
                  }
                ?>
            </table>
        </div>
    </div>
</body>
<script>
function remove(id) {
    confirm = confirm('Are you sure?');
    if (confirm) {
        $.post('index.php', {
            'id': id,
            'action': 'asdd'
        }, function(data) {
            location.reload();
        })
    }
}
</script>

</html>