<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class ClimaController extends Controller
{
    public function obtenerClima($ciudad)
    {
        $apiKey = env('OPENWEATHER_API_KEY'); 
        $url = "https://api.openweathermap.org/data/2.5/weather?q={$ciudad}&appid={$apiKey}&units=metric&lang=es";

        $response = Http::withOptions([
            'verify' => false
        ])->get($url);

        if ($response->successful()) {
            $data = $response->json();

            // Traducción simple de códigos de país
            $paises = [
                'MX' => 'México',
                'US' => 'Estados Unidos',
                'ES' => 'España',
                'PH' => 'Filipinas',
                'AR' => 'Argentina',
                'CO' => 'Colombia',
                'CL' => 'Chile',
                'BR' => 'Brasil',
                'PE' => 'Perú',
                // Agrega más si deseas
            ];

            $codigoPais = $data['sys']['country'];
            $nombrePais = $paises[$codigoPais] ?? $codigoPais;

            $resultado = [
                'ciudad' => $data['name'],
                'pais' => $nombrePais,
                'temperatura' => $data['main']['temp'] . '°C',
                'sensacion_termica' => $data['main']['feels_like'] . '°C',
                'clima' => $data['weather'][0]['description'],
                'icono' => "https://openweathermap.org/img/wn/" . $data['weather'][0]['icon'] . "@2x.png"
            ];

            return response()->json($resultado);
        } else {
            return response()->json(['error' => 'No se pudo obtener el clima'], $response->status());
        }
    }
}
