<?php

namespace App\Http\Controllers;

use auth;
use Pusher\Pusher;
use Illuminate\Http\Request;
use App\Events\PusherBroadcast;
use Illuminate\Support\Facades\Validator;

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
            $pusher = new Pusher($app_key, $app_secret, $app_id, ['cluster' => $cluster,'useTLS' => true,]);

            $response = $pusher->trigger('chat_channel', 'App\\Events\\MessageSent', ['message' => 'hi i em awaab.','user_id' =>1]);

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
}
