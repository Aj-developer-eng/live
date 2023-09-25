<?php

namespace App\Http\Controllers;

use App\Models\Bill;

use App\Models\User;
use App\Models\Payment;
use Illuminate\Http\Request;
use App\Http\Resources\UserCollection;
use League\Flysystem\AwsS3V3\PortableVisibilityConverter;

use Illuminate\Support\Facades\Storage;

class TaskController extends Controller
{
    public function User()
    {

        return new UserCollection(User::with(['profile.bills'])->get());

    }
    public function payment($id, Request $request)
    {
        try {

            $save = Payment::create([
                'user_id' => $request->bill_user,
                'bill_id' => $id,
                'receivable' => $request->bill_price,
                'bill_status' => 'paid',
            ]);

            return $save;
        } catch (\Throwable $th) {
            throw $th;
        }

    }
    public function upload(Request $request){
        // dd($request);
        $file = $request->file('image');

        $extension = $file->extension();
        $mimeType = $file->getClientMimeType();
        $filename = time().$file->getClientOriginalName();
        $s3 = Storage::disk('s3');
        $s3->put($filename, file_get_contents($file), 'public');
        $name = Storage::disk('s3')->url($filename);

// dd($name);
print_r([
            'name' => $name,
            'mime_type' => $mimeType,
            'extension' => $extension,
        ]);

            }
}
