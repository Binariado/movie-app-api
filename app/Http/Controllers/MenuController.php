<?php

namespace App\Http\Controllers;

use App\Http\Controllers\ResponseTrait;
use App\Models\Menu;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Spatie\Permission\Models\Permission;

class MenuController extends Controller
{
  use ResponseTrait;

  public function listMenu()
  {
    try {
      $menu = Menu::all();
      $user = false;

      if (Auth::check()) {
        $user = User::find(Auth::user()->id);
      }

      $menuPermission = $menu->filter(function ($value) use ($user) {
        $perm = $value->permission;
        $Permission = Permission::where('name', $perm)->exists();
        if ($Permission) {
          if ($user) {
            return !$perm ? false : $user->can($value->permission);
          }
          return false;
        }
        return true;
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
      
    } catch (\Throwable $th) {
      return $this->error('internal_server_error', 500);
    }
  }

}
