<?php

namespace App\Restify;

use App\Models\bill_user_;
use Binaryk\LaravelRestify\Http\Requests\RestifyRequest;

class bill_user_Repository extends Repository
{
    public static string $model = bill_user_::class;

    public function fields(RestifyRequest $request): array
    {
        return [
            field('id')->rules('required'),

        ];
    }
}
