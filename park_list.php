<!-- parking list  main Form section data display-->
<?php include 'db_connect.php' ?>
<style>
	/* Badge Styling */
.badge-warning {
    background-color: #ffc107; /* Yellow color */
    color: #212529; /* Dark text */
    padding: 5px 15px;
    border-radius: 5px; /* Rounded rectangle */
    display: inline-block;
    animation: fadeIn 0.8s ease-in-out; /* Fade-in animation */
    text-align: center; /* Center text horizontally */
    line-height: 10px; /* Center text vertically */
}

.badge-success {
    background-color: #28a745; /* Green color */
    color: #fff; /* White text */
    padding: 5px 15px;
    border-radius: 5px; /* Rounded rectangle */
    display: inline-block;
    animation: fadeIn 0.8s ease-in-out; /* Fade-in animation */
    text-align: center; /* Center text horizontally */
    line-height: 10px; /* Center text vertically */
}

/* Fade-in Animation */
@keyframes fadeIn {
    from {
        opacity: 0;
        transform: translateY(-10px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

/* Hover Effect */
.badge-warning:hover,
.badge-success:hover {
    transform: scale(1.1); /* Slightly larger on hover */
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2); /* Add shadow */
    transition: transform 0.3s ease, box-shadow 0.3s ease;
}

</style>
<div class="conataine-fluid mt-4">
	<div class="col-lg-12">
		<div class="card">
			<div class="card-header">
				Check-In/Check-out List
			</div>
			<div class="card-body">
				<table class="table-condensed table">
					<thead>
						<tr>
							<th class="text-center">#</th>
							<th>Date</th>
							<th>Parking Reference No.</th>
							<th>Owner</th>
							<th>Status</th>
							<th>Action</th>
						</tr>
					</thead>
					<tbody>
						<?php
						$i = 1;
						$qry = $conn->query("SELECT * FROM parked_list order by id desc ");
						while($row=$qry->fetch_assoc()):
						?>	
						<tr>
							<td class="text-center"><?php echo $i++; ?></td>
							<td><?php echo date('M d,Y',strtotime($row['date_created'])) ?></td>
							<td><?php echo $row['ref_no'] ?></td>
							<td><?php echo $row['owner'] ?></td>
							<td>
    <?php if ($row['status'] == 1): ?>
        <span class="badge badge-warning">Checked-In</span>
    <?php else: ?>
        <span class="badge badge-success">Checked-Out</span>
    <?php endif; ?>
</td>

							<td class="text-center">
								<a class="btn btn-sm btn-outline-primary view_park" href="index.php?page=view_parked_details&id=<?php echo $row['id'] ?>" class="<?php echo $row['id'] ?>">View</a>
								<a class="btn btn-sm btn-outline-danger delete_park" href="javascript:void(0)" class="<?php echo $row['id'] ?>">Delete</a>
							</td>
						</tr>
					<?php endwhile ?>
					</tbody>
				</table>
			</div>
		</div>
	</div>
</div>
<script>
	$('table').dataTable()
	$('.delete_park').click(function(){
		_conf("Are you sure to delete this data?","delete_park",[$(this).attr('data-id')])
	})
	
	function delete_park($id){
		start_load()
		$.ajax({
			url:'ajax.php?action=delete_vehicle',
			method:'POST',
			data:{id:$id},
			success:function(resp){
				if(resp==1){
					alert_toast("Data successfully deleted",'success')
					setTimeout(function(){
						location.reload()
					},1500)

				}
			}
		})
	}
	
</script>