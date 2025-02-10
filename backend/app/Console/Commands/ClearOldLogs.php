<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Storage;
use Carbon\Carbon;
use App\Models\Logs;

class ClearOldLogs extends Command
{
  /**
   * The name and signature of the console command.
   *
   * @var string
   */
  protected $signature = 'app:clear-old-logs';

  /**
   * The console command description.
   *
   * @var string
   */
  protected $description = 'Deleta registros da tabela logs com mais de 30 dias de existência';

  /**
   * Execute the console command.
   */
  public function handle()
  {
    $limit_date = Carbon::now()->subDays(30);
    $logs_to_delete = Logs::where('created_at', '<', $limit_date)->get();

    $log_path = storage_path('logs/OldLogs/');
    if (!is_dir($log_path)) {
      mkdir($log_path, 0777, true);
    }

    $file_name = 'logsDeleted-' . Carbon::now()->format('d-m-Y') . '.log';
    $file_path = $log_path . $file_name;

    $log_content = "Registros excluídos em " . Carbon::now()->format('d-m-Y') . ":\n";
    foreach ($logs_to_delete as $log) {
      $log_content .= "ID: {$log->id} | User ID: {$log->user_id} | Ação: {$log->log} | Criado em: {$log->created_at}\n";
    }

    file_put_contents($file_path, $log_content, FILE_APPEND);

    Logs::where('created_at', '<', $limit_date)->delete();

    $this->info("Logs antigos deletados com sucesso!");
  }
}
