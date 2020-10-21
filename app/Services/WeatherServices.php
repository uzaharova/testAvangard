<?php

namespace App\Services;

use GuzzleHttp\Client;

class WeatherServices
{
    /**
     * @return mixed
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function getWeather()
    {
        $params = [
            'lat' => config('services.yandex.lat'),
            'lon' => config('services.yandex.lon'),
            'lang' => config('services.yandex.lang')
        ];

        $transport = new Client();
        $yandexApiResponse = $transport->request(
            'GET',
            config('services.yandex.url') . '?' . http_build_query($params),
            [
                'headers' => [
                    'Content-Type' => 'application/json',
                    'X-Yandex-API-Key' => config('services.yandex.api_key')
                ]
            ]
        );
        $response = json_decode($yandexApiResponse->getBody(), true);
        if (!$response) {
            throw new \Exception(
                'Yandex API returns wrong, error: ' . json_encode($response, JSON_UNESCAPED_UNICODE)
            );
        }

        return $response;
    }
}