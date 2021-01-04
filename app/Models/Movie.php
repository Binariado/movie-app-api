<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Movie extends Model
{
    use HasFactory;

    protected $table = "movies";

    protected $fillable = [
        "movies_gender_id",
        "director_id",
        "title",
        "description",
        "img_gallery"
    ];

}
