<?php
session_start();
//==========================Environment Setup===============================

error_reporting(0);

//error_reporting(E_ALL);

//ini_set('display_errors', 1);

//===============================END========================================
//==========================Includes========================================

include 'radioFunctions.php';
include_once 'ApplicationFunctions.php';

//===============================END========================================




//===============VARIABLE FOR LOGING TO AID IN TROUBLESHOOTING==============
date_default_timezone_set('GMT');
$time = date('Y-m-d H:i:s');
$where = "mtn";
$ts=date('YmdHis');
$msisdn = $_GET['msisdn'];
$data = $_GET['message'];
$sequence_ID = $_GET['sequence_number'];

if(isset($_SESSION['count'])){
        $_SESSION['count']++;
}
else{
    $_SESSION['count'] = 0;
}

$sess = $_SESSION['count'];

//===============================END========================================
//===============Request preparation========================================
//===============================END========================================





//=========================Functions TO LOG=================================

/*MSIDSN FROM OPERATOR, UNIQUE SEQUENCEID FROM MNO, THE SESSION LEVEL CASE,

 * THE INPUT REQUEST FROM USER EG 899, THE RESPONSE FROM APPLICATION TO MNO

 */

//===============================END========================================

$radioFunctions = new radioFunctions();
$ussd = new ApplicationFunctions();


//This is to check which level the user is currently at
//echo $ussd->sessionManager($msisdn) ;
//$sess = intval($ussd->sessionManager($msisdn));

    switch ($sess){
        case 0: //no session was found --> Welcome Menu
        //$ussd -> IdentifyUser($msisdn);

        $reply = $radioFunctions -> welcome($msisdn,$sequence_ID,0,$request);
        $type = 1;

        writeLog($msisdn,$sequence_ID,0,$data,$reply);

        echo $reply.'|'.$msisdn.'|'.$sequence_ID.'|'.$data.'|'.$type;
        break;


        case 1 :

			//parameters it takes are MSISDN, the attribute your are updating, and the instance you are parsing in the table

            $ussd->UpdateTransactionType($msisdn, "transaction_type", 'radio');

            $reply = $radioFunctions->confirm($msisdn, $sequence_ID, 1, $request) ;

            $type = 1;

            writeLog($msisdn,$sequence_ID,1,$data,$reply);
            echo $reply ;



            break;



        case 2 :

            $reply= $radioFunctions->thankyou($msisdn, $sequence_ID,2,$data,$request);

            $type = 0;


            writeLog($msisdn,$sequence_ID,2,$data,$reply);

            echo $reply ;
            break;



        default :

            $reply = "Invalid option. Kindly dial *899*103# to continue or contact the provider for assistance";

            $type = 0;


            echo $reply;

            $ussd->deleteSession($msisdn);

            break;

    }





?>

