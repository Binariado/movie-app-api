<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MoviesGender extends Model
{
    use HasFactory;

    protected $table = "movies_genders";
    protected $fillable = ["name", "position"];
}
