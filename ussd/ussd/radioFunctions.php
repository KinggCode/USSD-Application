<?php

error_reporting(0);

//error_reporting(E_ALL);

//ini_set('display_errors', 1);

class radioFunctions{

    //Write Log Function 
    public function writeLog($service,$msisdn,$sequence_ID,$case,$request, $response){
        date_default_timezone_set('GMT');
        $time = date('Y-m-d H:i:s');
        $record = $time . "|MTN|".$service."|" . $msisdn . "|" . $sequence_ID . "|" . $case."|".$request."|".$response . PHP_EOL;
        file_put_contents('radio_access.log', $record, FILE_APPEND);

       

    }

    //Welcome Page 
    public function welcome($msisdn, $sequence_ID,$case,$request){
        $reply = "Welcome to Semester 2." . "\r\n"."Select a class to enroll" . "\r\n"."1. HCI"."\r\n"."2. IT infrastructure". "\r\n"."3. Software Engineering". "\r\n"."4. Algorithms and Design". "\r\n"."5. Mobile Web" ;
        $this->writeLog('welcome',$msisdn,$sequence_ID,$case,$request,$reply);
        return $reply;

    }

    // Confirmation Page
    public function confirm($msisdn, $sequence_ID,$case,$request){
        $reply = "Are you sure you want enroll in this class ?" . "\r\n"."1. Yes"."\r\n"."2. No" ;
        $this->writeLog('confirm',$msisdn,$sequence_ID,$case,$request,$reply);
        return $reply;
    }

    //Thank You Function 
    public function thankyou($msisdn, $sequence_ID,$case,$request){

        switch ($request) {

            case 1 :
                $reply= "Congratulations, you have been enrolled in HCI";
                break;

            case 2 :
                $reply= "Congratulations, you have been enrolled in IT infrastructure";
                break;

            case 3 :
                $reply= "Congratulations, you have been enrolled in Software Engineering";
                break;

            case 4 :
                $reply= "Congratulations, you have been enrolled in Algorithms and Design";
                break;

            case 5 :
                $reply= "Congratulations, you have been enrolled in Mobile Web";
                break;

            case 6 :
                $reply= "You have already registered for this course" ;

            default :
                $reply = "Invalid option Selected";
        }

        $this->writeLog('welcome',$msisdn,$sequence_ID,$case,$request,$reply);
        return $reply;

    }

}





