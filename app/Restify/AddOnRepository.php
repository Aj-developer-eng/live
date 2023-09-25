<?php

namespace App\Restify;

use App\Models\AddOn;
use Binaryk\LaravelRestify\Fields\File;
use Binaryk\LaravelRestify\Http\Requests\RestifyRequest;
use Illuminate\Support\Facades\Storage;

class AddOnRepository extends Repository
{
    public static string $model = AddOn::class;
    public static string $uriKey = 'AddsOn';

    public function fields(RestifyRequest $request): array
    {

        // dd($name);

        return [
//  file save without overriding method  //
            //   File::make('icon') // Define a file upload field for 'icon'
            //     ->disk('public') // Specify the storage disk
            //     ->storeCallback(function () { return 'images'; }) // Specify the storage path
            //     ->rules('required'), // Add validation rules

//  file save without overriding method  //
            File::make('icon')->indexCallback(function ($value) use ($request) {
                $file = $request->file('icon');
                $filename = time() . $file->getClientOriginalName();
                $s3 = Storage::disk('s3');
                $s3->put($filename, file_get_contents($file), 'public');
                $url = Storage::disk('s3')->url($filename);
                return $url;

            }) // Define a file upload field for 'icon'
                ->disk('public') // Specify the storage disk
                ->storeCallback(function () {return 'images';}) // Specify the storage path
                ->rules('required'), // Add validation rules

            field('heading')->rules('required'),
            field('sub_heading')->rules('required'),
            field('price')->rules('required'),
            field('popup_content')->rules('required'),
            field('type')->rules('required'),
            field('status')->rules('required'),
            field('description')->rules('required'),
            field('days')->rules('required'),

        ];
    }

}
