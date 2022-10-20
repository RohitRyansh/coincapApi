<?php
class coinApi
{
    public $response;
    function __construct($data=null)
    {  
        $curl=curl_init();
        if(!empty($data))
        {
            curl_setopt_array($curl, [CURLOPT_URL => "https://api.coincap.io/v2/assets/".$data,CURLOPT_RETURNTRANSFER => true,]);
        }
        else
        {
            curl_setopt_array($curl, [CURLOPT_URL => "https://api.coincap.io/v2/assets",CURLOPT_RETURNTRANSFER => true,]);
        }
        $this->response = curl_exec($curl);
        $err = curl_error($curl);
        curl_close($curl);
        if ($err) 
        {
            echo "cURL Error #:" . $err;
        } 
        else 
        {
            $this->response=json_decode($this->response,true);
        }
    }
}

?>