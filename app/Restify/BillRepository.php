<?php

namespace App\Restify;

use App\Models\Bill;
use App\Models\bill_payments;
use App\Models\User;
use Binaryk\LaravelRestify\Http\Requests\RestifyRequest;

class BillRepository extends Repository
{
    public static string $model = Bill::class;
    public static string $uriKey = 'bill';
    public function fields(RestifyRequest $request): array
    {
        // dd($request);
        return [
            // field('id')->rules('required'),
            field('title')->rules('required'),

            field('description')->storingRules('required', 'unique:bills')->messages([
                'required' => 'This field is required.',
            ]),
            field('price')->rules('required'),
            field('within_due_date')->rules('required'),

        ];
    }
    public function store(RestifyRequest $request){

        $save = Bill::create([
            'title' => $request['title'],
            'description' => $request['description'],
            'price' => $request['price'],
            'within_due_date' => $request['within_due_date']
        ]);
        $id = $save->id;
        bill_payments::create([
'user_id'=>$request['bill_user'],
'bill_id'=>$id,
        ]);

                return response($save);
//         $user =  User::whereId(2)->first();
//         // dd($user);
// $request['username'] = $user['name'];
// return parent::store($request);
    }

}
