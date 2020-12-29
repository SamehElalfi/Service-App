<?php
require_once('functions.php');
$title = "Manage Freelancer";

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
          <h5 class="card-header"><i class="fas fa-star"></i> Freelancers</h5>
          <div class="card-body">

            <select name="freelancers" id="freelancers">
              <?php

              while ($freelancer = get_rows('freelancers')) {
              ?>
                <option><?= $freelancer['name'] ?></option>
              <?php
              }
              ?>

            </select>
            <table class="table table-striped custab">
              <thead>
                <a href="/create-user.html" class="btn btn-primary btn-xs pull-right mb-4"><b>+</b> Add new Freelancer</a>
                <tr>
                  <th>ID</th>
                  <th>Name</th>
                  <th>Email</th>
                  <th class="text-center">Action</th>
                </tr>
              </thead>
              <tr>
                <td>1</td>
                <td>Sameh Ashraf</td>
                <td>sameh.elalfi.mail@gmail.com</td>
                <td class="text-center">
                  <a class="btn btn-info btn-xs" href="#"><span class="glyphicon glyphicon-edit"></span> Edit</a>
                  <a href="#" class="btn btn-danger btn-xs"><span class="glyphicon glyphicon-remove"></span> Del</a>
                </td>
              </tr>
              <tr>
                <td>2</td>
                <td>Ali Mohammed</td>
                <td>ali.mohammed@gmail.com</td>
                <td class="text-center">
                  <a class="btn btn-info btn-xs" href="#"><span class="glyphicon glyphicon-edit"></span> Edit</a>
                  <a href="#" class="btn btn-danger btn-xs"><span class="glyphicon glyphicon-remove"></span> Del</a>
                </td>
              </tr>
              <tr>
                <td>3</td>
                <td>Nada Farouk</td>
                <td>nada.farouk99@gmail.com</td>
                <td class="text-center">
                  <a class="btn btn-info btn-xs" href="#"><span class="glyphicon glyphicon-edit"></span> Edit</a>
                  <a href="#" class="btn btn-danger btn-xs"><span class="glyphicon glyphicon-remove"></span> Del</a>
                </td>
              </tr>
            </table>
          </div>
        </div>
      </div>
      <!-- End .col-md-9 -->
    </div>
    <!-- End .row -->
  </div>
  <!-- End .container -->

  <!-- Main Scripts -->
  <script src="js/jquery-3.5.1.min.js"></script>
  <script src="js/bootstrap.min.js"></script>
</body>

</html>