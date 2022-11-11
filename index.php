<!DOCTYPE html>

<?php include 'db.php';

$page = (isset($_GET['page']) ? (int)$_GET['page'] : 1);
$limit = (isset($_GET['limit']) && (int)($_GET['limit']) <= 10 ? (int)$_GET['limit'] : 5);
$offset = ($page > 1) ? ($page - 1) * $limit : 0;

$sql = "select * from tasks ORDER BY id DESC limit $limit offset $offset";
$total = $db->query("select * from tasks;")->num_rows;
$pages = $total / $limit;

$rows = $db->query($sql);
?>

<html lang="en">

<head>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>

  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">

  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>ToDo</title>

</head>

<body>

  <div class="container">

    <div class="row" style="margin-top: 70px;">
      <center>
        <h1>ToDo List</h1>
      </center>

      <div class="col-md-10 col-md-offset-1">
        <table class="table table-hover">
          <button type="button" data-target="#myModal" data-toggle="modal" class="btn btn-success">Add task</button>
          <button class="btn btn-default pull-right" onClick="print()">Print</button>
          <hr><br>

          <!-- Modal -->
          <div id="myModal" class="modal fade" role="dialog">
            <div class="modal-dialog">

              <!-- Modal content-->
              <div class="modal-content">
                <div class="modal-header">
                  <button type="button" class="close" data-dismiss="modal">&times;</button>
                  <h4 class="modal-title">Add New Task</h4>
                </div>
                <div class="modal-body">
                  <form method="post" action="add.php" >
                    <div class="form-goup">
                      <label for="">Task Name</label>
                      <br>
                      <input type="text" required name="task" placeholder="eg. ...clean a room" class="form-control">
                    </div>
                    <input type="submit" name="send" value="Add" class="btn btn-success" style="margin-top: 10px;">
                  </form>
                </div>
                <div class=" modal-footer">
                  <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
              </div>

            </div>
          </div>

          

            </div>
          </div>

          <div class="col-md-6 text-center">
            <form action="search.php" method="post" class="form-group">

              <input type="text" placeholder="Search" name="search" class="form-control">

            </form>

          </div>
          
          <br>
          <thead>
            <tr>
              <th scope="col">ID</th>
              <th scope="col">Task</th>

            </tr>
          </thead>
          <tbody>

          <?php while($row = $rows->fetch_assoc()): ?>

            <tr>
              <th scope="row"><?php echo $row['id']?></th>
              <td class="col-md-10"><?php echo $row['name']?></td>
              <td><a data-target="#updateModal-<?php echo $row['id'];?>" data-toggle="modal" class="btn btn-success" >Edit</a></td>
              <td><a href="delete.php?id=<?php echo $row['id'];?>" class="btn btn-danger">Delete</a></td>

            </tr>

            <!-- Modal -->
          <div id="updateModal-<?php echo $row['id'];?>" class="modal fade" role="dialog">
            <div class="modal-dialog">

              <!-- Modal content-->
              <div class="modal-content">
                <div class="modal-header">
                  <button type="button" class="close" data-dismiss="modal">&times;</button>
                  <h4 class="modal-title">Update Task</h4>
                </div>
                <div class="modal-body">
                  <form method="post" action="update.php" >
                    <div class="form-goup">
                      <label for="">Task Name</label>
                      <br>
                      <input type="hidden" name="name_id" value="<?php echo $row['id']?>"/>
                      <input type="text" required name="taskUpdate" value="<?php echo $row['name']?>" class="form-control">
                    </div>
                    <input type="submit" name="update" value="Update" class="btn btn-success" style="margin-top: 10px;">
                  </form>
                </div>
                <div class=" modal-footer">
                  <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
              </div>

            <?php endwhile; ?>

          </tbody>
        </table>
        <center>
          <ul class="pagination">
            <li>
              <?php for($i = 1; $i <= ceil($pages); $i++):  ?>
              <a href="?page=<?php echo $i; ?>&limit=<?php echo $limit; ?>"><?php echo $i; ?></a>

              <?php endfor; ?>
            </li>
          </ul>
        </center>
      </div>
    </div>

  </div>

</body>

</html>