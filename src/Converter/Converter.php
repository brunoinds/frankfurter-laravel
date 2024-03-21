<?php

namespace Brunoinds\FrankfurterLaravel\Converter;

use Illuminate\Support\Facades\Cache;
use DateTime;
use Carbon\Carbon;


class Converter{
    public static function convertFromTo(DateTime $date, float $amount, string $from, string $to){
        return Converter::fetchConvertion($date, $amount, $from, $to);
    }
    private static function fetchConvertion(DateTime $date, float $amount, string $from, string $to){
        if ($date->format('Y-m-d') > Carbon::now()->timezone('America/Lima')->format('Y-m-d')){
            $date = Carbon::now()->timezone('America/Lima')->toDateTime();
        }

        $dateString = $date->format('Y-m-d');

        $curl = curl_init();

        $curlURL = 'https://api.frankfurter.app/' . $dateString . '?from=' . $from . '&to=' . $to . '&amount=' . $amount;

        $stores = [];
        $cachedValue = Cache::store('file')->get('Brunoinds/FrankfurterLaravelStore');
        if ($cachedValue){
            $stores = json_decode($cachedValue, true);
            if (isset($stores[$curlURL])){
                return $stores[$curlURL];
            }
        }


        curl_setopt_array($curl, [
            CURLOPT_URL => $curlURL,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_SSL_VERIFYPEER => 0,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 2,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'GET',
        ]);

        $response = curl_exec($curl);
        curl_close($curl);
        $results = json_decode($response, true);

        if (json_last_error() !== JSON_ERROR_NONE) {
            throw new \Exception('Invalid JSON response: "' . json_last_error_msg(). '". The API response was: ' . $response);
        }

        try {
            $rate = $results['rates'][$to];

            $stores[$curlURL] = $rate;
            Cache::store('file')->put('Brunoinds/FrankfurterLaravelStore', json_encode($stores));

            return $rate;
        } catch (\Throwable $th) {
            throw new \Exception('Invalid JSON response: "' . json_last_error_msg(). '". The API response was: ' . $response);
        }
    }

}