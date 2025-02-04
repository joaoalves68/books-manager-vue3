<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

use App\Models\Authors;

class AuthorsSeeder extends Seeder
{
  public function run()
  {
    $authors = [
      ['name' => 'Carlos Silva', 'state' => 'São Paulo'],
      ['name' => 'Ana Souza', 'state' => 'Minas Gerais'],
      ['name' => 'Roberto Almeida', 'state' => 'Rio de Janeiro'],
      ['name' => 'Fernanda Costa', 'state' => 'Bahia'],
      ['name' => 'José Pereira', 'state' => 'Paraná'],
      ['name' => 'Mariana Oliveira', 'state' => 'Pernambuco'],
      ['name' => 'Ricardo Santos', 'state' => 'Rio Grande do Sul'],
      ['name' => 'Juliana Mendes', 'state' => 'Ceará'],
      ['name' => 'Lucas Fernandes', 'state' => 'Amazonas'],
      ['name' => 'Patrícia Lima', 'state' => 'Distrito Federal'],
    ];

    Authors::insert($authors);
  }
}
