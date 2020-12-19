<?php

declare(strict_types=1);

namespace App\Services\JobsMonitoringApi;

use Illuminate\Support\Facades\Http;

interface VacansyInterface
{
    public function __construct(Http $client);

    public function prepare(array $vacansy);

    public function save(array $vacansy);

    public function handle();
}
