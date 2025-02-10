<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Authors extends Model
{
  use HasFactory, SoftDeletes;

  protected $table = 'authors';

  protected $fillable = [
    'name',
    'state',
  ];

  public function books()
  {
    return $this->hasMany(Books::class, 'author_id');
  }
}
