                <!-- get  view right side calculaton information  -->
				<?php include 'db_connect.php' ?>
<?php
date_default_timezone_set('Asia/Kolkata');

// Fetch the parked vehicle information
$qry = $conn->query("SELECT p.*,c.name as cname,c.rate,l.location as lname FROM parked_list p 
                     INNER JOIN category c ON c.id = p.category_id 
                     INNER JOIN parking_locations l ON l.id = p.location_id 
                     WHERE p.id= ".$_GET['id']);
foreach($qry->fetch_assoc() as $k => $v){
	$$k = $v;
}

// Fetch the check-in time
$in_qry = $conn->query("SELECT * FROM parking_movement WHERE pl_id = '".$_GET['id']."' AND status = 1");
$in_timestamp = $in_qry->num_rows > 0 ? date("Y-m-d H:i:s", strtotime($in_qry->fetch_array()['created_timestamp'])) : 'N/A';

// Get the current time as the check-out time
$now = date('Y-m-d H:i:s');

// Calculate the difference between check-in and check-out times
$ocalc = abs(strtotime($now) - strtotime($in_timestamp));

// Calculate the total time in hours and minutes
$hours = floor($ocalc / 3600);
$minutes = floor(($ocalc / 60) % 60);

// Formatting the time difference as "Xh Ym"
$calc = $hours . 'h ' . $minutes . 'm';

// Calculate the total time difference in hours (as a decimal value)
$ocalc_in_hours = $hours + ($minutes / 60);  // Total time in hours (decimal)
?>
<form action="" id="checkout_frm">
	<div class="col-md-12 mt-2">
		<table class="table table-bordered">
			<tr>
				<th>Check-In Timestamp</th>
				<td class="text-right"><?php echo $in_timestamp ?></td>
			</tr>
			<tr>
				<th>Check-Out Timestamp</th>
				<td class="text-right"><?php echo $now ?></td>
			</tr>
			<tr>
				<th>Time Difference</th>
				<td class="text-right"><?php echo $calc . " (" . number_format($ocalc_in_hours, 2) . " hours)" ?></td>
			</tr>
			<tr>
				<th>Vehicle Type Hourly Rate</th>
				<td class="text-right"><?php echo number_format($rate, 2) ?></td>
			</tr>
			<tr>
				<th>Amount Due</th>
				<td class="text-right"><?php echo number_format($rate * $ocalc_in_hours, 2) ?></td>
			</tr>
			<tr>
				<th>Amount Tendered</th>
				<td class="text-right">
					<input type="hidden" name="pl_id" value="<?php echo $id ?>" class="form-control">
					<input type="hidden" name="created_timestamp" value="<?php echo $now ?>" class="form-control">
					<input type="hidden" name="amount_due" value="<?php echo ($rate * $ocalc_in_hours) ?>" class="form-control">
					<input type="number" name="amount_tendered" step="any" class="form-control text-right">
					<input type="hidden" name="checkout_timestamp" value="<?php echo $now ?>" class="form-control">
				</td>
			</tr>
			<tr>
				<th>Change</th>
				<td class="text-right">
					<input type="number" name="amount_change" readonly="" step="any" class="form-control text-right">
				</td>
			</tr>
		</table>
		<div class="col-md-12">
			<button class="btn-sm col-md-3 float-right btn-primary btn-block"><i class="fa fa-arrow-alt-circle-right"></i> Checkout</button>
		</div>
	</div>
</form>

<script>
   $(document).ready(function() {
    $('#checkout_frm').submit(function(e) {
        e.preventDefault();

        // Update the checkout timestamp to the current time
        $('[name="checkout_timestamp"]').val(new Date().toISOString().slice(0, 19).replace('T', ' '));

        // Show loading indicator
        start_load();

        // Perform AJAX request
        $.ajax({
            url: 'ajax.php?action=checkout_vehicle',
            method: 'POST',
            data: $(this).serialize(), // Serialize form data
            success: function(resp) {
                // Check if the response indicates success
                if (resp == 1) {
                    // Display success message
                    alert_toast("Success", "success");

                    // Open a new window to print the checkout receipt
                    var nw = window.open("print_checkout_receipt.php?id=<?php echo $_GET['id'] ?>", "_blank", "height=500,width=800");

                    // Ensure the new window is loaded before printing
                    nw.onload = function() {
                        nw.print();
                        setTimeout(function() {
                            nw.close();
                            location.reload(); // Reload the page after closing the print window
                        }, 500);
                    };
                } else {
                    // Handle the case where the response is not 1 (e.g., show an error message)
                    alert_toast("An error occurred. Please try again.", "error");
                }
            },
            error: function(xhr, status, error) {
                // Handle AJAX request errors
                alert_toast("An error occurred: " + error, "error");
            }
        });
    });
});

