<?php require_once('../config.php'); ?>
<?php require_once('../functions.php'); ?>
<?php 

if($_POST) {

	$startDate = $_POST['startDate'];
	$date = DateTime::createFromFormat('m/d/Y',$startDate);
	$start_date = $date->format("Y-m-d");


	$endDate = $_POST['endDate'];
	$format = DateTime::createFromFormat('m/d/Y',$endDate);
	$end_date = $format->format("Y-m-d");

	$sql = "SELECT * FROM cases 
	WHERE  DATE(appointment_date) >= '$start_date' AND DATE(appointment_date) <= '$end_date' AND status = 1";
	$result = $con->query($sql);

	$table = '
	<table border="1" cellspacing="0" cellpadding="0" style="width:100%;">
	<tr><th colspan="6"> General Report</th></tr>
		<tr>
			<th>Appointment ID</th>
			<th>Service</th>
			<th>Citizen Name</th>
			<th>Citizen Passport</th>
			<th>Appointment Time</th>
			<th>Status</th>
		</tr>

		<tr>';
		$totalAccepted = 0;
		$totalDeclined = 0;
		$status = null;
		while ($appointment = $result->fetch_assoc()) {
			if($appointment['appointment_status'] == 1){
				$status = "Pending";
			}
			if($appointment['appointment_status'] == 2){
				$status = "Completed";
				$totalAccepted++;
			}
			if($appointment['appointment_status'] == 3){
				$status = "Rejected";
				$totalDeclined++;
			}
			$table .= '<tr>
				<td><center>'.$appointment['id'].'</center></td>
				<td><center>'.getServiceNameFromId($con, $appointment['service_id']).'</center></td>
				<td><center>'.$appointment['firstname'].' '.$appointment['lastname'].'</center></td>
				<td><center>'.$appointment['passport_no'].'</center></td>
				<td><center>'.date('d/M/y hA',strtotime($appointment['appointment_date'])).'</center></td>
				<td><center>'.$status.'</center></td>
			</tr>';	
		}
		$table .= '
		</tr>

		<tr>
			<th colspan="3" >Total Completed</th>
			<td colspan="3"><center>'.$totalAccepted.'</center></td>
		</tr>
		<tr>
			<th colspan="3" >Total Rejected</th>
			<td colspan="3"><center>'.$totalDeclined.'</center></td>
		</tr>';

	$table .= '	
	</table>
	';	

	echo $table;

}

?>