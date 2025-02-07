<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Logs extends Model
{
  use HasFactory;

  protected $table = 'logs';

  protected $fillable = [
    'user_id',
    'log',
  ];

  public function author()
  {
    return $this->belongsTo(Authors::class);
  }
}
