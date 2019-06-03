<!doctype html>
<html lang="en">
  <head>
    <title>To do app V2</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <link rel="stylesheet" type="text/css" href="css/style.css">
  </head>
  <body>
  <?php require_once 'process.php'; ?>

  <?php

    if(isset($_SESSION['message'])):

  ?>

  <div class="alert alert-<?=$_SESSION['msg_type']?>">

      <?php
          echo $_SESSION['message'];
          unset($_SESSION['message']);
      ?>
  </div>
  <?php endif ?>



  <div class="container">
  <?php
    $mysqli = new mysqli('localhost', 'root', '', 'todo') or die(mysqli_error($mysqli));
    $result = $mysqli->query("SELECT * FROM tasks") or die($mysqli->error);
    //pre_r($result);
    ?>

      <div class="row">
        <table class="table">
            <thread>
                <tr>
                    <th>Tasks</th>
                    <th>Date</th>
                    <th colspan="2">Action</th>
                </tr>
            </thread>
            <?php
              while ($row = $result->fetch_assoc()):?>
                  <tr>
                      <td><?php echo $row['tasks']; ?></td>
                      <td><?php echo $row['date']; ?></td>
                      <td>
                          <A href="index.php?edit=<?php echo $row['id']; ?>" class="btn btn-info">Edit</a>
                          <a href="process.php?delete=<?php echo $row['id']; ?>" class="btn btn-danger">Delete</a>
                      </td>
                  </tr>
        <?php endwhile; ?>
        </table>
      </div>

    <?php
    function pre_r($array){
      echo '<pre>';
      print_r($array);
      echo '</pre>';
    }
    ?>

  <div class="row">
    <form action="process.php" method="POST">
    <div class="form-group">
    <label>Tasks</label>
    <input type="text" name="tasks" class="form-control" value="<?php echo $Tasks;?>" placeholder="Enter your tasks">
    </div>
    <div class="form-group">
    <label>Date</label>
    <input type="date" name="usr_date" value="<?php echo $user_date ?>" class="form-control" placeholder="Select a Date">
    </div>
    <div class="form-group">
    <?php
      if($update == true):
    ?>
    <button type="submit" class="btn btn-info" name="update">Update</button>
<?php
        else: 
?>
    <button type="submit" class="btn btn-info" name="save">Save</button>
        <?php endif; ?>
    </div>
    </form>
    </div>
    </div>

  </body>
  </html>