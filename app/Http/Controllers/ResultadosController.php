<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class ResultadosController extends Controller
{

    public function search(Request $request)
    {
        $response = Http::post('http://200.143.98.35/portal/CSPublicQueryService/CSPublicQueryService.svc/json/Encrypt?user_name=unineuro&password=unineuro', [
            "TextToEncrypt" => "user_name=unineuro&accession_number=14367942",
            "AddTS" => true,
            "UseUTC" => false,
            "TimeStampForma" => null
        ]);

        $shs = str_replace('"', '', $response->body());
        $url = 'https://200.143.98.35/portal?shs='.$shs;

        return redirect()->away($url);
    }

}
