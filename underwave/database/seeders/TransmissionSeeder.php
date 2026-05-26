<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Transmission;
use App\Models\User;

class TransmissionSeeder extends Seeder
{
    public function run()
    {
        Transmission::truncate();

        $users = User::all();
        if ($users->isEmpty()) {
            return;
        }

        $transmissions = [
            "Pillados los billetes para el bolo de punk en el CSO. Nos vemos en la barra \u{1F3F4}",
            "¿Alguien tiene el fanzine de 'Ratones de Sevilla' vol. 2? Cambio por parche de Cicatriz.",
            "Ojo, mañana cambian la contraseña de acceso al sótano del mercadillo de discos de la Alameda. Pasádmela por DM si os enteráis.",
            "Busco bajista para banda de post-punk en Triana. Influencias: Joy Division, Parálisis Permanente y litros de Cruzcampo.",
            "Alerta radar: la pasma ha chapado la rave en el polígono Store. Nos movemos a la ubicación secundaria. Atentos a la señal."
        ];

        foreach ($transmissions as $content) {
            Transmission::create([
                'user_id' => $users->random()->id,
                'content' => $content
            ]);
        }
    }
}
