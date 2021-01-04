<?php

namespace Database\Seeders;

use App\Models\Menu;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\PermissionRegistrar;

class MenuSeeder extends Seeder
{
  /**
   * Run the database seeds.
   *
   * @return void
   */
  public function run()
  {
    app()[PermissionRegistrar::class]->forgetCachedPermissions();
    
    // if(Role::where("name",'admin')->exists()){
    //     $role = Role::findByName('admin');
    // }else{
    //     $role = Role::create(['name' => 'admin']);
    // }
    

    $variable = array(
        array(
            'order' => 1,
            'title' => "Peliculas",
            'icon' => "movie",
            'uri' => "/",
        ),
        array(
            'order' => 2,
            'title' => "Favoritos",
            'icon'=>"favorities",
            'uri'=> "favorities",
        ),
        array(
            'order' => 2,
            'title' => "Agregar",
            'icon'=>"add",
            'uri' => "add-movies",
            'permission' => "add_movies",
        )
    );

    foreach ($variable as $value) {
        $menu = Menu::create($value);
        if(isset($value["permission"])){
            $per = $value["permission"];
            Permission::create(['name' => $per]);
        }
    }

  }
}
