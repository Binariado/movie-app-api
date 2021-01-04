<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

trait SlugTrait
{

  public function RandomNumber($rand = null)
  {
    $collection = collect([0, 1, 2, 3, 4, 5, 6, 7, 8, 9]);

    if ($rand >= 3) {
      $collection = $collection->merge(["a", "b", "c", "d", "e", "f", "g", "h", "i", "j", "k", "l", "m", "n", "o", "p", "q", "r", "s", "u", "v", "w", "x", "y", "z"]);
    }

    // if($rand>=5){
    //   $collection = $collection->merge(["A", "B", "C", "D", "E", "F", "G", "H", "I", "J", "K", "L", "M", "N", "O", "P", "Q", "R", "S", "U", "V", "W", "X", "Y", "Z"]);
    // }

    $random = $collection->random($rand);
    return implode("", $random->all());
  }

  public function existSlug($tableName, $slug, $slugCreate)
  {
    return DB::table($tableName)
      ->where($slug, $slugCreate)->first();
  }

  public  function remove_tildes($chain) {
    $not_allowed= array ("á","é","í","ó","ú","Á","É","Í","Ó","Ú","ñ","À","Ã","Ì","Ò","Ù","Ã™","Ã ","Ã¨","Ã¬","Ã²","Ã¹","ç","Ç","Ã¢","ê","Ã®","Ã´","Ã»","Ã‚","ÃŠ","ÃŽ","Ã”","Ã›","ü","Ã¶","Ã–","Ã¯","Ã¤","«","Ò","Ã","Ã„","Ã‹");
    $allowed= array ("a","e","i","o","u","A","E","I","O","U","n","N","A","E","I","O","U","a","e","i","o","u","c","C","a","e","i","o","u","A","E","I","O","U","u","o","O","i","a","e","U","I","A","E");
    $text = str_replace($not_allowed, $allowed ,$chain);
    return $text;
}

  public function slugCreate($model = null)
  {
    $tableName = $model["table"];

    $source = $this->remove_tildes($model["source"]);
    $slug = $model["slug"];
    $separator = "-";
    if (isset($model["separator"])) {
      $separator = $model["separator"];
    }

    $count = 0;
    $num = '';
    $ft = true;

    do {
      if ($count == 0 || $count == 1 || $count == 2) {
        $source = collect(explode(" ", $source))
          ->shuffle()
          ->implode("");
      }

      if ($count >= 3) {
        $source = collect(explode(" ", $source))
          ->shuffle()
          ->implode("");
      }

      $num = $this->RandomNumber($count);
      $value = $source;
      $slugCreate = Str::slug($value, $separator) . $num;
      $ft =$this->existSlug($tableName, $slug, $slugCreate);
      $count++;
    } while ($ft);

    return $slugCreate;
  }
}
