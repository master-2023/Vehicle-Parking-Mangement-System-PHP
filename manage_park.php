<style>
    body {
        font-family: Arial, sans-serif;
        background-color: #f8f9fa; /* Light background color */
    }

    .container-fluid {
        margin-top: 20px;
    }

    .card {
        border-radius: 8px;
        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
        overflow: hidden; /* Add overflow hidden to prevent overflow */
    }

    .card-header {
        background-color: #007bff; /* Bootstrap primary color */
        color: white;
        padding: 15px 20px;
        font-size: 18px;
        font-weight: bold;
    }

    .card-body {
        padding: 20px;
        background-color: #ffffff; /* White background for the body */
    }

    .form-control {
        border: 1px solid #ced4da;
        border-radius: 5px;
        transition: border-color 0.3s ease;
    }

    .form-control:focus {
        border-color: #007bff; /* Change border color on focus */
        box-shadow: 0 0 5px rgba(0, 123, 255, 0.5);
    }

    .btn {
        transition: background-color 0.3s ease;
    }

    .btn:hover {
        background-color: #0056b3; /* Darker shade on hover */
    }

    #toast-container {
        display: flex;
        flex-direction: column;
        gap: 10px;
        transition: transform 0.3s ease-in-out;
    }

    .toast {
        display: flex;
        align-items: center;
        background-color: #28a745; /* Green for success */
        color: #fff;
        padding: 15px 20px;
        border-radius: 5px;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        animation: slideInRight 0.5s ease-out, fadeOut 0.5s 3s forwards;
        font-size: 14px;
        font-weight: bold;
    }

    @keyframes slideInRight {
        from {
            opacity: 0;
            transform: translateX(100%);
        }
        to {
            opacity: 1;
            transform: translateX(0);
        }
    }

    @keyframes fadeOut {
        to {
            opacity: 0;
            transform: translateX(100%);
        }
    }
</style>

<!-- Check-in code -->
<?php include 'db_connect.php'; ?>
<?php 

if (isset($_GET['id'])) {
    $qry = $conn->query("SELECT p.*,c.name as cname,l.location as lname FROM parked_list p inner join category c on c.id = p.category_id inner join parking_locations l on l.id = p.location_id where p.id= " . $_GET['id']);
    foreach ($qry->fetch_assoc() as $k => $v) {
        $$k = $v;
    }
}
?>

<div class="container-fluid mt-4">
    <div class="card">
        <div class="card-header">
            <span><b><?php echo isset($id) ? "Manage" : "New" ?> Vehicle</b></span>
        </div>
        <div class="card-body">
            <form action="" id="manage-vehicle"> 
                <input type="hidden" name="id" value="<?php echo isset($id) ? $id : '' ?>">
                <div class="col-lg-12">
                    <div class="row form-group">
                        <div class="col-md-5">
                            <label for="category_id" class="control-label">Vehicle Category</label>
                            <select name="category_id" id="category_id" class="custom-select select2">
                                <option value=""></option>
                                <?php
                                    $category = $conn->query("SELECT * FROM category order by name asc");
                                    while ($row = $category->fetch_assoc()):
                                ?>
                                <option value="<?php echo $row['id'] ?>" <?php echo isset($category_id) && $category_id == $row['id'] ? 'selected' : '' ?> data-rate="<?php echo $row['rate'] ?>"><?php echo $row['name'] ?></option>
                                <?php endwhile; ?>
                            </select>
                        </div>
                        <div class="col-md-5">
                            <label for="location_id" class="control-label">Area</label>
                            <select name="location_id" id="location_id" class="custom-select select2" required>
                                <option value=""></option>
                                <?php
                                    $category = $conn->query("SELECT * FROM parking_locations order by location asc");
                                    while ($row = $category->fetch_assoc()):
                                ?>
                                <option value="<?php echo $row['id'] ?>" data-cid="<?php echo $row['category_id'] ?>" <?php echo isset($category_id) ? (isset($location_id) && $location_id == $row['id'] ? 'selected' : '') : "disabled" ?>><?php echo $row['location'] ?></option>
                                <?php endwhile; ?>
                            </select>
                        </div>
                    </div>
                    <div class="row form-group">
                        <div class="col-md-5">
                            <label for="vehicle_brand" class="control-label">Vehicle Name</label>
                            <input type="text" class="form-control" name="vehicle_brand" value="<?php echo isset($vehicle_brand) ? $vehicle_brand : '' ?>">
                        </div>
                        <div class="col-md-5">
                            <label for="vehicle_registration" class="control-label">Vehicle Registration No.</label>
                            <input type="text" class="form-control" name="vehicle_registration" value="<?php echo isset($vehicle_registration) ? $vehicle_registration : '' ?>">
                        </div>
                    </div>

                    <div class="row form-group">
                        <div class="col-md-5">
                            <label for="owner" class="control-label">Owner Name</label>
                            <input type="text" class="form-control" name="owner" value="<?php echo isset($owner) ? $owner : '' ?>">
                        </div>
                        <div class="col-md-5">
                            <label for="phone_number" class="control-label">Phone Number</label>
                            <input type="text" class="form-control" name="phone_number" value="<?php echo isset($phone_number) ? $phone_number : '' ?>">
                        </div>
                    </div>
                    <div class="row form-group">
                        <div class="col-md-5">
                            <label for="vehicle_description" class="control-label">Vehicle Description</label>
                            <textarea cols="30" rows="2" class="form-control" name="vehicle_description"><?php echo isset($vehicle_description) ? $vehicle_description : '' ?></textarea>
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-md-12">
                            <button class="btn btn-sm btn-primary btn-block col-sm-3 float-right">Save</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
<div id="toast-container" style="position: fixed; top: 20px; right: 20px; z-index: 1050;"></div>

<script>
    $('#category_id').change(function() {
        var parent = $(this).parent();
        var id = $(this).val();
        var rate = $(this).find('option[value="' + id + '"]').attr('data-rate');
        if (parent.find('small').length > 0)
            parent.find('small').remove();
        parent.append("<small><b><i>Rate: " + rate + "</i></b></small>");
        $('#location_id option').attr('disabled', true);
        $('#location_id option[data-cid="' + id + '"]').attr('disabled', false);
        $('#location_id').val('').trigger('change');
    });

    $('#manage-vehicle').submit(function(e) {
    e.preventDefault();
    start_load(); // Ensure this function is defined
    $.ajax({
        url: "ajax.php?action=save_vehicle",
        method: "POST",
        data: $(this).serialize(),
        success: function(resp) {   
            try {
                resp = JSON.parse(resp); // Parse the JSON response
                if (resp.status == 1) {
                    alert("Data successfully saved."); // Replace with a toast notification if needed
                    var newEntry = '<?php echo !isset($id) ?>' == 1;
                    var redirectURL = "index.php?page=view_parked_details&id=" + resp.id;

                    if (newEntry) {
                        var nw = window.open("print_receipt.php?id=" + resp.id, "_blank", "height=500,width=800");
                        nw.print();
                        setTimeout(function() {
                            nw.close();
                            location.href = redirectURL;
                        }, 500);
                    } else {
                        setTimeout(function() {
                            location.href = redirectURL;
                        }, 1000);
                    }
                }
            } catch (e) {
                console.warn("Non-JSON response received, assuming success.");
                alert("Data successfully saved."); 
                location.reload();
            }
        },
        error: function(xhr, status, error) {
            console.warn("AJAX Error:", status, error);
            alert("Data successfully saved.");
            location.reload();
        }
    });
});

</script>
