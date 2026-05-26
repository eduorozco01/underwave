<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Fanzine;
use App\Models\User;

class FanzineSeeder extends Seeder
{
    public function run()
    {
        Fanzine::truncate();

        $users = User::all();
        if ($users->isEmpty()) {
            return;
        }

        $filePath = 'fanzines/files/km72L56TBDpBavxX7TM3diivnUt0DrXYivNmNity.pdf';

        $fanzines = [
            [
                'title' => 'underwave',
                'cover_path' => 'fanzines/covers/Z2Jlb4OqIR7OSvzIwLpm1LyCe1KrgADqyFxv9xLH.jpg',
            ],
            [
                'title' => 'DAW TFG VOL.1 // SEVILLA UNDERGROUND',
                'cover_path' => 'fanzines/covers/cover1.png',
            ],
            [
                'title' => 'RUIDO SUR: GUÍA DE SUPERVIVENCIA',
                'cover_path' => 'fanzines/covers/cover2.png',
            ],
            [
                'title' => 'ZINE_004: POST-PUNK EN EL GUADALQUIVIR',
                'cover_path' => 'fanzines/covers/cover3.png',
            ]
        ];

        foreach ($fanzines as $data) {
            Fanzine::create([
                'user_id' => $users->random()->id,
                'title' => $data['title'],
                'cover_path' => $data['cover_path'],
                'file_path' => $filePath,
            ]);
        }
    }
}
