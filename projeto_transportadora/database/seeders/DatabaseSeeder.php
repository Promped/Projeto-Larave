<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Carga;
use App\Models\Transportadora;
use App\Models\Motorista;
use App\Models\Veiculo;
use App\Models\AreaPatio;
use App\Models\VagasPatio;
use App\Models\FuncaoVisitante;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        // Limpando as tabelas
        User::truncate();
        Transportadora::truncate();
        Carga::truncate();
        Motorista::truncate();
        Veiculo::truncate();
        AreaPatio::truncate();
        VagasPatio::truncate();
        FuncaoVisitante::truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        // 1. USUÁRIO
        User::create([
            'name' => 'Usuario Teste',
            'email' => 'test@example.com',
            'password' => Hash::make('12345678'),
        ]);

        // 2. TRANSPORTADORAS
        $transpIds = [];
        for ($i = 1; $i <= 4; $i++) {
            $t = Transportadora::create([
                'razao_social' => "Fornecedor Logístico $i",
                'cnpj' => "00.000.000/000$i-00",
                'endereco' => "Rua Exemplo $i",
                'email' => "contato$i@transp.com",
                'telefone' => "1199999999$i"
            ]);
            $transpIds[] = $t->id;
        }

        // 3. CARGAS (Básico para evitar erro de coluna)
        $materiais = ['Madeira', 'Ferro', 'EPI', 'Insumo'];
        foreach ($materiais as $m) {
            Carga::create([
                'tipo' => $m,
                'unidade_medida' => 'UN',
                'descricao' => "Carga de $m",
            ]);
        }

       // 3. MOTORISTAS (Já sabemos que é 'status')
        $opcoesStatus = ['Ativo', 'Inativo', 'Bloqueado'];
        for ($i = 1; $i <= 24; $i++) {
            Motorista::create([
                'nome' => "Motorista $i",
                'cpf' => "000.000.000-" . str_pad($i, 2, '0', STR_PAD_LEFT),
                'cnh' => "CNH$i",
                'telefone' => "1198888777$i",
                'status' => $opcoesStatus[array_rand($opcoesStatus)],
                'transportadora_id' => $transpIds[array_rand($transpIds)]
            ]);
        }

        // 4. VEÍCULOS (Aqui vamos ser cautelosos)
        for ($i = 1; $i <= 24; $i++) {
            $dadosVeiculo = [
                'placa' => "BRA" . rand(1, 9) . "A" . rand(10, 99),
                'modelo' => "Caminhão $i",
                'tipo' => 'Carreta',
                'transportadora_id' => $transpIds[array_rand($transpIds)],
            ];

            // TESTE: Se o erro persistir, vamos tentar 'status_acesso' apenas para veículos
            // porque seu banco disse que 'status' não existe aqui.
            $dadosVeiculo['status_acesso'] = 'Ativo'; 

            Veiculo::create($dadosVeiculo);
        }
        // 5. ÁREAS E VAGAS (Ajustado com os ENUMs reais)
        for ($i = 1; $i <= 4; $i++) {
            $area = AreaPatio::create([
                'nome' => "Pátio Setor $i",
                'capacidade' => 5 
            ]);

            for ($v = 1; $v <= 5; $v++) {
                VagasPatio::create([
                    'area_id'            => $area->id,
                    'identificacao_vaga' => "Vaga $i-$v",
                    'status'             => 'disponivel', // Tem que ser exatamente assim!
                    'veiculo_id'         => null
                ]);
            }
        }

        // --- 7. VISITANTES (Ajustado com os nomes exatos do banco) ---
$funcoes = ['Estagiário', 'Manutenção', 'Diretoria'];

foreach ($funcoes as $index => $f) {
    FuncaoVisitante::create([
        'nome'          => "Visitante " . ($index + 1), // Campo obrigatório
        'descricao'     => "Registro de entrada para $f", // Campo obrigatório
        'documento'     => "000.000.000-0" . ($index + 1),
        'empresa'       => "Prestadora $f LTDA",
        'funcao'        => $f,
        'periodo'       => 'Comercial',
        'motivo_visita' => "Serviço de $f agendado para hoje.",
        'hora_entrada'  => '08:00:00',
        'hora_saida'    => '18:00:00',
        // 'area_visitada' => 1, // Se quiser ligar a uma área de pátio específica
    ]);
}
    }
}