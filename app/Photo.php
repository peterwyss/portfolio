<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Photo extends Model
{
    protected $table = 'photo';
    protected $fillable = ['title', 'description', 'visible', 'position', 'photo_url', 'thumbnail_url', 'site'];



}
