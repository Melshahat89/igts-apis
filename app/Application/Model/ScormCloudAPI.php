<?php

class ScormCloudAPI{

    const API_SECRET = "RGWAxGWRDVMMt8eNOWT9MysTSdyM3XV29whhWpWR";
    const API_PENS = "CCA631D74980BF44AE9855EAAF1DD696";
    const API_APP = "0CS959U5GZ";

    protected function callAPI($postdata, $URL, $token=null)
    {

        $curl = curl_init();

        if($token){

            curl_setopt_array($curl, array(
                CURLOPT_URL => $URL,
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => "$token",
                CURLOPT_ENCODING => "",
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 0,
                CURLOPT_FOLLOWLOCATION => true,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => "POST",
                CURLOPT_POSTFIELDS => $postdata,
                CURLOPT_HTTPHEADER => array(
                    "Content-Type: application/json"
                ),
            ));

        }else{

            curl_setopt_array($curl, array(
                CURLOPT_URL => $URL,
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => "",
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 0,
                CURLOPT_FOLLOWLOCATION => true,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => "POST",
                CURLOPT_POSTFIELDS => $postdata,
                CURLOPT_HTTPHEADER => array(
                    "Content-Type: application/json"
                ),
            ));

        }
        
        $response = curl_exec($curl);
        curl_close($curl);
        $result = json_decode($response, true);
        return $result ;
        
    }

    public function CreateUploadAndImportCourseJob(){
        
    }
}