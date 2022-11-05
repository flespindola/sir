<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WebService extends Model
{
    use HasFactory;

    private static function getURL()
    {
        return env('SOAP_BASE').env('SOAP_URL');
    }

    public static function curlRun($envelop, $action)
    {
        $curl = curl_init();

        curl_setopt_array($curl, [
            CURLOPT_URL => self::getURL(),
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_USERPWD => env('SOAP_USER').':'.env('SOAP_PASSWORD'),
            CURLOPT_HTTPHEADER => [
                'Content-Type: text/xml; charset=utf-8',
                'SOAPAction: http://www.totvs.com/'.$action
            ],
            CURLOPT_SSL_VERIFYPEER => false,
            CURLOPT_POSTFIELDS => $envelop
        ]);

        curl_setopt($curl, CURLOPT_FAILONERROR, true);

        return $curl;
    }

    public static function getValidateOSEnvelop($os)
    {
        $envelop = '<soapenv:Envelope xmlns:soapenv="http://schemas.xmlsoap.org/soap/envelope/" xmlns:tot="http://www.totvs.com/">
                    <soapenv:Header/>
                    <soapenv:Body>
                        <tot:RealizarConsultaSQL>
                            <!--Optional:-->
                            <tot:codSentenca>C1.99.01</tot:codSentenca>
                            <!--Optional:-->
                            <tot:codColigada>1</tot:codColigada>
                            <!--Optional:-->
                            <tot:codSistema>O</tot:codSistema>
                            <!--Optional:-->
                            <tot:parameters>OS='.$os.';</tot:parameters>
                        </tot:RealizarConsultaSQL>
                    </soapenv:Body>
                    </soapenv:Envelope>';

        return $envelop;
    }

    public static function getValidateOSExamPatientEnvelop($os, $date)
    {
        $os = (int)$os;
        $date = implode("-",array_reverse(explode("/",$date)));
        
        $envelop = '<soapenv:Envelope xmlns:soapenv="http://schemas.xmlsoap.org/soap/envelope/" xmlns:tot="http://www.totvs.com/">
                        <soapenv:Header/>
                        <soapenv:Body>
                        <tot:RealizarConsultaSQL>
                            <!--Optional:-->
                            <tot:codSentenca>C1.99.02</tot:codSentenca>
                            <!--Optional:-->
                            <tot:codColigada>1</tot:codColigada>
                            <!--Optional:-->
                            <tot:codSistema>O</tot:codSistema>
                            <!--Optional:-->
                            <tot:parameters>OS='.$os.';DTNASC='.$date.'</tot:parameters>
                        </tot:RealizarConsultaSQL>
                        </soapenv:Body>
                    </soapenv:Envelope>';

        return $envelop;
    }

    public static function getNewExamsEnvelop()
    {
        $envelop = '<soapenv:Envelope xmlns:soapenv="http://schemas.xmlsoap.org/soap/envelope/" xmlns:tot="http://www.totvs.com/">
                    <soapenv:Header/>
                    <soapenv:Body>
                        <tot:RealizarConsultaSQL>
                            <!--Optional:-->
                            <tot:codSentenca>C1.99.03</tot:codSentenca>
                            <!--Optional:-->
                            <tot:codColigada>1</tot:codColigada>
                            <!--Optional:-->
                            <tot:codSistema>O</tot:codSistema>
                            <!--Optional:-->
                            <tot:parameters></tot:parameters>
                        </tot:RealizarConsultaSQL>
                    </soapenv:Body>
                    </soapenv:Envelope>';
        
        return $envelop;
    }

    public function getValidateOS($envelop, $action)
    {

        $curl = self::curlRun($envelop, $action);

        $response = curl_exec($curl);

        $response = preg_replace("/(<\/?)(\w+):([^>]*>)/", "$1$2$3", $response);

        $xml = new \SimpleXMLElement($response);

        $body = $xml->xpath('sBody')[0];

        $xmlResponse = json_decode(json_encode((array)$body), TRUE); 

        $xmlResult = simplexml_load_string($xmlResponse["RealizarConsultaSQLResponse"]["RealizarConsultaSQLResult"], "SimpleXMLElement", LIBXML_NOCDATA);

        $jsonResult = json_encode($xmlResult);

        $array = json_decode($jsonResult,TRUE);

        $response = $array["Resultado"]["VALIDA"];

        curl_close($curl);

        return filter_var($response, FILTER_VALIDATE_BOOLEAN);
    }


    public function getValidateOSExamPatient($envelop, $action)
    {
        $curl = self::curlRun($envelop, $action);

        $response = curl_exec($curl);

        $response = preg_replace("/(<\/?)(\w+):([^>]*>)/", "$1$2$3", $response);
        
        $xml = new \SimpleXMLElement($response);
        
        $body = $xml->xpath('sBody')[0];
        
        $xmlResponse = json_decode(json_encode((array)$body), TRUE);
        
        $response = $xmlResponse["RealizarConsultaSQLResponse"]["RealizarConsultaSQLResult"];

        curl_close($curl);

        if($response == "<NewDataSet />") {
            return false;
        } else {
            return true;
        }
    }

    public static function getNewExams($action)
    {
        $envelop = self::getNewExamsEnvelop();

        $curl = self::curlRun($envelop, $action);

        $response = curl_exec($curl);

        $response = preg_replace("/(<\/?)(\w+):([^>]*>)/", "$1$2$3", $response);
        
        $xml = new \SimpleXMLElement($response);
        
        $body = $xml->xpath('sBody')[0];
        
        $xmlResponse = json_decode(json_encode((array)$body), TRUE);
        
        $response = $xmlResponse["RealizarConsultaSQLResponse"]["RealizarConsultaSQLResult"];

        curl_close($curl);
        
        $response = simplexml_load_string($response);
        $response = json_encode($response);
        $response = json_decode($response);
        
        return $response;
    }
}
