<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\PlayerClass;

class PlayerClassSeeder extends Seeder
{
    public function run()
    {
        $classes = [
            ['id' => 1, 'name' => 'Guerreiro'],
            ['id' => 2, 'name' => 'Mago'],
            ['id' => 3, 'name' => 'Arqueiro'],
            ['id' => 4, 'name' => 'Clérigo'],
        ];

        foreach ($classes as $class) {
            PlayerClass::updateOrCreate(
                ['id' => $class['id']],
                ['name' => $class['name']]
            );
        }
    }
}
