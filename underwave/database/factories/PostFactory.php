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
            'Concierto Punk en Sala X',
            'Mercadillo Vintage en la Alameda',
            'Exposición de Fanzines en Tramallol',
            'Jam Session en La Sra Pop',
            'Dj Set en Sala Malandar',
            'Feria de Ilustración en el Pumarejo',
            'Teatro en Sala Cero',
            'Monólogo en el Gallo Rojo',
            'Festival de Ruido en el Polígono Store',
            'Pinchada de Vinilos en Bar Mutante'
        ];

        $descripciones = [
            "Este viernes nos juntamos para liar una buena. Venid pronto que el aforo es limitado y ya sabéis cómo se pone esto. Habrá birra barata y fanzines en la puerta. ¡No os lo perdáis!",
            "Toda la tarde rebuscando entre vinilos, ropa de segunda mano y rarezas. Empezamos a las 17:00 y estaremos hasta que nos echen. Traed efectivo que aquí no pillamos tarjeta.",
            "Cerramos la semana con una exposición espectacular. Obras crudas, experimentales y muy ruidosas. Contaremos con la presencia de varios artistas locales que explicarán su movida.",
            "Si tocas algún instrumento tráetelo, si no, vente a escuchar. Abrimos micros y enchufamos los amplis desde por la tarde. Todo improvisado, todo puede salir mal o ser increíble.",
            "Noche de distorsión y luces estroboscópicas. No esperes pop ni reggaeton, venimos a reventar los altavoces con lo más duro de la escena local."
        ];

        return [
            'user_id' => \App\Models\User::factory(),
            'title' => $this->faker->randomElement($titulos) . ' Vol. ' . $this->faker->numberBetween(1, 10),
            'content' => $this->faker->randomElement($descripciones) . "\n\n" . $this->faker->paragraphs(1, true),
            'category' => $this->faker->randomElement($categories),
            'price_range' => $this->faker->randomElement($prices),
            'event_date' => $this->faker->dateTimeBetween('now', '+2 months')->format('Y-m-d'),
            'image_path' => null,
            'latitude' => $this->faker->latitude(37.36000000, 37.42000000),
            'longitude' => $this->faker->longitude(-6.02000000, -5.95000000),
        ];
    }
}
