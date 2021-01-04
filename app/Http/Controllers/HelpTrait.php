<?php

namespace App\Http\Controllers;

trait HelpTrait
{

  public function is_arr_or_obj($data)
  {
    return is_array($data) || is_object($data) ? true : false;
  }

}
