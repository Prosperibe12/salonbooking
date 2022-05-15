<?php
	// include constants file
	include 'constants.php';
	class SalonAppDb
	{
		private $dbconn;
		
		// database connection handler
		function __construct()
		{
			$this->dbconn = new MySqli("localhost", "root", "", "salonappdb");
			try {
				if ($this->dbconn->connect_error) {
					throw new Exception('Connection Error'.$this->dbconn->connect_error);
				}else{
					// die('Connected Succesfully');
				}
			} catch (Exception $e) {

				echo $e->getMessage();
			}
		}

		// method for cliente registration
		public function clienteReg($fullname, $email, $password, $code){
			// encrpting password
			$pass = md5($password);

			// prepare sql query statement
			$sql = "INSERT INTO cliente_user(cliente_fn, cliente_em, cliente_pwd, cliente_code) VALUES ('$fullname','$email','$pass', '$code')";

			// run sql query
			$output = $this->dbconn->query($sql);

			// checking for sql errors
			try {
				if(!empty($this->dbconn->error)){
					throw new Exception('Request Not Completed'.$this->dbconn->error);
				}
			} catch (Exception $e) {

				echo $e->getMessage();
			}

			if($this->dbconn->affected_rows > 0){

				return true;

			}else{

				return false;
			}
		}

		// function for existing email verification
		public function emailExist($email){
			// prepare sql query
			$sql = "SELECT cliente_em FROM cliente_user WHERE cliente_em='$email'";

			// execute sql query
			$output = $this->dbconn->query($sql);

			// checking for sql errors
			try {
				if(!empty($this->dbconn->error)){

					throw new Exception('System Error! Try again Later'.$this->dbconn->error);
				}
			} catch (Exception $e) {

				echo $e->getMessage();
			}

			if ($this->dbconn->affected_rows > 0) {

				return true;

			}else{

				return false;
			}
		}

		// method for link verification
		public function clinteVerification($code){

			// prepare sql statement
			$sql = "SELECT cliente_code FROM cliente_user WHERE cliente_code='$code'";

			// execute sql query
			$output = $this->dbconn->query($sql);

			// checking for sql errors
			try {
				if(!empty($this->dbconn->error)){

					throw new Exception('System Error! Try again Later'.$this->dbconn->error);
				}
			} catch (Exception $e) {

				echo $e->getMessage();
			}

			if ($this->dbconn->affected_rows > 0) {

				return true;

			}else{

				return false;
			}
		}

		// method for link status update
		public function updateStatus($code){

			// prepare sql statement
			$sql = "UPDATE cliente_user SET cliente_status='verified' WHERE cliente_code='$code'";

			// execute sql query
			$output = $this->dbconn->query($sql);

			// checking for sql errors
			try {
				if(!empty($this->dbconn->error)){

					throw new Exception('System Error! Try again Later'.$this->dbconn->error);
				}
			} catch (Exception $e) {

				echo $e->getMessage();
			}

			if ($this->dbconn->affected_rows > 0) {

				return true;

			}else{

				return false;
			}
		}

		// method for user authentication and redirecting
		public function userAuth($email, $password){
			// decrypting password
			$pass = md5($password);

			// prepare sql query
			$sql = "SELECT * FROM cliente_user WHERE cliente_em='$email' && cliente_pwd='$pass' LIMIT 1";

			// run query
			$output = $this->dbconn->query($sql);

			// checking for any errors in sql statement
			try {
				if (!empty($this->dbconn->error)) {
					throw new Exception('Could not complete Request'.$this->dbconn->error);
				}
			} catch (Exception $e) {
				echo $e->getMessage();
			}

			// fetching associative arrays from selected columns
			$result= $output->fetch_assoc();
			if ($output->num_rows == 1) {
				return $result;
			}else{
				return $result.$this->dbconn->error;
			}
		}

		// method for user password update
		public function changePass($code, $email){
			// sql statement
			$sql = "UPDATE cliente_user SET cliente_code='$code' WHERE cliente_em='$email'";

			// execute sql statement
			$output = $this->dbconn->query($sql);

			// checking for sql errors
			if(!empty($this->dbconn->error)){

				throw new Exception('System Error! Try again Later'.$this->dbconn->error);
			}

			if ($this->dbconn->affected_rows > 0) {
				return true;
			}else{
				return false;
			}
		}

		// method to verify password change code
		public function updatePass($pass, $code){

			$pass = md5($pass);

			// sql statement
			$sql = "UPDATE cliente_user SET cliente_pwd='$pass' WHERE cliente_code='$code'";

			// execute sql query
			$output = $this->dbconn->query($sql);

			// checking for sql errors
			if(!empty($this->dbconn->error)){
				throw new Exception('System Error! Try again Later'.$this->dbconn->error);
			}
			
			if ($this->dbconn->affected_rows > 0) {
				return true;
			}else{
				return false;
			}
		}

		// function for displaying home page
		public function homePage(){

			// sql query
			$sql = "SELECT * FROM service_provider";

			// run query
			$output = $this->dbconn->query($sql);

			$row = array();

			if ($this->dbconn->affected_rows > 0) {

				while ($rows = $output->fetch_assoc()) {
					$row[] = $rows;
				}
				return $row;
			}else {
				return $row;
			}
		}

		// method to get all services from category table
		public function getServices(){

			// sql query
			$sql = "SELECT * FROM categorie_table";

			// run query
			$output = $this->dbconn->query($sql);

			// check errors for sql query
			try {

				if(!empty($this->dbconn->error));

				throw new Exception("Could not complete Request".$this->dbconn->error);

			} catch (Exception $e) {

				echo $e->getMessage();
			}
			$rows = array();

			if ($output->num_rows > 0) {

				while ($row = $output->fetch_assoc()) {
					$rows[] = $row;
				}
				return $rows;
			}else {
				return $rows;
			}
		}

		// method to get individual page for each salon
		public function getSalonPage($salonid){

			// sql statement
			$sql = "SELECT salon_service_tb.*, service_provider.salon_name, service_provider.salon_email FROM salon_service_tb 
			LEFT JOIN service_provider ON service_provider.salon_id = salon_service_tb.salon_id 
			WHERE salon_service_tb.salon_id = '$salonid'";

			// run query
			$output = $this->dbconn->query($sql);

			if (!empty($this->dbconn->error)) {
				throw new Exception('Oops! Something Happened'.$this->dbconn->query);
			}

			$result = array();
			if ($this->dbconn->affected_rows > 0) {
				while ($rows = $output->fetch_assoc()) {
					$result[] = $rows;
				}

				return $result;
			}else{
				return $result;
			}
		}

		// method for women section page
		public function womenSection(){

			// sql statement
			$sql = "SELECT * FROM service_provider WHERE salon_cat = 'women'";

			// query sql statement
			$result = $this->dbconn->query($sql);

			// errors in sql
			if (!empty($this->dbconn->error)) {
				throw new Exception('Oops! Something Happened'.$this->dbconn->query);
			}

			$rows = array();
			if ($this->dbconn->affected_rows > 0) {
				while ($output = $result->fetch_assoc()) {
					$rows[] = $output;
				}
				return $rows;
			}else{
				return $rows;
			}
		}

		// method for women section page
		public function menSection(){

			// sql statement
			$sql = "SELECT * FROM service_provider WHERE salon_cat = 'men'";

			// query sql statement
			$result = $this->dbconn->query($sql);

			// errors in sql
			if (!empty($this->dbconn->error)) {
				throw new Exception('Oops! Something Happened'.$this->dbconn->query);
			}

			$rows = array();
			if ($this->dbconn->affected_rows > 0) {
				while ($output = $result->fetch_assoc()) {
					$rows[] = $output;
				}
				return $rows;
			}else{
				return $rows;
			}
		}

		// function for displaying professional page
		public function allProvider(){

			// sql query
			$sql = "SELECT * FROM service_provider";

			// run query
			$output = $this->dbconn->query($sql);

			$row = array();

			if ($this->dbconn->affected_rows > 0) {

				while ($rows = $output->fetch_assoc()) {
					$row[] = $rows;
				}
				return $row;
			}else {
				return $row;
			}
		}

		// method to search service
		public function searchService($search){

			// sql statement
			$sql = "SELECT salon_service_tb.*, service_provider.salon_name, service_provider.salon_email, categorie_table.service_type FROM salon_service_tb 
			LEFT JOIN service_provider ON service_provider.salon_id = salon_service_tb.salon_id 
			LEFT JOIN categorie_table ON categorie_table.cat_id = salon_service_tb.cat_id 
			WHERE categorie_table.service_type LIKE '%$search%'";

			// run query
			$output = $this->dbconn->query($sql);

			if (!empty($this->dbconn->error)) {
				throw new Exception('Oops! Something Happened'.$this->dbconn->query);
			}

			$result = array();
			if ($this->dbconn->affected_rows > 0) {
				while ($rows = $output->fetch_assoc()) {
					$result[] = $rows;
				}

				return $result;
			}else{
				return $result;
			}
		}

		// method to display categorie table
		public function getCategorie(){

			// sql statement
			$sql = "SELECT * FROM categorie_table ORDER BY rand() LIMIT 8";

			// run query
			$result = $this->dbconn->query($sql);
			
			// checking sql errors
			if (!empty($this->dbconn->error)) {
				throw new Exception('Oops! Something Happened'.$this->dbconn->query);
			}

			$output = array();
			if ($this->dbconn->affected_rows > 0) {
				while ($rows = $result->fetch_assoc()) {
					$output[] = $rows;
				}
				return $output;
			}else{
				return $output;
			}
		}

		// method to get data in cart session
		// not used
		public function getCartData($array){

			// sql statement
			$sql = "SELECT salon_serv_no, salon_id, service_price, service_img, service_code FROM products WHERE id IN ($array)";

			// run query
			$output = $this->dbconn->query($sql);

			$result = array();
			if ($this->dbconn->affected_rows > 0) {
				while ($rows = $output->fetch_assoc()) {
					$result[] = $rows;
				}
				return $result;
			}else{
				return $result;
			}
		}

		// method to submit cart data
		public function insertCartData($ca_id, $c_id, $s_id, $p_id, $price){
			// sql statement
			$sql = "INSERT INTO booking_reserve(cart_id, cliente_id, salon_id, product_id, product_price) VALUES ('$ca_id','$c_id','$s_id','$p_id','$price')";

			// execute sql query
			$output = $this->dbconn->query($sql);

			if ($this->dbconn->affected_rows > 1) {
				return true;
			}else{
				return false;
			}
		}

		public function initializePaystack($email, $amount){

			$url = "https://api.paystack.co/transaction/initialize";

			$reference = "SLN".time().rand(); 
			$callbackurl = "http://localhost/salonbk/paymentcallback.php";

			$fields = [
		    'email' => $email,
		    'amount' => $amount * 100 * 495,
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

			// validate or check if there is anything inside it
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
		public function insertTransDetails($cart_id, $cliente_id, $salon_id, $total_amt, $trans_ref, $book_date, $book_time){

			// variables
			$status = "pending";

			// prepare sql query
			$sql = "INSERT INTO book_rev_payment(cart_id, cliente_id, salon_id, total_amt, trans_ref, trans_stat, book_date, book_time) VALUES ('$cart_id','$cliente_id','$salon_id','$total_amt','$trans_ref','$status','$book_date','$book_time')";

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
		public function updateTrans($reference){

			// prepare query
			$sql = "UPDATE book_rev_payment SET trans_stat='completed' WHERE trans_ref='$reference'";

			// run query
			$output = $this->dbconn->query($sql);

			if($this->dbconn->affected_rows == 1){

				return true;
			}else{
				return false;
			}
		}

		// method for userbooking
		public function userBooking($cliente_id, $date){

			// prepare sql query
			$sql = "SELECT book_rev_payment.*,service_provider.salon_name,service_provider.salon_email FROM book_rev_payment 
			LEFT JOIN service_provider ON service_provider.salon_id = book_rev_payment.salon_id 
			WHERE book_rev_payment.cliente_id = '$cliente_id' AND book_rev_payment.created_at='$date'";
	
			// run query
			$output = $this->dbconn->query($sql);

			if (!empty($this->dbconn->error)) {
					throw new Exception('System Error');
			}

			$result = array();

			if ($this->dbconn->affected_rows > 0) {

				// fetch associative arrays with $salonid
				while ($row = $output->fetch_assoc()) {
					$result[] = $row;
				}

				return $result;
			}else{
				return $result;
			}

		}

		// method for user to update phone number and address
		public function userUpdate($address, $tel, $id){
			// sql query
			$sql = "UPDATE cliente_user SET cliente_ad='$address', cliente_tel='$tel' WHERE cliente_id='$id'";

			// execute sql query
			$output = $this->dbconn->query($sql);

			if ($this->dbconn->affected_rows== 1) {

				return true;
			}else{
				return false;
			}
		}

		// method for user to update service status
		public function serviceStat($id){
			// sql statement
			$sql = "UPDATE book_rev_payment SET service_status = 'completed' WHERE rev_pay_id = '$id'";

			// run query
			$result = $this->dbconn->query($sql);

			// checking for errors
			if (!empty($this->dbconn->error)) {
				throw new Exception('System Error');
			}

			$output = array();

			if ($this->dbconn->affected_rows == 1) {
				$output['success'] = "Successfully Completed.";
			}elseif ($this->dbconn->affected_rows==0) {
				$output['success'] = "No Changes Made";
			}else{
				$output['error']="Ooops! Something Happened".$this->dbconn->error;
			}
			return $output;
		}

		//function to display service details booked by user
		public function serviceDetails($c_id, $date){

			// prepare sql query
			$sql = "SELECT booking_reserve.*,salon_service_tb.cat_id FROM booking_reserve 
			LEFT JOIN salon_service_tb ON salon_service_tb.salon_serv_no = booking_reserve.product_id 
			WHERE booking_reserve.cliente_id='$c_id' AND booking_reserve.created_at='$date'";

			// run query
			$output = $this->dbconn->query($sql);

			if (!empty($this->dbconn->error)) {
					throw new Exception('System Error');
			}

			$result = array();

			if ($this->dbconn->affected_rows > 0) {

				// fetch associative arrays with $salonid
				while ($row = $output->fetch_assoc()) {
					$result[] = $row;
				}

				return $result;
			}else{
				return $result;
			}

		}

		// method to count user provider active booking
		public function activeBook($c_id, $date){

			// prepare sql query
			$sql = "SELECT COUNT(booking_status) FROM book_rev_payment WHERE cliente_id ='$c_id' AND created_at='$date'";

			// run query
			$result = $this->dbconn->query($sql);

			// fetching associative array
			$output = array();

			if ($this->dbconn->affected_rows > 0) {

				while ($row = $result->fetch_assoc()) {
					$output[] = $row;
				}

				return $output;
			}else{
				return $output;
			}
		}

		// method to count and display service provider pending booking
		public function pendingBook($c_id, $date){

			// prepare sql query
			$sql = "SELECT COUNT(booking_status) FROM book_rev_payment WHERE booking_status='pending' AND cliente_id ='$c_id' AND created_at='$date'";

			// run query
			$result = $this->dbconn->query($sql);

			// fetching associative array
			$output = array();

			if ($this->dbconn->affected_rows > 0) {

				while ($row = $result->fetch_assoc()) {
					$output[] = $row;
				}

				return $output;
			}else{
				return $output;
			}
		}

		// method to count and display completed service
		public function deliveredBook($c_id, $date){

			// prepare sql query
			$sql = "SELECT COUNT(booking_status) FROM book_rev_payment WHERE service_status='completed' AND cliente_id ='$c_id' AND created_at='$date'";

			// run query
			$result = $this->dbconn->query($sql);

			// fetching associative array
			$output = array();

			if ($this->dbconn->affected_rows > 0) {

				while ($row = $result->fetch_assoc()) {
					$output[] = $row;
				}

				return $output;
			}else{
				return $output;
			}
		}

		// method for contact form
		public function contactForm($name, $mail, $subject, $text){
			//sql query
			$sql = "INSERT INTO contacts(name, email, subject, message) VALUES ('$name','$mail','$subject','$text')";

			// execute query
			$result = $this->dbconn->query($sql);

			if (!empty($this->dbconn->error)) {
				throw new Exception("Error Processing Request".$this->dbconn->erroor);			
			}

			if ($this->dbconn->affected_rows > 0) {
				return true;
			}else{
				return false;
			}
		}

		// method for receipt printing for user
		public function userReceipt($cliente_id, $date){

			// prepare sql query
			$sql = "SELECT booking_reserve.*,salon_service_tb.cat_id,salon_service_tb.service_desc FROM booking_reserve
			LEFT JOIN salon_service_tb ON salon_service_tb.salon_serv_no =booking_reserve.product_id
			WHERE booking_reserve.cliente_id = '$cliente_id' AND booking_reserve.created_at='$date'";
	
			// run query
			$output = $this->dbconn->query($sql);

			if (!empty($this->dbconn->error)) {
				throw new Exception('System Error'.$this->dbconn->error);
			}

			$result = array();

			if ($this->dbconn->affected_rows > 0) {

				// fetch associative arrays with $salonid
				while ($row = $output->fetch_assoc()) {
					$result[] = $row;
				}

				return $result;
			}else{
				return $result;
			}

		}

		// method for user receipt second
		public function userReceipts($id, $date){
			// sql statement
			$sql = "SELECT booking_status, service_status, trans_ref, trans_stat FROM book_rev_payment
			WHERE cliente_id='$id' AND created_at='$date'";

			$output = $this->dbconn->query($sql);

			if (!empty($this->dbconn->error)) {
				throw new Exception('Opps! Something happened'.$this->dbconn->error);
			}

			$result = array();

			if ($this->dbconn->affected_rows > 0) {

				// fetch associative arrays with $salonid
				while ($row = $output->fetch_assoc()) {
					$result[] = $row;
				}

				return $result;
			}else{
				return $result;
			}
		}

		// functions for service provider
		// method for service provider registration
		public function ServiceProviderReg($salonname, $email, $password, $code){
			// encrpting password
			$pass = md5($password);

			// prepare sql query statement
			$sql = "INSERT INTO service_provider(salon_name, salon_email, salon_pwd, salon_code) VALUES ('$salonname', '$email', '$pass', '$code')";

			// run sql query
			$output = $this->dbconn->query($sql);

			// checking for sql errors
			try {
				if(!empty($this->dbconn->error)){
					throw new Exception('Request Not Completed'.$this->dbconn->error);
				}
			} catch (Exception $e) {

				echo $e->getMessage();
			}

			if($this->dbconn->affected_rows > 0){

				return true;

			}else{

				return false;
			}
		}

		// function for existing email verification for salon
		public function providerEmailExist($email){
			// prepare sql query
			$sql = "SELECT salon_email FROM service_provider WHERE salon_email='$email'";

			// execute sql query
			$output = $this->dbconn->query($sql);

			// checking for sql errors
			try {
				if(!empty($this->dbconn->error)){

					throw new Exception('System Error! Try again Later'.$this->dbconn->error);
				}
			} catch (Exception $e) {

				echo $e->getMessage();
			}

			if ($this->dbconn->affected_rows > 0) {

				return true;

			}else{

				return false;
			}
		}

		// method for salon link verification
		public function salonVerification($code){

			// prepare sql statement
			$sql = "SELECT 	salon_code FROM service_provider WHERE 	salon_code='$code'";

			// execute sql query
			$output = $this->dbconn->query($sql);

			// checking for sql errors
			if(!empty($this->dbconn->error)){

				throw new Exception('System Error! Try again Later'.$this->dbconn->error);
			}

			if ($this->dbconn->affected_rows > 0) {
				return true;
			}else{
				return false;
			}
		}

		// method for salon link verification
		public function salonUpdateStatus($code){

			// prepare sql statement
			$sql = "UPDATE service_provider SET salon_stat='verified' WHERE salon_code='$code'";

			// execute sql query
			$output = $this->dbconn->query($sql);

			// checking for sql errors
			try {
				if(!empty($this->dbconn->error)){

					throw new Exception('System Error! Try again Later'.$this->dbconn->error);
				}
			} catch (Exception $e) {

				echo $e->getMessage();
			}

			if ($this->dbconn->affected_rows > 0) {

				return true;

			}else{

				return false;
			}
		}

		// method for salon authentication and redirecting
		public function salonAuth($email, $password){
			// decrypting password
			$pass = md5($password);

			// prepare sql query
			$sql = "SELECT * FROM service_provider WHERE salon_email='$email' && salon_pwd='$pass' LIMIT 1";

			// run query
			$output = $this->dbconn->query($sql);

			// checking for any errors in sql statement
			try {
				if (!empty($this->dbconn->error)) {
					throw new Exception('Could not complete Request'.$this->dbconn->error);
				}
			} catch (Exception $e) {
				echo $e->getMessage();
			}

			// fetching associative arrays from selected columns
			$result= $output->fetch_assoc();
			if ($output->num_rows > 0) {
				return $result;
			}else{
				return $result.$this->dbconn->error;
			}
		}

		// method for registered salon to update salon details 
		public function salonProfileUpdate($salontel, $salonadd, $saloncat, $salonid){

			// set upload variables
			$filename = $_FILES['mypix']['name'];
			$file_type = $_FILES['mypix']['type'];
			$file_tmp_name = $_FILES['mypix']['tmp_name'];
			$file_error = $_FILES['mypix']['error'];
			$file_size = $_FILES['mypix']['size'];

			// validating for error
			if (empty($filename)) {
				throw new Exception("Please upload a file");	
			}

			// validating file size
			if ($file_size > 2097152) {
				throw new Exception("Image should be less than 2MB");
			}

			// checking for file extension
			$extensions = array("png", "jpeg", "jpg", "svg", "gif");
			$newfiles = explode(".", $filename);
			$newfile = end($newfiles);

			// checking if exploded format is in array
			if (!in_array(strtolower($newfile), $extensions)) {

				$error = $newfile."File type not supported";

				return $error;
			}

			// uploading the file
			$folder = "uploaded_images/";
			$newfilename = time().rand().".".$newfile;
			$destination = $folder.$newfilename;

			if (move_uploaded_file($file_tmp_name, $destination)) {
				
				// prepare query
				$sql = "UPDATE service_provider SET salon_tel='$salontel',salon_adrs='$salonadd',salon_cat='$saloncat',salon_img='$newfilename' WHERE salon_id='$salonid'";

				// run query
				$output = $this->dbconn->query($sql);

				if ($this->dbconn->affected_rows == 1) {

					return true; 

				}else{

					return "Error Uploading File".$this->dbconn->error;
				}
			}
			
		}

		//method to change password
		public function pwdChange($code, $email){
			// sql statement
			$sql = "UPDATE service_provider SET salon_code='$code' WHERE salon_email='$email'";

			// execute sql statement
			$output = $this->dbconn->query($sql);

			// checking for sql errors
			if(!empty($this->dbconn->error)){

				throw new Exception('System Error! Try again Later'.$this->dbconn->error);
			}

			if ($this->dbconn->affected_rows > 0) {
				return true;
			}else{
				return false;
			}
		}

		// method to verify password change code
		public function updatePwd($pass, $code){

			$pass = md5($pass);

			// sql statement
			$sql = "UPDATE service_provider SET salon_pwd='$pass' WHERE salon_code='$code'";

			// execute sql query
			$output = $this->dbconn->query($sql);

			// checking for sql errors
			if(!empty($this->dbconn->error)){
				throw new Exception('System Error! Try again Later'.$this->dbconn->error);
			}
			
			if ($this->dbconn->affected_rows > 0) {
				return true;
			}else{
				return false;
			}
		}

		// function for service provider to upload service
		public function uploadService($salon_id, $cat_id, $service_desc, $price){

			// set upload variables
			$filename = $_FILES['mypix']['name'];
			$file_type = $_FILES['mypix']['type'];
			$file_tmp_name = $_FILES['mypix']['tmp_name'];
			$file_error = $_FILES['mypix']['error'];
			$file_size = $_FILES['mypix']['size'];

			// validating for error
			if (empty($filename)) {
				throw new Exception("Please upload a file");	
			}

			// validating file size
			if ($file_size > 2097152) {
				throw new Exception("Image should be less than 2MB");
			}

			// checking for file extension
			$extensions = array("png", "jpeg", "jpg", "svg", "gif");
			$newfiles = explode(".", $filename);
			$newfile = end($newfiles);

			// checking if exploded format is in array
			if (!in_array(strtolower($newfile), $extensions)) {

				$error = $newfile."File type not supported";

				return $error;
			}

			// uploading the file
			$folder = "uploaded_images/";
			$newfilename = time().rand().".".$newfile;
			$destination = $folder.$newfilename;

			if (move_uploaded_file($file_tmp_name, $destination)) {

				$code = rand().time();
				// sql statement to insert
				$sql = "INSERT INTO salon_service_tb(salon_id, cat_id, service_desc, service_price, service_img, service_code) VALUES ('$salon_id','$cat_id','$service_desc','$price','$newfilename','$code')";

				// run query
				$result = $this->dbconn->query($sql);

				$output = array();
				if ($this->dbconn->affected_rows == 1) {

					$output['success'] = "Service Added Successfully.";

				}elseif ($this->dbconn->affected_rows == 0) {

					$output['success'] = "No Changes Made.";

				}else{

					$output['error'] = "Oops! Something Happened.".$this->dbconn->error;
				}

				return $output;
			}


		}

		// function for service provider to upload service
		public function uploadProduct($p_name, $price, $prd_desc, $salon_id){

			// set upload variables
			$filename = $_FILES['mypix']['name'];
			$file_type = $_FILES['mypix']['type'];
			$file_tmp_name = $_FILES['mypix']['tmp_name'];
			$file_error = $_FILES['mypix']['error'];
			$file_size = $_FILES['mypix']['size'];

			// validating for error
			if (empty($filename)) {
				throw new Exception("Please upload a file");	
			}

			// validating file size
			if ($file_size > 2097152) {
				throw new Exception("Image should be less than 2MB");
			}

			// checking for file extension
			$extensions = array("png", "jpeg", "jpg", "svg", "gif");
			$newfiles = explode(".", $filename);
			$newfile = end($newfiles);

			// checking if exploded format is in array
			if (!in_array(strtolower($newfile), $extensions)) {

				$error = $newfile."File type not supported";

				return $error;
			}

			// uploading the file
			$folder = "uploaded_images/";
			$newfilename = time().rand().".".$newfile;
			$destination = $folder.$newfilename;

			if (move_uploaded_file($file_tmp_name, $destination)) {

				$code = rand().time();
				// sql statement to insert
				$sql = "INSERT INTO store_products(product_code, product_name, product_amt, product_desc, product_img, salon_id) VALUES ('$code','$p_name','$price','$prd_desc','$newfilename','$salon_id)";

				// run query
				$result = $this->dbconn->query($sql);

				$output = array();
				if ($this->dbconn->affected_rows == 1) {

					$output['success'] = "Service Added Successfully.";

				}elseif ($this->dbconn->affected_rows == 0) {

					$output['success'] = "No Changes Made.";

				}else{

					$output['error'] = "Oops! Something Happened.".$this->dbconn->error;
				}

				return $output;
			}


		} 

		// method to fetch service provider booking
		public function salonBooking($salon_id, $date){

			// prepare sql query
			$sql = "SELECT book_rev_payment.*,cliente_user.cliente_em FROM book_rev_payment
			LEFT JOIN cliente_user ON cliente_user.cliente_id = book_rev_payment.cliente_id
			WHERE book_rev_payment.salon_id = '$salon_id' AND book_rev_payment.created_at='$date'";
	
			// run query
			$output = $this->dbconn->query($sql);

			if (!empty($this->dbconn->error)) {
					throw new Exception('System Error');
			}

			$result = array();

			if ($this->dbconn->affected_rows > 0) {

				// fetch associative arrays with $salonid
				while ($row = $output->fetch_assoc()) {
					$result[] = $row;
				}

				return $result;
			}else{
				return $result;
			}

		}

		// method to display cart details
		public function cartDetails($salon_id, $date){

			// prepare sql query
			$sql = "SELECT booking_reserve.*,salon_service_tb.cat_id FROM booking_reserve 
			LEFT JOIN salon_service_tb ON salon_service_tb.salon_serv_no = booking_reserve.product_id 
			WHERE booking_reserve.salon_id = '$salon_id' AND booking_reserve.created_at='$date'";

			// run query
			$output = $this->dbconn->query($sql);

			if (!empty($this->dbconn->error)) {
					throw new Exception('System Error');
			}

			$result = array();

			if ($this->dbconn->affected_rows > 0) {

				// fetch associative arrays with $salonid
				while ($row = $output->fetch_assoc()) {
					$result[] = $row;
				}

				return $result;
			}else{
				return $result;
			}

		}

		// method for service provider to accept booking
		public function acceptBooking($id){
			// sql statement
			$sql = "UPDATE book_rev_payment SET booking_status = 'confirmed' WHERE rev_pay_id = '$id'";

			// run query
			$result = $this->dbconn->query($sql);

			// checking for errors
			if (!empty($this->dbconn->error)) {
				throw new Exception('System Error');
			}

			$output = array();

			if ($this->dbconn->affected_rows == 1) {
				$output['success'] = "Successfully Accepted";
			}elseif ($this->dbconn->affected_rows==0) {
				$output['success'] = "No Changes Made";
			}else{
				$output['error']="Ooops! Something Happened".$this->dbconn->error;
			}
			return $output;
		}

		// method to display salon offered services
		public function salonService($salon_id){
			// sql statement
			$sql = "SELECT salon_service_tb.salon_serv_no,salon_service_tb.salon_id,salon_service_tb.cat_id,salon_service_tb.service_price,salon_service_tb.service_desc,salon_service_tb.service_status 
			FROM salon_service_tb WHERE salon_service_tb.salon_id = '$salon_id'";

			// run query
			$result = $this->dbconn->query($sql);

			// checking sql errors
			if (!empty($this->dbconn->error)) {
				throw new Exception("Error Processing Request", 1);				
			}

			$output = array();
			if ($this->dbconn->affected_rows > 0) {
				while ($row = $result->fetch_assoc()) {
					$output[] = $row;
				}
				return $output;
			}else{
				return $output;
			}
		}

		// get services from service yable
		public function getService($salon_id){
			// sql statement
			$sql = "SELECT salon_service_tb.salon_serv_no,categorie_table.cat_id,categorie_table.service_type FROM salon_service_tb
			LEFT JOIN categorie_table ON categorie_table.cat_id = salon_service_tb.cat_id
			WHERE salon_service_tb.salon_id = '$salon_id'";

			// execute statement
			$output = $this->dbconn->query($sql);

			// sql errors
			if (!empty($this->dbconn->error)) {
				throw new Exception("Request Could Not be Completed".$this->dbconn->error);
			}

			// fetch assoc array
			$result = array();

			if ($this->dbconn->affected_rows > 0) {

				while ($row = $output->fetch_assoc()) {
					$result[] = $row;
				}
				return $result;
			}else {
				return $result;
			}
		}

		// method to update salon service
		public function updateService($price, $desc, $serv_no, $id){

			// sql statement
			$sql = "UPDATE salon_service_tb SET service_price='$price', service_desc='$desc' WHERE salon_serv_no='$serv_no' AND salon_id='$id'";

			// execute state
			$result = $this->dbconn->query($sql);

			// sql errors
			if (!empty($this->dbconn->error)) {
				throw new Exception("Something Unexpected Happened");
			}

			$output = array();
			if ($this->dbconn->affected_rows == 1) {
				$output['success'] = "Successfully updated";
			}elseif ($this->dbconn->affected_rows==0) {
				$output['success'] = "No Changes Made";
			}else{
				$output['error']="Ooops! Something Happened".$this->dbconn->error;
			}
			return $output;
		}

		// method to count completed transaction
		public function userCompletedTrans($userid){

			// prepare sql query
			$sql = "SELECT COUNT(status) FROM user_trans WHERE status='completed' AND user_id='$userid'";

			// run query
			$result = $this->dbconn->query($sql);

			// fetching associative array
			$output = array();
			if ($this->dbconn->affected_rows > 0) {
				while ($row = $result->fetch_assoc()) {
					$output[] = $row;
				}
				return $output;
			}else{
				return $output;
			}
		}

		// method to count service provider active booking
		public function activeBooking($salonid, $date){

			// prepare sql query
			$sql = "SELECT COUNT(booking_status) FROM book_rev_payment WHERE salon_id ='$salonid' AND created_at='$date'";

			// run query
			$result = $this->dbconn->query($sql);

			// fetching associative array
			$output = array();

			if ($this->dbconn->affected_rows > 0) {

				while ($row = $result->fetch_assoc()) {
					$output[] = $row;
				}

				return $output;
			}else{
				return $output;
			}
		}

		// method to count and display completed service
		public function deliveredBooking($salonid, $date){

			// prepare sql query
			$sql = "SELECT COUNT(booking_status) FROM book_rev_payment WHERE service_status='completed' AND salon_id ='$salonid' AND created_at='$date'";

			// run query
			$result = $this->dbconn->query($sql);

			// fetching associative array
			$output = array();

			if ($this->dbconn->affected_rows > 0) {

				while ($row = $result->fetch_assoc()) {
					$output[] = $row;
				}

				return $output;
			}else{
				return $output;
			}
		}

		// method to count and display service provider pending booking
		public function pendingBooking($salonid, $date){

			// prepare sql query
			$sql = "SELECT COUNT(booking_status) FROM book_rev_payment WHERE booking_status='pending' AND salon_id ='$salonid' AND created_at='$date'";

			// run query
			$result = $this->dbconn->query($sql);

			// fetching associative array
			$output = array();

			if ($this->dbconn->affected_rows > 0) {

				while ($row = $result->fetch_assoc()) {
					$output[] = $row;
				}

				return $output;
			}else{
				return $output;
			}
		}

		// method for to calculate and print total revenue
		public function totalRev($salonid){

			// prepare sql query
			$sql = "SELECT SUM(total_amt) FROM book_rev_payment WHERE service_status='pending' AND salon_id ='$salonid'";

			// run query
			$result = $this->dbconn->query($sql);

			// fetching associative array
			$output = array();

			if ($this->dbconn->affected_rows > 0) {

				while ($row = $result->fetch_assoc()) {
					$output[] = $row;
				}

				return $output;
			}else{
				return $output;
			}
		}
		
	}
?>