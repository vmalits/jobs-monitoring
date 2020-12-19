<?php
declare(strict_types=1);

namespace Database\Factories;

use App\Models\Vacansy;
use Exception;
use Illuminate\Database\Eloquent\Factories\Factory;

class VacancyFactory extends Factory
{
    protected $model = Vacansy::class;

    /**
     * Define the model's default state.
     *
     * @return array
     * @throws Exception
     */
    public function definition()
    {
        return [
            'position' => $this->faker->jobTitle,
            'organization' => $this->faker->company,
            'requirements' => $this->faker->text,
            'salary' => random_int(1000, 30000),
            'salary_from' => random_int(1000, 30000),
            'salary_to' => random_int(1000, 30000),
            'vacancy_link' => $this->faker->url
        ];
    }
}
