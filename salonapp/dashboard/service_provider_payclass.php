<?php
    // payment class file for service providers

    // include constants file
    include '../models/constants.php';

    // declare class
    class Payment
    {
        public $dbconn;

        // database connection initialisation
        function __construct()
        {
            $this->dbconn = new MySqli(DB_SERVERNAME, DB_USERNAME, DB_PASSWORD, DB_NAME);

            try {
                if($this->dbconn->connect_error){
                    throw new Exception("Connection error".$this->dbconn->connect_error);
                }else{
                    // die("Connected Successfuly");
                }
            } catch (Exception $e) {
                echo $e->getMessage();
            }
        }

        // method for service provide to pay for subscription (using paystack)
		public function initialisePaystack($email, $amount){

			// paystack api endpoint
			$url = "https://api.paystack.co/transaction/initialize";

			$reference = "SLN".time().rand(); 
			$callbackurl = "http://localhost/salonbk/dashboard/paystackcallback.php";

			$fields = [
		    'email' => $email,
		    'amount' => $amount * 100,
		    'reference' => $reference,
		    'callback_url' => $callbackurl
		  	];

		  	$fields_string = http_build_query($fields);
		  	$secretkey = "sk_test_e5247a3d48a8ceaa0940d847fc47c3458aec92ca";

		  	// step1 open connection step1
		  	$ch = curl_init();

		  	// step2 set the urls, number of POST vars, POST data
		  	curl_setopt($ch,CURLOPT_URL, $url);
			curl_setopt($ch,CURLOPT_POST, true);
			curl_setopt($ch,CURLOPT_POSTFIELDS, $fields_string);
			curl_setopt($ch, CURLOPT_HTTPHEADER, array(
			    "Authorization: Bearer $secretkey",
			    "Cache-Control: no-cache",
			  ));

			curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false); //we used this to ignore SSL certificate since our site is on local host. But for live projects, enable "true"
			curl_setopt($ch,CURLOPT_RETURNTRANSFER, true);

			// step3 execute connection
			$response = curl_exec($ch);

			// validate or check if there is any error
			if (curl_error($ch)) {
			 	echo curl_error($ch);
			}


			// step4 close connection
			curl_close($ch);

			// step 5: convert json to object
			 $result = json_decode($response);

			return $result;
		}

		// inserting paystack transaction details into database
		public function insertTransDetails($salon_id, $amount, $reference){

			// variables
			$paymentmode = "paystack";
			$dueyear = "2022";
			$status = "pending";
			$datepaid = date('Y-m-d h:i:s');

			// prepare sql query
			$sql = "INSERT INTO service_provider_payment(salon_id, amount, payment_year, datepaid, payment_mode, transref, status) VALUES ('$salon_id','$amount','$dueyear','$datepaid','$paymentmode','$reference','$status')";

			// run sql query
			$output = $this->dbconn->query($sql);

			// sql errors
			try{

				if(!empty($this->dbconn->error)){

					throw new Exception($this->dbconn->error);
				}
			} catch (Exception $e){

				echo $e->getMessage();
			}

			if($this->dbconn->affected_rows == 1){

				return true;

			}else{

				return false;
			}
		}

		//verifying paystack transaction if successful
		public function verifyTrans($reference){

			$url = "https://api.paystack.co/transaction/verify/".$reference;
			$secretkey = "sk_test_e5247a3d48a8ceaa0940d847fc47c3458aec92ca";

			// step 1: open connection
			$ch = curl_init();

			// step 2: set curl options
			curl_setopt($ch,CURLOPT_URL, $url);
			curl_setopt($ch,CURLOPT_CUSTOMREQUEST, "GET");
			curl_setopt($ch, CURLOPT_HTTPHEADER, array(
			"Authorization: Bearer $secretkey",
			"Cache-Control: no-cache",
			));	

			curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false); //we used this to ignore SSL certificate since our site is on local host. But for live projects, enable "true"
			curl_setopt($ch,CURLOPT_RETURNTRANSFER, true);

			// step 3 
			$response = curl_exec($ch);

			// validate or check if there is any error
			if (curl_error($ch)) {
				echo curl_error($ch);
			}

			// step4 
			curl_close($ch);

			// step 5: convert json to object
			$result = json_decode($response);

			return $result;
		}

		//updating paystack transfer if successful
		public function upDateTrans($reference){

			// prepare query
			$sql = "UPDATE service_provider_payment SET status='completed' WHERE transref='$reference'";

			// run query
			$output = $this->dbconn->query($sql);

			if($this->dbconn->affected_rows == 1){

				return true;
			}else{
				return false;
			}
		} 

    }
?>