<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Post>
 */
class PostFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $categories = ['Musica', 'Teatro', 'Mercadillo', 'Arte'];
        $prices = ['Gratis', '<10€', '>10€'];

        $titulos = [
            'Concierto Ñunk Underground',
            'Mercadillo de Ropa Vintage',
            'Exposición Neo-Brutalista',
            'Jam Session en el Garaje',
            'Tributo a La Casa Azul',
            'Feria del Fanzine Autoeditado',
            'Teatro Experimental Subterráneo',
            'Setlist Indie / Pablo Pablo vibes'
        ];

        return [
            'user_id' => \App\Models\User::factory(),
            'title' => $this->faker->randomElement($titulos) . ' Vol. ' . $this->faker->numberBetween(1, 10),
            'content' => $this->faker->paragraphs(3, true), // 3 párrafos de texto de relleno
            'category' => $this->faker->randomElement($categories),
            'price_range' => $this->faker->randomElement($prices),
            // Las imágenes falsas a veces dan problemas de carga, así que lo dejamos a null para que salga nuestro patrón geométrico por defecto
            'image_path' => null,
            'latitude' => $this->faker->latitude(37.36000000, 37.42000000),
            'longitude' => $this->faker->longitude(-6.02000000, -5.95000000),
        ];
    }
}
