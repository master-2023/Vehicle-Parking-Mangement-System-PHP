                                       <!-- Parking Checkout Receipt code after printing print ticket option  -->

									   <?php include 'db_connect.php' ?>
<?php
date_default_timezone_set('Asia/Kolkata');

// Fetching data from the database
$qry = $conn->query("SELECT p.*,c.name as cname,c.rate,l.location as lname 
                     FROM parked_list p 
                     INNER JOIN category c ON c.id = p.category_id 
                     INNER JOIN parking_locations l ON l.id = p.location_id 
                     WHERE p.id= ".$_GET['id']);
foreach($qry->fetch_assoc() as $k => $v){
	$$k = $v;
}

// Fetching the check-in timestamp
$in_qry = $conn->query("SELECT * FROM parking_movement WHERE pl_id = '".$_GET['id']."' AND status = 1");
$in_timestamp = $in_qry->num_rows > 0 ? date("Y-m-d H:i", strtotime($in_qry->fetch_array()['created_timestamp'])) : 'N/A';

// Fetching the check-out timestamp
$out_qry = $conn->query("SELECT * FROM parking_movement WHERE pl_id = $id AND status = 2");
$out_timestamp = $out_qry->num_rows > 0 ? date("Y-m-d H:i", strtotime($out_qry->fetch_array()['created_timestamp'])) : 'N/A';

// Calculating the difference in seconds between check-in and check-out
$time_diff_seconds = abs(strtotime($out_timestamp) - strtotime($in_timestamp));

// Converting the difference to hours and minutes
$hours = floor($time_diff_seconds / 3600);
$minutes = floor(($time_diff_seconds % 3600) / 60);

// Formatting the time difference as "Xh Ym"
$time_diff_formatted = $hours . 'h ' . $minutes . 'm';

// Calculating the total time difference in decimal hours
$time_diff_hours = $hours + ($minutes / 60);

?>
<style>
	.text-right {
		text-align: right;
	}
	th {
		text-align: left;
	}
</style>
<p><center><b>Parking Receipt</b></center></p>
<table class="table table-bordered" width="100%">
	<tr>
		<th>Parking Ref. No</th>
		<td class="text-right"><?php echo $ref_no ?></td>
	</tr>
	<tr>
		<th>Check-In Timestamp</th>
		<td class="text-right"><?php echo $in_timestamp ?></td>
	</tr>
	<tr>
		<th>Check-Out Timestamp</th>
		<td class="text-right"><?php echo $out_timestamp ?></td>
	</tr>
	<tr>
		<th>Time Difference</th>
		<td class="text-right"><?php echo $time_diff_formatted . " (" . number_format($time_diff_hours, 2) . " hours)" ?></td>
	</tr>
	<tr>
		<th>Vehicle Type Hourly Rate</th>
		<td class="text-right"><?php echo number_format($rate, 2) ?></td>
	</tr>
	<tr>
		<th>Amount Due</th>
		<td class="text-right"><?php echo number_format($rate * $time_diff_hours, 2) ?></td>
	</tr>
	<tr>
		<th>Amount Tendered</th>
		<td class="text-right"><?php echo number_format($amount_tendered, 2) ?></td>
	</tr>
	<tr>
		<th>Change</th>
		<td class="text-right"><?php echo number_format($amount_change, 2) ?></td>
	</tr>
</table>
