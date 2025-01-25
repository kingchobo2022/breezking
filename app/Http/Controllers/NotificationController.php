<?php

namespace App\Http\Controllers;

use App\Models\User;
use Exception;
use Illuminate\Http\Request;

class NotificationController extends Controller
{
    public function NotificationIndex() {
        $users = User::whereIn('role', ['user', 'agent'])->get();
        return view('admin.notification.update', compact('users'));
    }

    public function NotificationSend(Request $request) {
        $user = User::where('id', '=', $request->user_id)->first();
        if (!empty($user->token)) {
            try {
                $serverKey = 'Please set your Firebase server key';

                $token = $user->token;
                $body['title'] = $request->title;
                $body['message'] = $request->message;
                $body['body'] = $request->message;
            
                $url = 'https://fcm.google.com/fcm/send';

                $notification = ['title' => $request->title, 'body' => $request->message];
                $arrayToSend = ['to' => $token, 'data' => $body, 'priority' => 'high' ];

                $json1 = json_encode($arrayToSend);
                $headers = [];
                $headers[] = 'Content-Type: application/json';
                $headers[] = 'Authorization: key='. $serverKey;
                $ch = curl_init();
                curl_setopt($ch, CURLOPT_URL, $url);
                curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
                curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
                curl_setopt($ch, CURLOPT_POSTFIELDS, $json1);
                curl_setopt($ch, CURLOPT_HEADER, $headers);

                $response = curl_exec($ch);
                curl_close($ch);

            } catch (Exception $e) {
                echo $e;
            }
        }

        return redirect('admin/notification')->with('success', 'Notification Successfully Send.');
    }
}
