<?php
require_once('functions.php');
$title = "Manage Users";

$result = mysqli_query($connection, "SELECT * FROM users");

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <?php include('components/head.php'); ?>
</head>

<body>
  <?php include('components/navbar.php'); ?>
  <div class="container">
    <div class="row">

      <?php include('components/sidebar.php'); ?>

      <!-- Page Content -->
      <div class="col-md-9">
        <div class="card">
          <h5 class="card-header"><i class="fas fa-star"></i> Register</h5>
          <div class="card-body">
            <table class="table table-striped custab">
              <thead>
                <a href="create-user.php" class="btn btn-primary btn-xs pull-right mb-4"><b>+</b> Add new User</a>
                <tr>
                  <th>ID</th>
                  <th>Userame</th>
                  <th>Email</th>
                  <th>Role</th>
                  <th class="text-center">Action</th>
                </tr>
              </thead>
              <tbody>
                <?php
                while ($user = mysqli_fetch_array($result)) {
                ?>
                  <tr>
                    <td><?= $user['id'] ?></td>
                    <td><?= $user['username'] ?></td>
                    <td><?= $user['email'] ?></td>
                    <td><?= $user['role'] == 1 ? "Admin" : "User" ?></td>
                    <td class='text-center'>
                      <a class='btn btn-info btn-xs' href='#'><span class='glyphicon glyphicon-edit'></span> Edit</a>
                      <a href='delete-user.php?id=<?= $user['id'] ?>' class='btn btn-danger btn-xs'><span class='glyphicon glyphicon-remove'></span> Del</a>
                    </td>
                  </tr>
                <?php
                }
                ?>
              </tbody>
            </table>
          </div>
        </div>
      </div>
      <!-- End .col-md-9 -->
    </div>
    <!-- End .row -->
  </div>
  <!-- End .container -->

  <?php include('components/scripts.php'); ?>
</body>

</html>