<?php

namespace App\Restify;

use App\Models\Payment;
use Binaryk\LaravelRestify\Http\Requests\RestifyRequest;

class PaymentRepository extends Repository
{
    public static string $model = Payment::class;
    public static string $uriKey = 'payment';

    public function fields(RestifyRequest $request): array
    {
        return [
            field('user_id')->rules('required'),
            field('bill_id')->rules('required'),
            field('receivable')->rules('required'),
            field('bill_status')->rules('required'),
        ];
    }
}
