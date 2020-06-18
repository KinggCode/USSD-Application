<?php

Require 'Database.php';

/**

*This class contains core logic of the USSD application

*

**/



class ApplicationFunctions{
	/**

	*Method to start new USSD session
	*@param msisdn
	*@return Boolean
	*/	

	public function IdentifyUser($msisdn){
		$db = Database::getInstance(); 
		try{
			$stmt = $db->prepare("insert into sessionmanager(msisdn) values (:msisdn)");
			$stmt->bindParam(":msisdn",$msisdn);
			$stmt->execute();
			if($stmt->rowCount() > 0)

			{ 
				return TRUE;
			}

		} catch (PDOException $e) {
			#$e->getMessage();
			return FALSE;
		}		  
	}





	/**
	*Method to delete a user session 
	*@param msisdn
	*@return Boolean
	*/

	public function deleteSession($msisdn){
		$db = Database::getInstance();
		try{
			$stmt = $db->prepare("Delete FROM sessionmanager where msisdn= :msisdn");
			$stmt->bindParam(":msisdn",$msisdn);
			$stmt->execute(); 

			if($stmt->rowCount() > 0)
			{ 
				return TRUE;
			} 

			

		} catch (PDOException $e) {
			#echo $e->getMessage();
			return FALSE;
		}
	}




	public function deleteAllSession($msisdn){
		$db = Database::getInstance();
		try

		{

			$stmt = $db->prepare("UPDATE sessionmanager SET transaction_type = NULL, T1 = NULL, T2 = NULL, T3 = NULL where msisdn= :msisdn");
			$stmt->bindParam(":msisdn",$msisdn);
			$stmt->execute(); 

			if($stmt->rowCount() > 0){ 
				return TRUE;
			} 
		} catch (PDOException $e) {
			#echo $e->getMessage();
			return FALSE;
		}

	}







	/**

	*Method to update user session with the actual type of transaction or details of the transaction *currently being held

	*@param msisdn, collumn, transaction type
	*@param Boolean
	**/	

	public function UpdateTransactionType($msisdn, $col, $trans_type){

		$db = Database::getInstance();
		try
		{
			$stmt = $db->prepare("update sessionmanager set " .$col. " = :trans_type where msisdn = :msisdn");
			$params = array(":msisdn"=>$msisdn,":trans_type"=>$trans_type); 
			$stmt->execute($params);

			



			if($stmt->rowCount() > 0)
			{ 
				return true;

			}

			

		} catch (PDOException $e) {
			#echo $e->getMessage();
			return FALSE;

		}

	}



  



	/**

  	*Method to get the current state of the user 
  	*@param msisdn
  	*@return integer
  	*/

  	public function  sessionManager($msisdn){		
  		$db = Database::getInstance();
  		try
  		{
  			// $stmt = $db->prepare("SELECT (COUNT(msisdn)+ COUNT(transaction_type)+ COUNT(T1)+ COUNT(T2)+ COUNT(T3)) AS counter FROM sessionmanager WHERE msisdn = :msisdn");
  			$stmt = $db->prepare("SELECT COUNT(msisdn) + COUNT(transaction_type) AS counter FROM sessionmanager WHERE msisdn = :msisdn");
  			$stmt->bindParam(":msisdn",$msisdn);
  			$stmt->execute();
			  $res = $stmt->fetch(PDO::FETCH_ASSOC);
			  
  			if($res !== FALSE)
  			{
  				return $res['counter'];
  			}

  		} catch (PDOException $e) {
			#echo $e->getMessage();
  			return NULL;
  		}
  	}



  	




public function write_log($content){
  $log_folder = dirname(__FILE__).DIRECTORY_SEPARATOR."LOG";
  if(!is_dir($log_folder))
    {
      mkdir($log_folder);

    }
  $date= date("d m Y");
  $time = date("H:i:s");
  $myfile = $log_folder.DIRECTORY_SEPARATOR.$date.".txt";
  if($resource = (file_exists($myfile) && is_file($myfile))?fopen($myfile,"ab"): fopen($myfile, "wb")){
    fwrite($resource, $time." | ".$content.PHP_EOL);
    fclose($resource);
  }
}








  }

