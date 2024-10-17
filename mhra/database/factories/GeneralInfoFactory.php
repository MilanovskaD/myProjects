<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\GeneralInfo>
 */
class GeneralInfoFactory extends Factory
{
    protected $model = \App\Models\GeneralInfo::class;

    public function definition()
    {
        $socialMediaLinks = [
            'facebook' => $this->faker->url,
            'twitter' => $this->faker->url,
            'instagram' => $this->faker->url,
            'linkedin' => $this->faker->url,
        ];

        return [
            'hero_image_path' => null,
            'social_media_links' => json_encode($socialMediaLinks),
            'general' => $this->faker->paragraph,
        ];
    }
}
