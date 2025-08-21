<?php

namespace Database\Factories;

use Illuminate\Support\Str;
use App\Models\InformasiTerkini\KelolaBerita;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\InformasiTerkini\KelolaBerita>
 */
class KelolaBeritaFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */

    protected $model = KelolaBerita::class;
    public function definition(): array
    {
        $categories = [
            'academic_services',
            'library_resources', 
            'student_information_system',
            'administration',
            'communication',
            'research_development',
            'other'
        ];

        $title = $this->faker->sentence(rand(3, 8), false);
        
        return [
            'category' => $this->faker->randomElement($categories),
            'name' => $title,
            'slug' => Str::slug($title) . '-' . $this->faker->unique()->randomNumber(4),
            'tags' => $this->faker->words(rand(2, 5), true),
            'publish_date' => $this->faker->optional(0.8)->dateTimeBetween('-6 months', '+1 month'),
            'status' => $this->faker->randomElement(['draft', 'published']),
            'image' => null, // Karena file upload, bisa diisi manual jika diperlukan
            'content' => $this->faker->paragraphs(rand(3, 8), true),
        ];
    }

    /**
     * State untuk berita yang sudah dipublish
     */
    public function published()
    {
        return $this->state(function (array $attributes) {
            return [
                'status' => 'published',
                'publish_date' => $this->faker->dateTimeBetween('-3 months', 'now'),
            ];
        });
    }

    /**
     * State untuk berita draft
     */
    public function draft()
    {
        return $this->state(function (array $attributes) {
            return [
                'status' => 'draft',
                'publish_date' => null,
            ];
        });
    }

    /**
     * State untuk kategori akademik
     */
    public function academic()
    {
        return $this->state(function (array $attributes) {
            return [
                'category' => 'academic_services',
                'tags' => 'akademik, kuliah, mahasiswa, dosen',
            ];
        });
    }

    /**
     * State untuk kategori perpustakaan
     */
    public function library()
    {
        return $this->state(function (array $attributes) {
            return [
                'category' => 'library_resources',
                'tags' => 'perpustakaan, buku, koleksi, sumber daya',
            ];
        });
    }

    /**
     * State untuk berita dengan konten panjang
     */
    public function longContent()
    {
        return $this->state(function (array $attributes) {
            return [
                'content' => $this->faker->paragraphs(rand(10, 15), true),
            ];
        });
    }

    /**
     * State untuk berita terbaru (dalam 1 bulan terakhir)
     */
    public function recent()
    {
        return $this->state(function (array $attributes) {
            return [
                'status' => 'published',
                'publish_date' => $this->faker->dateTimeBetween('-1 month', 'now'),
            ];
        });
    }
}
