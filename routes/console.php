<?php

use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote')->hourly();

Artisan::command('getForecast', function () {

    $locations = \App\Models\Site::getFiveSites();
    $_OPEN_WEATHER = "6aff05a2599912b387c2b5390360cc84";
    foreach ($locations as $location) {
        $lat = $location->lat;
        $lng = $location->lng;
        $url = "https://api.openweathermap.org/data/3.0/onecall?lat=$lat&lon=$lng&units=metric&exclude=minutely&appid=$_OPEN_WEATHER";

        $site_id = $location->site_id;
        $data = json_encode(file_get_contents($url));
//        dd($data);

        $forecast = new \App\Models\Forecast($data);

        dd($forecast);
    }
});