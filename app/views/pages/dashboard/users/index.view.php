<!DOCTYPE html>
<html lang="en">

<head>
  <?php component('dashboard/head', compact('title')); ?>
</head>

<body>
  <?php component('dashboard/navbar'); ?>
  <div class="container">
    <div class="row">

      <?php component('dashboard/sidebar'); ?>

      <!-- Page Content -->
      <div class="col-md-9">
        <div class="card">
          <h5 class="card-header"><i class="fas fa-users"></i> Users</h5>
          <div class="card-body">
            <table class="table table-striped custab">
              <thead>
                <? if (is_admin()): ?>
                <a href="/dashboard/users/create" class="btn btn-primary btn-xs pull-right mb-4"><b>+</b> Add new User</a>
                <? endif; ?>

                <tr>
                  <th>ID</th>
                  <th>Name</th>
                  <th>Email</th>
                  <th>Role</th>
                  <? if (is_admin()): ?>
                  <th class="text-center">Action</th>
                  <? endif; ?>
                </tr>
              </thead>
              <tbody>
                <?php
                foreach ($users as $user) :
                ?>
                  <tr>
                    <td><?= $user['id'] ?></td>
                    <td><a href="/dashboard/users/<?= $user['id'] ?>"><?= $user['first_name'] . ' ' . $user['last_name']  ?></a></td>
                    <td><?= $user['email'] ?></td>
                    <td><?= $user['role'] == 1 ? 'Admin' : 'User'; ?></td>
                    <? if (is_admin()): ?>
                    <td class='text-center'>
                      <a class='btn btn-info btn-xs' href='/dashboard/users/<?= $user['id'] ?>/edit'>
                        <span class='glyphicon glyphicon-edit'></span> Edit
                      </a>
                      <a class='btn btn-danger btn-xs delete-btn' data-id="<?= $user['id'] ?>">
                        <span class='glyphicon glyphicon-remove'></span> Del
                      </a>
                    </td>
                    <? endif; ?>
                  </tr>
                <?php endforeach; ?>
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

  <?php component('dashboard/scripts'); ?>
</body>

</html>