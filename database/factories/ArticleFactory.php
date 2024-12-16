<?php

namespace Database\Factories;

use App\Enums\ArticleStatus;
use App\Enums\UserRole;
use App\Models\Category;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Article>
 */
class ArticleFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $title = fake()->unique()->text(80);
        $slug = Str::slug($title);

        $adminOrRedatorUser = User::select('id')
            ->orWhereIn('role', [
                UserRole::ADMIN,
                UserRole::REDATOR,
            ])
            ->inRandomOrder()
            ->first();

        $status = $adminOrRedatorUser->id % 2 ?
            ArticleStatus::RASCUNHO->value :
                ArticleStatus::PUBLICADO->value;

        return [
            'banner' => 'https://media.istockphoto.com/id/484234714/vector/example-free-grunge-retro-blue-isolated-stamp.jpg?s=612x612&w=0&k=20&c=97KgKGpcAKnn50Ubd8PawjUybzIesoXws7PdU_MJGzE=', // para fins de exemplo
            'title' => $title,
            'subtitle' => fake()->unique()->text(150),
            'content' => fake()->unique()->paragraphs(5, true),
            'slug' => $slug,
            'status' => $status,
            'user_id' => $adminOrRedatorUser->id,
            'category_id' => Category::inRandomOrder()->first()->id,
        ];
    }
}
