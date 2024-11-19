<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Http;

function mypage() {
    $date = date('Y/m/d');
    $resp = Http::get('http://api.jugemkey.jp/api/horoscope/free/' . $date);
    $resp = $resp->json();
    $horoscope = $resp['horoscope'];
    $dateFortune = $horoscope[$date];
    array_multisort(
        array_column($dateFortune, 'rank'), SORT_ASC, $dateFortune
    );

    return view('fortune', compact('dateFortune'));
}