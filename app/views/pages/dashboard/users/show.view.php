<!DOCTYPE html>
<html lang="en">

<head>
  <?php

  use App\Core\Request;

  component('dashboard/head'); ?>
</head>

<body>
  <?php component('dashboard/navbar'); ?>
  <div class="container">
    <div class="row">

      <?php component('dashboard/sidebar'); ?>

      <!-- Page Content -->
      <div class="col-md-9">
        <div class="card">
          <h5 class="card-header"><i class="fas fa-star"></i> Register</h5>
          <div class="card-body">

            <div>
              First Name: <b><?= $user['first_name'] ?></b>
            </div>

            <div>
              Last Name: <b><?= $user['last_name'] ?></b>
            </div>

            <div>
              E-mail: <b><?= $user['email'] ?></b>
            </div>


            <div class="control-group">
              <!-- Button -->
              <div class="controls">
                <br>
                <a href="/dashboard/users/<?= $user['id'] ?>/edit" class="btn btn-success">Edit</a>
              </div>
            </div>
          </div>
        </div>
      </div>
      <!-- End .col-md-9 -->
    </div>
    <!-- End .row -->
  </div>
  <!-- End .container -->

  <?php component('dashboard/scripts'); ?>
</body>

</html>