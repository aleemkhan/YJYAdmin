<?php
include('connect_db.php');
//include('function.php');
header('content-type: application/json; charset=utf-8');
header("access-control-allow-origin: *");

$request = $_REQUEST['request'];

$response["STATUS"] = "ERROR";
$response["MSG"] = "message";
$response["DATA"] = []; 

switch ($request) {
	case 'SIGNUP':
		$query = "SELECT * FROM user WHERE email = '".$_REQUEST['email']."'";
		$result = mysql_query($query);
		$num = mysql_num_rows($result);
		if($num>0){
			$response["STATUS"] = "ERROR";
			$response["MSG"] = "Account already exists. Login with your account details.";
			$response["DATA"] = [];
		}else{
			$query = "INSERT INTO user VALUES ('', '".$_REQUEST['email']."', '".$_REQUEST['password']."', '', '', '', '', '', '', ".$_REQUEST['type'].", 2)";
			$result = mysql_query($query);
			$response["STATUS"] = "OK";
			$response["MSG"] = "Account Created.";
			$response["DATA"] = [];
		}
		echo json_encode($response);
		break;
	
	case 'LOGIN':
			$query = "SELECT * FROM user WHERE email = '".$_REQUEST['email']."'";
			$result = mysql_query($query);
			$num = mysql_num_rows($result);
			if($num>0){
				$data = "";
				while($row = mysql_fetch_array($result)){
					$data[] = $row;
				}
				$response["STATUS"] = "OK";
				$response["MSG"] = "User Loged in.";
				$response["DATA"] = $data;
			}else{
				$query = "INSERT INTO user VALUES ('', '".$_REQUEST['email']."', '".$_REQUEST['password']."', '', '', '', '', '', '', ".$_REQUEST['type'].", 2)";
				$result = mysql_query($query);
				$response["STATUS"] = "OK";
				$response["MSG"] = "Account Created.";
				$response["DATA"] = [];
			}
			echo json_encode($response);
		break;

		case 'ADMIN_LOGIN':
			$query = "SELECT * FROM user WHERE email = '".$_REQUEST['email']."' AND password = '".$_REQUEST['password']."' AND type=3";
			$result = mysql_query($query);
			$num = mysql_num_rows($result);
			if($num>0){
				$data = "";
				while($row = mysql_fetch_array($result)){
					$data[] = $row;
				}
				session_start();
				$_SESSION['login']= true;
				$response["STATUS"] = "OK";
				$response["MSG"] = "User Loged in.";
				$response["DATA"] = $data;
			}else{
				$response["STATUS"] = "ERROR";
				$response["MSG"] = "Invalid credentials.";
				$response["DATA"] = [];
			}
			echo json_encode($response);
		break;

	case 'ADMIN_ADD_USER':
		$query = "SELECT * FROM user WHERE email = '".$_REQUEST['email']."'";
		$result = mysql_query($query);
		$num = mysql_num_rows($result);
		if($num==0){
			$query = "INSERT INTO user VALUES ('', '".$_REQUEST['email']."', '".$_REQUEST['password']."', '".$_REQUEST['fname']."', '".$_REQUEST['lname']."', '".$_REQUEST['address']."', '".$_REQUEST['apartment']."', '".$_REQUEST['phone']."', '".$_REQUEST['code']."', ".$_REQUEST['type'].", 2)";
			$result = mysql_query($query);
			$response["STATUS"] = "OK";
			$response["MSG"] = "Account Created for ".$_REQUEST['fname']." ".$_REQUEST['lname'];
			$response["DATA"] = [];
		}else{
			$response["STATUS"] = "ERROR";
			$response["MSG"] = "This account ( ".$_REQUEST['email']." ) does not exist.";
			$response["DATA"] = [];
		}
		echo json_encode($response);
		break;	

	case 'SAVE_INFO':
		$query = "SELECT * FROM user WHERE email = '".$_REQUEST['email']."'";
		$result = mysql_query($query);
		$num = mysql_num_rows($result);
		if($num==0){
			$response["STATUS"] = "ERROR";
			$response["MSG"] = "This account ( ".$_REQUEST['email']." ) does not exist.";
			$response["DATA"] = [];
		}else{
			$query = "UPDATE user SET fname = '".$_REQUEST['fname']."', lname = '".$_REQUEST['lname']."', address = '".$_REQUEST['address']."', apartment='".$_REQUEST['apartment']."', phone = '".$_REQUEST['phone']."', code='".$_REQUEST['code']."' WHERE email='".$_REQUEST['email']."'";
			$result = mysql_query($query);
			$response["STATUS"] = "OK";
			$response["MSG"] = "Data updated successfully.";
			$response["DATA"] = [];
		}
		echo json_encode($response);
		break;
		
	case 'GET_INFO':
		$query = "SELECT * FROM user WHERE email = '".$_REQUEST['email']."'";
		$result = mysql_query($query);
		$data = "";
		while($row = mysql_fetch_array($result)){
			$data[] = $row;
		}
		$response["STATUS"] = "OK";
		$response["MSG"] = "User Loged in.";
		$response["DATA"] = $data;
		echo json_encode($response);
		break;

	case 'SAVE_LOCATION':
		$query = "SELECT * FROM location WHERE email = '".$_REQUEST['email']."'";
		$result = mysql_query($query);
		$num = mysql_num_rows($result);
		if($num==0){
			$query = "INSERT INTO location VALUES ('', '".$_REQUEST['email']."', '".$_REQUEST['lat']."', ".$_REQUEST['lng'].")";
			$result = mysql_query($query);
			$response["STATUS"] = "OK";
			$response["MSG"] = "Location Added.";
			$response["DATA"] = [];
		}else{
			$query = "UPDATE location SET lat = '".$_REQUEST['lat']."',  lng = '".$_REQUEST['lng']."' WHERE email = '".$_REQUEST['email']."'";
			$result = mysql_query($query);
			$response["STATUS"] = "OK";
			$response["MSG"] = "Location Updated.";
			$response["DATA"] = [];
		}
		echo json_encode($response);
		break;

	case 'GET_LOCATION':
		$query = "SELECT * FROM location WHERE email = '".$_REQUEST['email']."'";
		$result = mysql_query($query);
		$data = "";
		while($row = mysql_fetch_array($result)){
			$data[] = $row;
		}
		$response["STATUS"] = "OK";
		$response["MSG"] = "Location received.";
		$response["DATA"] = $data;
		echo json_encode($response);
		break;

	case 'POST_JOB':
		$query = "INSERT INTO jobs VALUES('', '".$_REQUEST['email']."', '', '".$_REQUEST['job_request']."', '".$_REQUEST['lat']."', '".$_REQUEST['lng']."', '".$_REQUEST['details']."', '".$_REQUEST['description']."', '".$_REQUEST['date']."', '".$_REQUEST['time']."', ".$_REQUEST['hours'].", ".$_REQUEST['frequency'].", ".$_REQUEST['price'].", '".$_REQUEST['city']."', '".$_REQUEST['country']."', 0, 0, NOW())";
		$result = mysql_query($query);
		if($result){
			$response["STATUS"] = "OK";
			$response["MSG"] = "Proceed to payment to get this service on time." ;
			$response["DATA"] = mysql_insert_id();
		}else{
			$response["STATUS"] = "Error";
			$response["MSG"] = "Something went wrong contact support." ;
			$response["DATA"] = mysql_error();

		}
		echo json_encode($response);
		break;	

	case 'FIND_JOB':
		$query = "SELECT * FROM jobs WHERE status = 0 ORDER BY id DESC LIMIT 10 OFFSET ".$_REQUEST['offset'];
		$result = mysql_query($query);
		$data = "";
		while($row = mysql_fetch_array($result)){
			$data[] = $row;
		}
		$response["STATUS"] = "OK";
		$response["MSG"] = "Jobs data received.";
		$response["DATA"] = $data;
		echo json_encode($response);
		break;

	case 'MY_JOB':
		$query = "SELECT * FROM jobs WHERE status != 4 AND status != 6 AND takenby = '".$_REQUEST['vendor']."' ORDER BY id DESC ";
		$result = mysql_query($query);
		$data = "";
		while($row = mysql_fetch_array($result)){
			$data[] = $row;
		}
		$response["STATUS"] = "OK";
		$response["MSG"] = "Jobs data received.";
		$response["DATA"] = $data;
		echo json_encode($response);
		break;

	case 'POSTED_JOB':
		$query = "SELECT * FROM jobs WHERE status != 4 AND status != 6 AND postedby = '".$_REQUEST['email']."' ORDER BY id DESC ";
		$result = mysql_query($query);
		$data = "";
		while($row = mysql_fetch_array($result)){
			$data[] = $row;
		}
		$response["STATUS"] = "OK";
		$response["MSG"] = "Jobs data received.";
		$response["DATA"] = $data;
		echo json_encode($response);
		break;	

	case 'FINISHED_JOB':
		$query = "SELECT * FROM jobs WHERE status = 4 AND takenby = '".$_REQUEST['vendor']."' ORDER BY id DESC ";
		$result = mysql_query($query);
		$data = "";
		while($row = mysql_fetch_array($result)){
			$data[] = $row;
		}
		$response["STATUS"] = "OK";
		$response["MSG"] = "Jobs data received.";
		$response["DATA"] = $data;
		echo json_encode($response);
		break;

	case 'VIEW_JOB':
		$query = "SELECT * FROM jobs WHERE id = ".$_REQUEST['jobid'] ." ORDER BY id DESC ";
		$result = mysql_query($query);
		$data = "";
		while($row = mysql_fetch_array($result)){
			$data[] = $row;
		}
		$response["STATUS"] = "OK";
		$response["MSG"] = "Job data received with id ". $_REQUEST['jobid'];
		$response["DATA"] = $data;
		echo json_encode($response);
		break;	

	case 'PAYMENT':
		$query = "UPDATE jobs SET payment_status=1 WHERE id = ". $_REQUEST['jobid'];
		$result = mysql_query($query);
		if($result){
			$response["STATUS"] = "OK";
			$response["MSG"] = "Payment was successfull. Thank you for hiring our services.";
			$response["DATA"] = "";
		}else{

		}
		echo json_encode($response);
		break;

	case 'ACCEPT_JOB':
		$query = "UPDATE jobs SET takenby='".$_REQUEST['vendor']."', status = 5 WHERE id = ". $_REQUEST['jobid'];
		$result = mysql_query($query);
		if($result){
			$response["STATUS"] = "OK";
			$response["MSG"] = "You have accepted this job. Customer will approve you.";
			$response["DATA"] = "";
		}else{

		}
		echo json_encode($response);
		break;	

	case 'APPROVE_JOB':
		$query = "UPDATE jobs SET status = 1 WHERE id = ". $_REQUEST['jobid'];
		$result = mysql_query($query);
		if($result){
			$response["STATUS"] = "OK";
			$response["MSG"] = "You have accepted this job. Customer will approve you.";
			$response["DATA"] = "";
		}else{

		}
		echo json_encode($response);
		break;		

	case 'REJECT_JOB':
		$query = "UPDATE jobs SET takenby='', status = 0 WHERE id = ". $_REQUEST['jobid'];
		$result = mysql_query($query);
		if($result){
			$response["STATUS"] = "OK";
			$response["MSG"] = "You have rejected this request.";
			$response["DATA"] = "";
		}else{

		}
		echo json_encode($response);
		break;

	case 'START_JOB':
		$query = "UPDATE jobs SET status = 3 WHERE id = ". $_REQUEST['jobid']." AND takenby='".$_REQUEST['vendor']."'";
		$result = mysql_query($query);
		if($result){
			$response["STATUS"] = "OK";
			$response["MSG"] = "Starting work.";
			$response["DATA"] = "";
		}else{

		}
		echo json_encode($response);
		break;

	case 'TRAVEL_JOB':
		$query = "UPDATE jobs SET status = 2 WHERE id = ". $_REQUEST['jobid']." AND takenby='".$_REQUEST['vendor']."'";
		$result = mysql_query($query);
		if($result){
			$response["STATUS"] = "OK";
			$response["MSG"] = "En route to work.";
			$response["DATA"] = "";
		}else{

		}
		echo json_encode($response);
		break;

	case 'FINISH_JOB':
		$query = "UPDATE jobs SET status = 4 WHERE id = ". $_REQUEST['jobid']." AND takenby='".$_REQUEST['vendor']."'";
		$result = mysql_query($query);
		if($result){
			$response["STATUS"] = "OK";
			$response["MSG"] = "Job has been successfully ended.";
			$response["DATA"] = "";
		}else{

		}
		echo json_encode($response);
		break;

	case 'DELETE_JOB':
		$query = "UPDATE jobs SET status = 6 WHERE id = ". $_REQUEST['jobid'];
		$result = mysql_query($query);
		if($result){
			$response["STATUS"] = "OK";
			$response["MSG"] = "Job has been successfully deleted.";
			$response["DATA"] = "";
		}else{

		}
		echo json_encode($response);
		break;	

	case 'ALL_USERS':
		$query = "SELECT * FROM user WHERE type = 1 AND status !=3";
		$result = mysql_query($query);
		$data = "";
		while($row = mysql_fetch_array($result)){
			$data[] = $row;
		}
		$response["STATUS"] = "OK";
		$response["MSG"] = "Users data received.";
		$response["DATA"] = $data;
		echo json_encode($response);
		break;

	case 'ALL_VENDORS':
		$query = "SELECT * FROM user WHERE type = 2 AND status != 3";
		$result = mysql_query($query);
		$data = "";
		while($row = mysql_fetch_array($result)){
			$data[] = $row;
		}
		$response["STATUS"] = "OK";
		$response["MSG"] = "Vendors data received.";
		$response["DATA"] = $data;
		echo json_encode($response);
		break;	

	case 'DELETE_USER':
		$query = "UPDATE user SET status = 3 WHERE id=". $_REQUEST['userid'];
		$result = mysql_query($query);
		$data = "";
		$response["STATUS"] = "OK";
		$response["MSG"] = "User removed.";
		$response["DATA"] = $data;
		echo json_encode($response);
		break;

	case 'USER_BY_ID':
		$query = "SELECT * FROM user WHERE id = '".$_REQUEST['userid']."'";
		$result = mysql_query($query);
		$data = "";
		while($row = mysql_fetch_array($result)){
			$data[] = $row;
		}
		$response["STATUS"] = "OK";
		$response["MSG"] = "Users data received.";
		$response["DATA"] = $data;
		echo json_encode($response);
		break;	

	case 'ALL_JOBS':
		$query = "SELECT * FROM jobs WHERE status != 4 AND status !=6 ORDER BY id DESC ";
		$result = mysql_query($query);
		$data = "";
		while($row = mysql_fetch_array($result)){
			$data[] = $row;
		}
		$response["STATUS"] = "OK";
		$response["MSG"] = "Jobs data received.";
		$response["DATA"] = $data;
		echo json_encode($response);
		break;

	case 'TOTAL_EARNED':
		$query = "SELECT SUM(price) as total, COUNT(id) as counter FROM jobs WHERE status = 4 AND status !=6  and payment_status = 1";
		$result = mysql_query($query);
		$data = "";
		while($row = mysql_fetch_array($result)){
			$data[] = $row;
		}
		$response["STATUS"] = "OK";
		$response["MSG"] = "Total earnings data received.";
		$response["DATA"] = $data;
		echo json_encode($response);
		break;	

	case 'TOTAL_CREDIT':
		$query = "SELECT SUM(price) as total, COUNT(id) as counter FROM jobs WHERE  status !=6  AND payment_status = 0";
		$result = mysql_query($query);
		$data = "";
		while($row = mysql_fetch_array($result)){
			$data[] = $row;
		}
		$response["STATUS"] = "OK";
		$response["MSG"] = "Total earnings data received.";
		$response["DATA"] = $data;
		echo json_encode($response);
		break;

	case 'TODAYS_CREDIT':
		$query = "SELECT SUM(price) as total, COUNT(id) as counter FROM jobs WHERE  status !=6  AND payment_status = 0 AND added_on > NOW() - INTERVAL 1 DAY";
		$result = mysql_query($query);
		$data = "";
		while($row = mysql_fetch_array($result)){
			$data[] = $row;
		}
		$response["STATUS"] = "OK";
		$response["MSG"] = "Day earnings data received.";
		$response["DATA"] = $data;
		echo json_encode($response);
		break;	

	case 'ALL_FINISHED_JOBS':
		$query = "SELECT * FROM jobs WHERE status = 4 ORDER BY id DESC ";
		$result = mysql_query($query);
		$data = "";
		while($row = mysql_fetch_array($result)){
			$data[] = $row;
		}
		$response["STATUS"] = "OK";
		$response["MSG"] = "Jobs data received.";
		$response["DATA"] = $data;
		echo json_encode($response);
		break;	

	default:
		$response["STATUS"] = "ERROR";
		$response["MSG"] = "Server did not recognise this request.";
		$response["DATA"] = [];
		echo json_encode($response);
		break;
}

?>