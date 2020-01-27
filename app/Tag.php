<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
  protected $table = 'tags';

  protected $fillable = [
    'title',
    'slug'
  ];

  public function posts()
  {
    return $this -> belongsToMany('App\Post');
  }
}
