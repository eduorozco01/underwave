<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Post;
use App\Models\Comment;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

use Spatie\Permission\Models\Role;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Crear roles
        $rolePublico = Role::firstOrCreate(['name' => 'Público']);
        $roleBanda = Role::firstOrCreate(['name' => 'Banda']);

        // 1. Tu usuario maestro
        $admin = \App\Models\User::factory()->create([
            'name' => 'Edu SystemAdmin',
            'email' => 'edu@underwave.local',
            'password' => bcrypt('password'),
        ]);
        $admin->assignRole('Banda');

        // 2. Usuarios simulados
        $users = \App\Models\User::factory(10)->create();
        $users->each(function ($user, $index) {
            if ($index % 2 == 0) {
                $user->assignRole('Banda');
            } else {
                $user->assignRole('Público');
            }
        });
        $allUsers = $users->push($admin);

        // Integración con la API de DiceBear para autogenerar los avatares estilo pixel-art
        // Aquí la IA me echó un cable para iterar sobre los usuarios y limpiar la URL correctamente
        $allUsers->each(function ($user) {
            // Limpio el nombre para que la URL no se rompa con los espacios
            $seed = urlencode($user->name);
            
            // Llamo a la API de DiceBear
            $avatarUrl = "https://api.dicebear.com/8.x/pixel-art/svg?seed={$seed}";
            
            // Guardo la URL del avatar directamente en mi base de datos
            $user->update(['avatar_path' => $avatarUrl]);
        });

        // 3. Crear Posts y Comentarios
        \App\Models\Post::factory(30)->recycle($allUsers)->create()->each(function ($post) use ($allUsers) {
            $numeroComentarios = rand(0, 5);
            \App\Models\Comment::factory($numeroComentarios)->create([
                'post_id' => $post->id,
                'user_id' => $allUsers->random()->id,
            ]);
        });

        // 4. Otros Seeders (Fanzines y Transmisiones)
        (new FanzineSeeder)->run();
        (new TransmissionSeeder)->run();
    }
}

