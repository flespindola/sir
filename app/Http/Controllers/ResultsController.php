<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Crypt;
use App\Models\WebService;
use App\Models\Result;

class ResultsController extends Controller
{

    public function search(Request $request)
    {
        $os = $request->input('accession_number');
        $p = $request->input('patient_id');
        $date = $request->input('birthdate');

        if(!is_numeric($os)) {
            return Redirect::back()->with('danger', 'Código de exame inválido. O código de exame deve ser uma sequência de números. Ex: 7804234');
        }

        try {

            // Consulta se o código do exame é válido
            $envelop = WebService::getValidateOSEnvelop($os);
            if(!WebService::getValidateOS($envelop, env('SOAP_ACTION'))) {
                return Redirect::back()->with('warning', 'Não conseguimos encontrar o exame. Verifique código informado. Em caso de dúvidas, favor entrar em contato com nossa equipe.');
            }

            // Consulta se a data de nascimento é válida
            $envelop = WebService::getValidateOSExamPatientEnvelop($os, $date);
            if(!WebService::getValidateOSExamPatient($envelop, env('SOAP_ACTION'))) {
                return Redirect::back()->with('warning', 'Data de nascimento incorreta. Você deve utilizar a data de nascimento do paciente. Em caso de dúvidas, favor entrar em contato com nossa equipe.');
            }
            
        } catch(\Exception $exception) {
            return Redirect::back()->with('danger', 'Ops! Ocorreu um erro inesperado. Por favor, tente novamente mais tarde.');

        }
        
        try {
            
            $response = Http::post(env('CARESTREAM_WEBSERVICE')."user_name=".env('CARESTREAM_USER')."&password=".env('CARESTREAM_PASSWORD'), [
            "TextToEncrypt" => "user_name=".env('CARESTREAM_USER').".&password=".env('CARESTREAM_PASSWORD')."&accession_number=".$os.'&patient_id='.$p,
            "AddTS" => true,
            "UseUTC" => false,
            "TimeStampFormat" => null
            ]);
            $shs = str_replace('"', '', $response->body());
            $url = env('CARESTREAM_USER_URL').$shs.'&force_all_browsers=true';
            return redirect()->away($url);
            
        } catch(\Exception $exception) {
            return Redirect::route('resultados')->with('danger', 'Ocorreu um erro inesperado. Por favor, tente novamente mais tarde.');
        }
        
    }
    
    public function view(Request $request)
    {
        
        if($request->has('os') and $request->has('p')) {
            
            $os = $request->query('os');
            $p = $request->query('p');
            
            if(!is_numeric($os) or !is_numeric($p)) {
                return Redirect::route('resultados');
            }
            
            // Consulta se o código do exame é válido
            $envelop = WebService::getValidateOSEnvelop($os);
            if(!WebService::getValidateOS($envelop, env('SOAP_ACTION'))) {
                return Redirect::route('resultados');
            }
            
            try {
            
                $response = Http::post(env('CARESTREAM_WEBSERVICE')."user_name=".env('CARESTREAM_USER')."&password=".env('CARESTREAM_PASSWORD'), [
                    "TextToEncrypt" => "user_name=".env('CARESTREAM_USER').".&password=".env('CARESTREAM_PASSWORD')."&accession_number=".$os.'&patient_id='.$p,
                    "AddTS" => true,
                    "UseUTC" => false,
                    "TimeStampFormat" => null
                ]);
                $shs = str_replace('"', '', $response->body());
                $url = env('CARESTREAM_USER_URL').$shs.'&force_all_browsers=true';
                
            } catch(\Exception $exception) {
                return Redirect::back()->with('danger', 'Ocorreu um erro inesperado. Por favor, tente novamente mais tarde.');
            }
            
            return redirect()->away($url);
            
        } else {
            
            return Redirect::route('resultados')->with('danger', 'Ocorreu um erro inesperado. Por favor, tente novamente mais tarde.');
            
        }
    }

