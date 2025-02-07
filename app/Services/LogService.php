<?php

namespace App\Services;

use App\Models\Logs;

class LogService
{
  protected $user_id;
  protected $log;

  public function __construct($user_id, $log)
  {
    $this->user_id = $user_id;
    $this->log = $log;

    $this->save();
  }

  public function save()
  {
    return Logs::create([
      'user_id' => $this->user_id,
      'log' => $this->log,
    ]);
  }
}
