<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\FuncaoVisitante;

class FuncaoVisitanteFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = FuncaoVisitante::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'nome' => $this->faker->name(),
            'documento' => $this->faker->numerify('###########'),
            'empresa' => $this->faker->company(),
            'motivo_visita' => $this->faker->sentence(),
            'area_visitada' => null,
            'hora_entrada' => $this->faker->time('H:i'),
            'hora_saida' => $this->faker->time('H:i'),
        ];
    }
}
