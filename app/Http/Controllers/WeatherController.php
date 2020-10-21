<?php

namespace App\Http\Controllers;

use App\Services\WeatherServices;

class WeatherController extends Controller
{
    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function getWeather()
    {
        $weatherService = $this->container->make(WeatherServices::class);
        $weatherData = $weatherService->getWeather();

        $time_unix = $weatherData['fact']['obs_time'];
        $temp = $weatherData['fact']['temp'];
        $humidity = $weatherData['fact']['humidity'];
        $speed = $weatherData['fact']['wind_speed'];
        $pressure = $weatherData['fact']['pressure_mm'];
        $icon = $weatherData['fact']['icon'] . '.svg';

        $today = date('j/m/Y, H:i');
        $time = date('j/m/Y, H:i', $time_unix);

        return view('weather', [
            'date' => $today,
            'time' => $time,
            'temp' => $temp,
            'humidity' => $humidity,
            'speed' => $speed,
            'pressure' => $pressure,
            'icon' => $icon,
        ]);
    }
}