    public static function sendResultsToWhatsapp()
    {
        $data = WebService::getNewExams(env('ERP_ACTION'));
        
        if(count(get_object_vars($data)) == 0 or count($data->Resultado) == 0) {
            
            return;
        
        } elseif(count($data->Resultado) == 1) {
            
            $contact = $data->Resultado;
            
            // Recebe o nome
            $name = $contact->NOMEPACIENTE;
                
            // Formata número do WhatsApp
            $phone = $contact->CELULAR;
            $phone = str_replace('(', '', $phone);
            $phone = str_replace(')', '', $phone);
            $phone = '55'.$phone;
            
            // Formata o link
            $link = route('resultados.visualizar', 
                [
                    'os' => $contact->ACCESIONUMBER,
                    'p' => $contact->CODPACIENTE
                ]);

            // Registra o resultado
            Result::create([
                'birthdate' => $contact->DATADENASCIMENTO,
                'os' => $contact->ACCESIONUMBER,
                'patient_id' => $contact->CODPACIENTE
            ]);
                
            // Envia para o WhatsApp do paciente
            $response = Http::acceptJson()->post(self::$botdesignerUrl, [
                "apiToken" => "45dc6f16-4f9b-481b-a910-aef38e95ee1a",
                "templateId" => "62ec1ffc4b5cf3000836610a",
                "phoneNumber" => $phone,
                "externalId" => 'test',
                "attributes" => [
                    [
                        "name" => "nome",
                        "type" => "@sys.text",
                        "value" => $name
                    ],
                    [
                        "name" => "link",
                        "type" => "@sys.text",
                        "value" => $link
                    ],
                ]
            ]);
            
        } else {
            
            foreach($data->Resultado as $contact) {
                
                if(gettype($contact->CELULAR) != 'string') {
                    continue;
                }
                
                if($contact->NOMEPACIENTE == "INDEFINIDO" or $contact->CELULAR == "INDEFINIDO" or $contact->ACCESIONUMBER == "INDEFINIDO" or $contact->DATANASC == "INDEFINIDO") {
                    continue;
                }
                
                if(self::wasSent($contact->ACCESIONUMBER)) {
                    continue;
                }
                
                // Recebe o nome
                $name = $contact->NOMEPACIENTE;
                
                // Formata número do WhatsApp
                $phone = $contact->CELULAR;
                $phone = str_replace('(', '', $phone);
                $phone = str_replace(')', '', $phone);
                $phone = '55'.$phone;
                
                // Formata o link
                $link = route('resultados.visualizar', 
                    [
                        'os' => $contact->ACCESIONUMBER,
                        'p' => $contact->CODPACIENTE
                    ]);

                // Registra o resultado
                Result::create([
                    'birthdate' => $contact->DATADENASCIMENTO,
                    'os' => $contact->ACCESIONUMBER,
                    'patient_id' => $contact->CODPACIENTE
                ]);
                    
                // Envia para o WhatsApp do paciente
                $response = Http::acceptJson()->post(self::$botdesignerUrl, [
                    "apiToken" => "45dc6f16-4f9b-481b-a910-aef38e95ee1a",
                    "templateId" => "62ec1ffc4b5cf3000836610a",
                    "phoneNumber" => $phone,
                    "externalId" => 'test',
                    "attributes" => [
                        [
                            "name" => "nome",
                            "type" => "@sys.text",
                            "value" => $name
                        ],
                        [
                            "name" => "link",
                            "type" => "@sys.text",
                            "value" => $link
                        ],
                    ]
                ]);

            }
            
        }
        
    }
    
    public function sendMessageCallback(Request $request)
    {
        $content = json_decode($request->getContent());
        
        if($content->token != env('BOTDESIGNER_TOKEN')) {
            abort(404);
        }
        
        $result = Result::find($content->externalId);
        
        switch($content->status)
        {
            case -1:
                $result->status = "Invalid number";
                $result->save();
                break;
            case -4:
                $result->status = "Sent";
                $result->save();
                break;
        }
        
        return;
    }

}
