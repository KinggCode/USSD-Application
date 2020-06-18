<?php

error_reporting(0);

//error_reporting(E_ALL);

//ini_set('display_errors', 1);



class radioFunctions

{



    public function __construct()

    {



    }



    public function __destruct()

    {



    }





    public function welcome($msisdn, $sequence_ID,$case,$request)

    {



        $reply = "Welcome to Semester 2." . "\r\n"."Select a class to enroll" . "\r\n"."1. HCI"."\r\n"."2. IT infrastructure". "\r\n"."3. Software Engineering". "\r\n"."4. Algorithms and Design". "\r\n"."5. Mobile Web" ;



        $this->writeLog('welcome',$msisdn,$sequence_ID,$case,$request,$reply);



        return $reply;

    }


    public function writeLog($service,$msisdn,$sequence_ID,$case,$request, $response){

        date_default_timezone_set('GMT');

        $time = date('Y-m-d H:i:s');



        $record = $time . "|MTN|".$service."|" . $msisdn . "|" . $sequence_ID . "|" . $case."|".$request."|".$response . PHP_EOL;

        file_put_contents('radio_access.log', $record, FILE_APPEND);

    }


    public function confirm($msisdn, $sequence_ID,$case,$request)

    {



        $reply = "Are you sure you want enroll in this class ?" . "\r\n"."1. Yes"."\r\n"."2. No" ;



        $this->writeLog('confirm',$msisdn,$sequence_ID,$case,$request,$reply);



        return $reply;

    }



    public function thankyou($msisdn, $sequence_ID,$case,$request)

    {

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

            // case 6 :

            //     $reply= "Thank you for voting for Kofi Ricpop";

            //     break;

            // case 7 :

            //     $reply= "Thank you for voting for Walier";

            //     break;

            default :

                $reply = "Invalid option Selected";



        }



        $this->writeLog('welcome',$msisdn,$sequence_ID,$case,$request,$reply);



        return $reply;

    }



    // public function initiatepayment($msisdn, $sequence_ID,$case,$request)

    // {

    //     $atm = (float)($request);



    //     $url =  "http://pay.npontu.com/api/pay";

    //     $date = date('Y-m-d');

    //     $mesg = "Payment for radio voting services";

    //     $transaction_id = uniqid('radio');

    //     date_default_timezone_set('GMT');





    //     $timestamp = date('YmdHis');

    //     $user_id = 'your npontu pay username';

    //     $password = 'your npontu pay password';

    //     $callback = 'http://5.9.86.210/ussd/899/startimes/callback.php';



    //     $request=array(

    //         'number' =>$msisdn,

    //         'vendor' => 'mtn',

    //         'uid'=> $user_id,

    //         'pass'=>$password,

    //         'tp'=>$transaction_id,

    //         'cbk'=>$callback,

    //         'amt'=>$atm,

    //         'msg'=>$mesg,

    //         'trans_type'=>'debit'

    //     );



    //     $ch = curl_init($url);

    //     curl_setopt($ch, CURLOPT_RETURNTRANSFER, false);

    //     curl_setopt($ch, CURLOPT_POST, 1);

    //     curl_setopt($ch, CURLOPT_TIMEOUT, 3);

    //     curl_setopt($ch, CURLOPT_POSTFIELDS, $request);

    //     $output = curl_exec($ch);



    //     $reply = " Thank you for voting \r\n Dial *170#, select 7, select option 3, enter pin then select from approval list.";



    //     $this->writeLog('smartcardcheck',$msisdn,$sequence_ID,$case,$request,$output.'|'.$reply);



    //     return $reply;

    // }



}





