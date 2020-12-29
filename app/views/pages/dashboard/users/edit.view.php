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
            <form class="form-horizontal" action="/dashboard/users" method="POST">
              <fieldset>

                <?php
                if (count($errors) > 0) :
                  foreach ($errors as $error) :
                ?>
                    <div class="alert alert-primary" role="alert"><?= $error ?></div>
                <?php
                  endforeach;
                endif;
                ?>

                <? component('dashboard/input', ['title'=>'First Name', 'name'=>'first_name', 'required'=>true, 'value'=>$user['first_name']]) ?>
                <? component('dashboard/input', ['title'=>'Last Name', 'name'=>'last_name', 'required'=>true, 'value'=>$user['last_name']]) ?>
                <? component('dashboard/input', ['title'=>'E-mail', 'name'=>'email', 'type'=>'email', 'required'=>true, 'value'=>$user['email']]) ?>
                <? component('dashboard/input', ['title'=>'Password', 'name'=>'password', 'type'=>'password', 'required'=>true]) ?>
                <? component('dashboard/input', ['title'=>'Password (Confirm)', 'name'=>'password_confirm', 'type'=>'password', 'required'=>true]) ?>

                <div class="control-group">
                  <!-- Button -->
                  <div class="controls">
                    <button class="btn btn-success" type="submit">Register</button>
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

  <?php component('dashboard/scripts'); ?>
</body>

</html>