<!DOCTYPE html>
<html lang="en">

<head>
  <?php component('dashboard/head'); ?>
</head>

<body>
  <?php component('dashboard/navbar'); ?>
  <div class="container">
    <div class="row">

      <?php component('dashboard/sidebar', compact('totalUsers', 'totalFreelancers')); ?>

      <!-- Page Content -->
      <div class="col-md-9">
        <div class="card">
          <h5 class="card-header"><i class="fas fa-star"></i> Statics</h5>
          <div class="card-body d-flex">
            <div class="card mx-2" style="width: 18rem">
              <div class="card-body d-flex justify-content-center align-items-center flex-column">
                <h5 class="card-title">5000</h5>
                <h6 class="card-subtitle mb-2 text-muted">Visits Today</h6>
              </div>
            </div>

            <div class="card mx-2" style="width: 18rem">
              <div class="card-body d-flex justify-content-center align-items-center flex-column">
                <h5 class="card-title">25000</h5>
                <h6 class="card-subtitle mb-2 text-muted">
                  Visits This Month
                </h6>
              </div>
            </div>

            <div class="card mx-2" style="width: 18rem">
              <div class="card-body d-flex justify-content-center align-items-center flex-column">
                <h5 class="card-title">1253</h5>
                <h6 class="card-subtitle mb-2 text-muted">New Users Today</h6>
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