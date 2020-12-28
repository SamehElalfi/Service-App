<!DOCTYPE html>
<html lang="en">

<head>
  <title>Login</title>
  <? component("auth/head") ?>
</head>

<body>

  <div class="limiter">
    <div class="container-login100">
      <div class="wrap-login100 p-l-85 p-r-85 p-t-55 p-b-55">
        <form class="login100-form validate-form flex-sb flex-w" action="/register" method="POST">
          <span class="login100-form-title p-b-32">
            Account Registration
          </span>

          <? component('auth/input', ['title'=>'First Name', 'type'=>'text', 'name'=>'first_name', 'required'=>true]) ?>
          <? component('auth/input', ['title'=>'Last Name', 'type'=>'text', 'name'=>'last_name', 'required'=>true]) ?>
          <? component('auth/input', ['title'=>'Email', 'type'=>'email', 'name'=>'email', 'required'=>true]) ?>
          <? component('auth/input', ['title'=>'Password', 'type'=>'password', 'name'=>'password', 'required'=>true]) ?>

          <div class="container-login100-form-btn">
            <button class="login100-form-btn">
              Register
            </button>
          </div>

        </form>
      </div>
    </div>
  </div>


  <div id="dropDownSelect1"></div>

  <? component('auth/scripts') ?>

</body>

</html>