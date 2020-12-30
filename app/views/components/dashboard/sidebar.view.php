<div class="col-md-3">
  <div class="list-group">
    <a href="/dashboard" class="list-group-item list-group-item-action"><i class="fas fa-cogs"></i> Dashboard</a>
    <? if (is_admin()): ?>
    <a href="/dashboard/users/create" class="list-group-item list-group-item-action"><i class="fas fa-user"></i> Create User</a>
    <? endif; ?>
    <a href="/dashboard/users" class="list-group-item list-group-item-action"><i class="fas fa-users"></i> Users Management
      <span class="badge badge-primary"><?= isset($totalUsers) ? $totalUsers : ''; ?></span>
    </a>
  </div>
</div>
<!-- End .col-md-3 -->