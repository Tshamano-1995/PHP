<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">

    <title>PHP CRUD</title>
  </head>

  <body>
    <?php require_once 'process.php'; ?>

    <?php
    if (isset($_SESSION['message'])): ?>
    <div class="alert alert-<?=$_SESSION['msg_type']?>">

      <?php
        echo $_SESSION['message'];
        unset($_SESSION['message']);
      ?>
    </div>
    <?php endif?>
    
    <div class="container">

    <?php
        $mysqli = new mysqli('localhost','root','','crud') or die(mysql_error($mysqli));
        $result = $mysqli->query("SELECT * FROM data") or die($mysqli->error);
        // pre_r($result);
        // pre_r($result->fetch_assoc());
    ?>
      <div class="row justify-content-center">
        <table class="table">
          <thead>
            <tr>
              <th>Name</th>
              <th>Location</th>
              <th colspan="2">Action</th>
            </tr>
          </thead>

      <?php
        while ($row = $result->fetch_assoc()): ?>
          <tr>
            <td><?php echo $row['name']; ?></td>
            <td><?php echo $row['location']; ?></td>
            <td>
              <a href= "index.php?edit&id=<?php echo $row['id']; ?>"
                class=" btn btn-info">Edit</a>
              <a href="process.php?delete=<?php echo $row['id']; ?>"
                class=" btn btn-danger">delete</a>


            </td>
          </tr>
        
        <?php endwhile; ?>


      ?>
        </table>
      </div>

    <?php
        function pre_r( $array){
            echo '<pre>';
            print_r($array);
            echo '</pre>';
        }      
    ?>


    <div class="row justify-content-center">
    <form action="process.php" method="POST">
    <input type="hidden" name="id" value="<?php echo $id; ?>">
        <div class="form-group">
        <label>Name</label>
        <input type="text" name="name" class="form-control"
         value="<?php echo $name; ?>" placeholder="Enter your name">
        </div>

        <div class="form-group">
        <label>Location</label>
        <input type="text" name="location" 
        value="<?php echo $location; ?>" class="form-control" placeholder="Enter your location">
        </div>

        <div class="form-group">
        <?php
        if ($update == true):
        ?>
          <button type="submit" class="btn btn-info" name="update">update</button>
        <?php else: ?>
          <button type="submit" class="btn btn-primary" name="save">save</button>
        <?php endif; ?>

        </div>

    </form>
    </div>
    </div>







    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js" integrity="sha384-JEW9xMcG8R+pH31jmWH6WWP0WintQrMb4s7ZOdauHnUtxwoG2vI5DkLtS3qm9Ekf" crossorigin="anonymous"></script>

    <!-- Option 2: Separate Popper and Bootstrap JS -->
    <!--
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.1/dist/umd/popper.min.js" integrity="sha384-SR1sx49pcuLnqZUnnPwx6FCym0wLsk5JZuNx2bPPENzswTNFaQU1RDvt3wT4gWFG" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.min.js" integrity="sha384-j0CNLUeiqtyaRmlzUHCPZ+Gy5fQu0dQ6eZ/xAww941Ai1SxSY+0EQqNXNE6DZiVc" crossorigin="anonymous"></script>
    -->
  </body>
</html>