<?php
require_once('functions.php');

$title = "Create User";

if (isset($_POST['submit'])) {
  $username = $_POST['username'];
  $email = $_POST['email'];
  $password = $_POST['password'];
  $password_confirm = $_POST['password_confirm'];

  if ($password != $password_confirm) die('Password must match Confirm Password');

  $add_user = "INSERT INTO users VALUES (NULL, '$email','$username', '$password')";
  $result = mysqli_query($connection, $add_user);
}
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
            <form class="form-horizontal" action="" method="POST">
              <fieldset>
                <div class="control-group">
                  <!-- Username -->
                  <label class="control-label" for="username">Username</label>
                  <div class="controls">
                    <input type="text" id="username" name="username" required placeholder="" class="form-control mr-sm-2" />
                    <p class="help-block">
                      Username can contain any letters or numbers, without
                      spaces
                    </p>
                  </div>
                </div>

                <div class="control-group">
                  <!-- E-mail -->
                  <label class="control-label" for="email">E-mail</label>
                  <div class="controls">
                    <input type="text" id="email" name="email" required placeholder="" class="form-control mr-sm-2" />
                    <p class="help-block">Please provide your E-mail</p>
                  </div>
                </div>

                <div class="control-group">
                  <!-- Password-->
                  <label class="control-label" for="password">Password</label>
                  <div class="controls">
                    <input type="password" id="password" name="password" required placeholder="" class="form-control mr-sm-2" />
                    <p class="help-block">
                      Password should be at least 4 characters
                    </p>
                  </div>
                </div>

                <div class="control-group">
                  <!-- Password -->
                  <label class="control-label" for="password_confirm">Password (Confirm)</label>
                  <div class="controls">
                    <input type="password" id="password_confirm" name="password_confirm" required placeholder="" class="form-control mr-sm-2" />
                    <p class="help-block">Please confirm password</p>
                  </div>
                </div>

                <div class="control-group">
                  <!-- Button -->
                  <div class="controls">
                    <button class="btn btn-success" type="submit" name="submit">Register</button>
                  </div>
                </div>
              </fieldset>
            </form>
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