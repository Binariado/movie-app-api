<?php

namespace App\Http\Controllers;

use App\Http\Controllers\ResponseTrait;
use App\Models\Menu;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class MenuController extends Controller
{
  use ResponseTrait;

  public function listMenu()
  {
    $menu = Menu::all();
    $user = User::find(Auth::user()->id);

    $menuPermission = $menu->filter(function ($value) use ($user) {
      $perm = $value->permission;
      return !$perm ? false : $user->can($value->permission);
    });

    $menuPermission->map(function ($value) use ($menuPermission) {
      $value->items = $menuPermission->where('parent_id', $value->id);
      $value->items = $value->items->flatten();
      return $value;
    });

    $menu = $menuPermission->filter(function ($value) {
      return $value->parent_id === 0;
    });

    $menu = $menu->flatten();

    return $this->success(compact('menu'), 'list menu', 200);
  }
}
