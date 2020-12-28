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
        <form class="login100-form validate-form flex-sb flex-w" action="/login" method="POST">
          <span class="login100-form-title p-b-32">
            Account Login
          </span>

          <? component('auth/input', ['title'=>'Email', 'type'=>'email', 'name'=>'email', 'required'=>true]) ?>
          <? component('auth/input', ['title'=>'Password', 'type'=>'password', 'name'=>'password', 'required'=>true]) ?>

          <div class="flex-sb-m w-full p-b-48">
            <div class="contact100-form-checkbox">
              <input class="input-checkbox100" id="ckb1" type="checkbox" name="remember-me">
              <label class="label-checkbox100" for="ckb1">
                Remember me
              </label>
            </div>

            <div>
              <a href="#" class="txt3">
                Forgot Password?
              </a>
            </div>
          </div>

          <div class="container-login100-form-btn">
            <button class="login100-form-btn">
              Login
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