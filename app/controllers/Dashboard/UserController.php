<?php

namespace App\Controllers\Dashboard;

use App\Core\Request;
use App\Models\User;

class UserController extends DashboardController
{
  public function index()
  {
    $user = new User;
    $users = $user->where('id', '>=', 1)->get();
    $title = "Manage Users";
    return view('dashboard/users/index', compact('title', 'users'));
  }

  /**
   * return the create user form
   */
  public function create()
  {
    return view('dashboard/users/create');
  }

  public function show($data)
  {
    $user = new User;
    $user = $user->find($data['id'])->first();

    return view('dashboard/users/show', compact('user'));
  }

  public function edit($data)
  {
    $user = new User;
    $user = $user->find($data['id'])->first();

    return view('dashboard/users/edit', compact('user'));
  }

  public function store()
  {
    $request = new Request;
    $params = $request->request['post_params'];
    unset($params['password_confirm']);
    $params['password'] = bcrypt($params['password']);
    // TODO: Create validation system

    $user = new User;
    $inserted = $user->insert($params);
    if ($inserted) {
      $message = "Inserted successfully";
      Request::back($message);
    } else {
      $error = "can not insert";
      Request::redirect('/dashboard/users/create', $error);
    }
  }

  public function destroy($data)
  {
    $id = $data['id'];
    $user = new User;
    $user->find($id)->delete();
    Request::redirect('/dashboard/users');
  }
}
