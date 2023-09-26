<?php

namespace App\Http\Controllers;

use App\Events\PusherBroadcast;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Pusher\Pusher;

class pusherController extends Controller
{
    public function sendMessage(Request $request)
    {
        // dd($request);
        $return_data['response_code'] = 0;
        $return_data['message'] = 'Something went wrong, Please try again later.';

        $rules = ['message' => 'required'];
        $messages = ['message.required' => 'Please enter message to communicate.'];
        $validator = Validator::make($request->all(), $rules, $messages);
        if ($validator->fails()) {
            $message = implode("", $validator->messages()->all());
            $return_data['message'] = $message;
            return $return_data;
        }

        try {

            $app_id = '1674073';
            $app_key = '8a0808c4329361554dd6';
            $app_secret = '416b172eb9c638015c2d';
            $cluster = 'ap2';
            $pusher = new Pusher($app_key, $app_secret, $app_id, ['cluster' => $cluster, 'useTLS' => true]);

            $response = $pusher->trigger('chat_channel', 'App\\Events\\MessageSent', ['message' => 'hi i em awaab.', 'user_id' => 1]);

            if ($response) {

                $authToken = $pusher->socket_auth('chat_channel', 17621.1852923);
                // echo $authToken;
            } else {
                header('', true, 403); // Access denied
            }
            if ($response) {
                $return_data['response_code'] = 1;
                $return_data['message'] = 'Success.';
                $return_data['token'] = $authToken;
            }
        } catch (\Exception $e) {
            $return_data['message'] = $e->getMessage();
        }
        return $return_data;
    }
    public function index()
    {
        return view('index');
    }
    public function broadcast(Request $request)
    {
        broadcast(new PusherBroadcast($request->get('message')))->toOthers();

        return view('broadcast', ['message' => $request->get('message')]);

    }
    public function receive(Request $request)
    {
        return view('receive', ['message' => $request->get('message')]);
    }
    public function retrive_images()
    {
        $imagesArr = [];
        $folderPath = public_path('images');
        $files = glob($folderPath . '/*');

        if ($files !== false) {
            foreach ($files as $filePath) {
                $originalURL = $filePath;

                // Add the "images" segment after "storage/"
                $modifiedURL = str_replace('E:\Task-Backend\public\images/', 'http://127.0.0.1:8000/images/', $originalURL);
                // dd($modifiedURL);
                array_push($imagesArr, $modifiedURL);
            }
        } else {
            echo "No files found in the folder.";
        }
        // dd($imagesArr);

        return response($imagesArr);
    }
    public function save_image(Request $request)
    {

        // dd($request);
        $inputString = $request['img'];
        $fileName = basename($inputString);

        $folderPath = public_path('images');
        $files = glob($folderPath . '/' . $fileName);
// dd($files);
        if ($files !== false && $files != null) {
            foreach ($files as $filePath) {
                echo "exist" . "<br>";
                echo $filePath . "<br>";die;
            }
        } else {
            echo "No files found in the folder.";die;
        }

    }
}
