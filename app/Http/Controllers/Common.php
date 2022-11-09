<?php

namespace App\Http\Controllers;
use App\AdminLogs;
use App\ClientsLogs;
use App\Admin;
class Common extends Controller
{
    
	
	public static function saveClientLogs($client_id,$message){
	 $logs = new ClientsLogs;
	 $logs->client_id = $client_id;
	 $logs->message   = $message;
	 $logs->save();
	}
	
	//save admin logs
    public static function saveLogs($key_name,$key_id,$message,$created_by=NULL){
	 $logs = new AdminLogs;
	 $logs->key_name   = $key_name;
	 $logs->key_id     = $key_id;
	 $logs->message    = $message;
	 $logs->created_by = $created_by;
	 $logs->save();
	}
	//show created by Name\
	public static function createdByName($id){
	 $admin = Admin::find($id);
	 if(!empty($admin->name)){
	 $name = $admin->name;
	 }else{
	 $name = "ID =".$id;
	 }
	 return $name;
	}
	
	//google recaptcha
	public static function VerifyCaptcha($response)
    {
	
	 $google_url = "https://www.google.com/recaptcha/api/siteverify";
     $secret     = '6LeMueQUAAAAACXA8eAOD1JMWjvjZnGMwiRpX06p';
	
	
        $url = $google_url."?secret=".$secret.
               "&response=".$response;
 
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, TRUE);
        curl_setopt($curl, CURLOPT_TIMEOUT, 15);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, TRUE);
        curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, 2); 
        $curlData = curl_exec($curl);
 
        curl_close($curl);
 
        $res = json_decode($curlData, TRUE);
        if($res['success'] == 'true') 
            return TRUE;
        else
            return FALSE;
    }
}
