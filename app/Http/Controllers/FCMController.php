<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Ixudra\Curl\Facades\Curl;

/**
 * 
 */
class FCMController extends Controller
{

    /**
     * Register FCM Token which created from FCM API into Database.
     * 
     * @param Request $request Request data from client.
     * 
     * @return String
     */
    public function registerToken(Request $request)
    {
        $token = $request->input('token');
        
        /**
         * @todo
         * 데이터베이스
         * User 테이블
         * Token 칼럼에 값을 추가
         */

         return;
    }

    /**
     * Request notification to FCM API
     * 
     * @param Array $tokens       Array include user's registed FCM token.
     * @param Array $notification Message be request to FCM API.
     * 
     * @return Boolean
     */
    private function _sendNotification($tokens, Array $notification)
    {
        $url = 'https://fcm.googleapis.com/fcm/send';

        $fields = array(
            'to' => '/topics/news',
            // 'registration_ids' => $tokens,
            'notification' => $notification
        );

        $headers = array(
            'Authorization:key=' . env('FCM_API_KEY'),
            'Content-Type:application/json'
        );

        // echo json_encode($fields);
        // return ;

        $response = Curl::to($url)
            ->withHeaders($headers)
            ->withData(json_encode($fields))
            ->post();
            
        return $response;
    }

    /**
     * Push notification with user's registed FCM token.
     * 
     * @param Request $request Request data from client.
     * 
     * @return Void
     */
    public function pushNotification(Request $request)
    {
        // [1] 데이터베이스로부터 유저의 Token을 가져온다
        $userTokens = /* a */null;

        // [2] 가져온 토큰을 $tokens에 저장

        // [3] $notification에 알림 메시지 저장
        $notification = $request->all();

        // [4] $notificaiton이 올바른 배열 형식인지 검사.

        $messageStatus = $this->_sendNotification(null/* $tokens */, $notification);

        // [5] FCM의 응답을 반환.
        return $messageStatus;
    }
}
