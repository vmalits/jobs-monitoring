<?php

declare(strict_types=1);

namespace App\Services\JobsMonitoringApi;

use App\Models\Vacansy;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Http;
use JetBrains\PhpStorm\ArrayShape;

class RabotaMdService implements VacansyInterface
{
    public function __construct(public Http $client)
    {
    }

    public function returnJobsPerPage(int $page): Collection
    {
        $jobs = $this->client::asForm()
            ->post(config('rabota-md.all_vacansies_url'), [
                'page' => $page,
                'remote' => config('rabota-md.remote'),
                'online' => config('rabota-md.online'),
                'json' => config('rabota-md.json')
            ])->json()['data'];

        return collect($jobs);
    }

    public function save(array $vacansy): void
    {
        Vacansy::firstOrCreate($vacansy);
    }

    #[ArrayShape([
        'position' => "mixed",
        'organization' => "mixed",
        'requirements' => "mixed",
        'salary' => "int|mixed",
        'salary_from' => "int|mixed",
        'salary_to' => "int|mixed",
        'vacancy_link' => "string"
    ])] public function prepare(
        array $vacansy
    ): array {
        return [
            'position' => $vacansy['position'],
            'organization' => $vacansy['organization'],
            'requirements' => $vacansy['requirements'],
            'salary' => $vacansy['salary'] ?? 0,
            'salary_from' => $vacansy['salary_from'] ?? 0,
            'salary_to' => $vacansy['salary_to'] ?? 0,
            'vacancy_link' => config('rabota-md.domain') . $vacansy['vacancy_link']
        ];
    }

    public function handle(): void
    {
        $page = 1;
        do {
            $jobs = $this->returnJobsPerPage($page);
            if ($jobs->isEmpty()) {
                return;
            }

            $jobs->each(function ($job) {
                $preparedJob = $this->prepare($job);
                $this->save($preparedJob);
            });

            $page++;
        } while ($page > 0);
    }
}


