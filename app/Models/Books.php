<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Books extends Model
{
  use HasFactory, SoftDeletes;

  protected $table = 'books';

  protected $fillable = [
    'title',
    'description',
    'published_at',
    'author_id'
  ];

  public function author()
  {
    return $this->belongsTo(Author::class);
  }
}
