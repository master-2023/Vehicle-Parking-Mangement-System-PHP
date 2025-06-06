               <!-- form code of category -->
			   <?php include 'db_connect.php' ?>

<?php
if(isset($_GET['id'])){
$qry = $conn->query("SELECT * FROM category where id= ".$_GET['id']);
foreach($qry->fetch_array() as $k => $val){
	$$k=$val;
}
}
?>
<div class="container-fluid">
    <!-- Form for managing a vehicle category -->
    <form action="" id="manage-category">
        <!-- Hidden input to store the category ID (used for editing) -->
        <input type="hidden" name="id" value="<?php echo isset($id) ? $id :'' ?>">
        
        <!-- Form group for vehicle category name -->
        <div class="form-group">
            <label for="" class="control-label">Vehicle Category</label>
            <!-- Text input for the category name -->
            <!-- Pre-fills the input with the category name if it's set (for editing) -->
            <input type="text" class="form-control" name="name"  value="<?php echo isset($name) ? $name :'' ?>" required>
        </div>
        
        <!-- Form group for rate per hour -->
        <div class="form-group">
            <label for="" class="control-label">Rate per Hour</label>
            <!-- Number input for the rate per hour -->
            <!-- Pre-fills the input with the rate if it's set (for editing) -->
            <!-- "step='any'" allows the input of decimal values -->
            <input type="number" class="form-control text-right" name="rate" step="any"  value="<?php echo isset($rate) ? $rate :'' ?>" required>
        </div>
    </form>
</div>

<script>
	$('#manage-category').submit(function(e){
		e.preventDefault()
		start_load()
		$('#msg').html('')
		$.ajax({
			url:'ajax.php?action=save_category',
			data: new FormData($(this)[0]),
		    cache: false,
		    contentType: false,
		    processData: false,
		    method: 'POST',
		    type: 'POST',
			success:function(resp){
				if(resp==1){
					alert_toast("Data successfully added",'success')
					setTimeout(function(){
						location.reload()
					},1500)

				}
				else if(resp==2){
					$('#msg').html("<div class='alert alert-danger'>Name already exist.</div>")
					end_load()

				}
			}
		})
	})
</script>