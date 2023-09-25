<?php

namespace App\Restify;

use App\Models\Portfolio;
use Binaryk\LaravelRestify\Fields\BelongsTo;
use Binaryk\LaravelRestify\Fields\BelongsToMany;
use Binaryk\LaravelRestify\Http\Requests\RestifyRequest;

class PortfolioRepository extends Repository
{
    public static string $model = Portfolio::class;
    public static string $uriKey = 'portfolio';
    public function fields(RestifyRequest $request): array
    {
        return [
            field('address')->rules('required'),
            field('country')->rules('required'),

            field('phone')->storingRules('required', 'unique:portfolios')->messages([
                'required' => 'This field is required.',
            ]),
        ];
    }

}
