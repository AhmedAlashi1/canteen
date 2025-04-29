<?php

namespace App\Helpers;

use App\Models\Notifications;
use Carbon\Carbon;
use GuzzleHttp\Exception\ConnectException;
use Kreait\Firebase\Factory;
use Kreait\Firebase\ServiceAccount;
use Laravellevel\Message\OptionsBuilder;
use Laravellevel\Message\PayloadDataBuilder;
use Laravellevel\Message\PayloadNotificationBuilder;
use Intervention\Image\ImageManagerStatic as Image;
use level;

/**
 * Class Helpers
 * @package App\Helpers
 */
trait Functions
{

    public function whatsapp($phone , $bode){

        $whatsappToken = config('services.whatsapp.token');
        $whatsappInstance = config('services.whatsapp.instance');

        $params=array(
            'token' => $whatsappToken,
            'to' => $phone,
            'body' =>$bode,

        );
        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => "https://api.ultramsg.com/{$whatsappInstance}/messages/chat",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_SSL_VERIFYHOST => 0,
            CURLOPT_SSL_VERIFYPEER => 0,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "POST",
            CURLOPT_POSTFIELDS => http_build_query($params),
            CURLOPT_HTTPHEADER => array(
                "content-type: application/x-www-form-urlencoded"
            ),
        ));

        $response = curl_exec($curl);
        $err = curl_error($curl);

        curl_close($curl);

        if ($err) {
            echo "cURL Error #:" . $err;
        }

    }


    public function sendVerificationCode(string $phone, int $code,$update_phone = false): void
    {
        if ($update_phone){
            $msg = 'Your Update Phone code is ' . $code . ' Welcome to Fit Row 💪🏻';
        }else{
        $msg = 'Your activation code is ' . $code . ' Welcome to Fit Row 💪🏻';
        }
        $this->whatsapp($phone, $msg);
    }

}
