<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Woops, There's an error ...</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Arvo">
  <link rel="stylesheet" type="text/css" href="/css/error-pages.css">
</head>

<body>
  <section class="page">
    <div class="container">
      <div class="row">
        <div class="col-sm-12 ">
          <div class="col-sm-10 col-sm-offset-1  text-center">
            <div class="four_zero_four_bg">
              <h1 class="text-center ">
                <?= $error_code ?>
              </h1>


            </div>

            <div class="content_box">
              <h3 class="h2">
                Look like there is something went wrong!
              </h3>

              <?= !empty($message) ? "<p>{$message}</p>" : '' ?>

              <a href="/" class="link">Go to Home</a>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
</body>

</html>