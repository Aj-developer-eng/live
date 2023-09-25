<?php

namespace App\Restify;

use App\Models\Time;
use Binaryk\LaravelRestify\Http\Requests\RestifyRequest;

class TimeRepository extends Repository
{
    public static string $model = Time::class;
    public static string $uriKey = 'Time';

    public function fields(RestifyRequest $request): array
    {
        return [
            field('time')->rules('required'),
        ];
    }
}
