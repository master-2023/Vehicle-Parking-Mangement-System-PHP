<!-- Dashboard admin panel data display section  -->

<?php include 'db_connect.php' ?>
<style>
   span.float-right.summary_icon {
    font-size: 3rem;
    position: absolute;
    right: 1rem;
    color: #ffffff96;
    
}
.card.text-center{
    background-color:sky;
    /* background-image:url(assets/img/log1.webp); */
    
}
/*  */

    body {
        background-color: #f8f9fa; /* Light background for a modern look */
        font-family: 'Arial', sans-serif; /* Modern font */
    }

    .card {
        transition: transform 0.3s, box-shadow 0.3s; /* Add smooth transition for hover effect */
        border-radius: 10px; /* Rounded corners for cards */
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1); /* Subtle shadow */
    }

    .card:hover {
        transform: translateY(-5px); /* Raise card on hover */
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.2); /* Enhance shadow on hover */
    }

    .summary_icon {
        font-size: 3rem;
        position: absolute;
        right: 1rem;
        color: #ffffff96; /* Light color for icons */
    }

    .bg-secondary {
        background-color: #6c757d; /* Darker secondary background */
    }

    .bg-info {
        background-color: #17a2b8; /* Info background */
    }

    .bg-success {
        background-color: #28a745; /* Success background */
    }

    .table {
        border-radius: 10px; /* Rounded table corners */
        overflow: hidden; /* To prevent corners from sticking out */
    }

    .table th, .table td {
        text-align: center; /* Center text in table */
    }

    .copyright_text, .policy_terms {
        text-align: center;
        margin-top: 20px; /* Space above */
        font-size: 0.9rem; /* Slightly smaller font size */
    }

    .policy_terms a {
        margin: 0 10px; /* Space between links */
        color: #007bff; /* Link color */
    }

    .policy_terms a:hover {
        text-decoration: underline; /* Underline on hover */
    }

    /* Animation for table rows */
    tr {
        transition: background-color 0.3s; /* Smooth transition for hover */
    }

    tr:hover {
        background-color: #f1f1f1; /* Light background on hover */
    }


</style>
<div class="container-fluid">
    <div class="row justify-content-center mt-3 mb-3">
        <div class="col-md-3 col-sm-4 col-6">
            <div class="card bg-secondary">
                <div class="card-body text-white">
                    <span class="float-right summary_icon"><i class="fa fa-car-alt"></i></span>
                    <h4><b>
                        <?php echo $conn->query("SELECT * FROM parked_list where status = 1")->num_rows; ?>
                    </b></h4>
                    <p><b>Total Parked Vehicle</b></p>
                </div>
            </div>
        </div>
        <div class="col-md-3 col-sm-4 col-6">
            <div class="card bg-info">
                <div class="card-body text-white">
                    <span class="float-right summary_icon"><i class="fa fa-car-side"></i></span>
                    <h4><b>
                        <?php echo $conn->query("SELECT * FROM parked_list where status = 2")->num_rows; ?>
                    </b></h4>
                    <p><b>Checked-Out Vehicle</b></p>
                </div>
            </div>
        </div>
        <!-- New Container for Registered Users -->
        <div class="col-md-3 col-sm-4 col-6">
            <div class="card bg-success">
                <div class="card-body text-white">
                    <span class="float-right summary_icon"><i class="fa fa-users"></i></span>
                    <h4><b>
                        <?php echo $conn->query("SELECT * FROM tblregusers")->num_rows; ?>
                    </b></h4>
                    <p><b>Total Registered Users</b></p>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="row mt-3 ml-3 mr-3">
        <div class="col-lg-12">
            <div class="card text-center">
                <div class="card-body text-center text-black">
                    <?php echo "Welcome back ". $_SESSION['login_name']?>
                    <hr>
                    <div class="row-right mt-4">
                        <div class="col-lg-8 offset-2">
                            <table class="table table-bordered bg-success">
                                <tr>
                                    <th class="text-center bg-warning">Parking Area</th>
                                    <th class="text-center bg-warning">Available</th>
                                </tr>
                                <div class="row">
                        <div class="col-md-6">
                            <!-- Pie Chart for Total Parked vs Checked-Out Vehicles -->
                            <canvas id="vehicleStatusPieChart"></canvas>
                        </div>
                        <div class="col-md-6">
                            <!-- Pie Chart for Parking Area vs Available Spaces -->
                            <canvas id="parkingAreaPieChart"></canvas>
                        </div>
                    </div>
                                <?php
                                $parkingAreas = [];
                                $availableSpaces = [];
                                $cat = $conn->query("SELECT * FROM category order by name asc");
                                while($crow = $cat->fetch_assoc()):
                                ?>
                                <tr>
                                    <th class="text-center bg-light" colspan="2"><?php echo $crow['name'] ?></th>
                                </tr>
                                <?php 
                                $location = $conn->query("SELECT * FROM parking_locations where category_id = '".$crow['id']."' order by location asc");
                                while($lrow= $location->fetch_assoc()):
                                    $in = $conn->query("SELECT * FROM parked_list where status = 1 and location_id = ".$lrow['id'])->num_rows;
                                    $available = $lrow['capacity'] - $in;
                                    
                                    $parkingAreas[] = $lrow['location'];
                                    $availableSpaces[] = $available;
                                ?>
                                <tr>
                                    <td><?php echo $lrow['location'] ?></td>
                                    <td class="text-center bg-primary"><?php echo $available ?></td>
                                </tr>
                                <?php endwhile; ?>
                                <?php endwhile; ?>
                            </table>
                        </div>
                    </div>      
                </div>
            </div>
        </div>
    </div>

    <span class="copyright_text">Copyright © 2024 <a>PAYPARK </a>All rights reserved</span>
    <span class="policy_terms">
        <a href="#">Privacy policy</a>
        <a href="#">Terms & condition</a>
    </span>
    <hr>
    <?php if($_SESSION['login_type'] == 2): ?>
    <?php endif; ?>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
    function queueNow(){
            $.ajax({
                url:'ajax.php?action=update_queue',
                success:function(resp){
                    resp = JSON.parse(resp)
                    $('#sname').html(resp.data.name)
                    $('#squeue').html(resp.data.queue_no)
                    $('#window').html(resp.data.wname)
                }
            })
    }
</script>

<script>
   // Get data for the Total Parked vs Checked-Out Vehicles pie chart
const totalParked = <?php echo $conn->query("SELECT * FROM parked_list where status = 1")->num_rows; ?>;
// Fetches the number of parked vehicles (status = 1) from the database and assigns it to totalParked

const totalCheckedOut = <?php echo $conn->query("SELECT * FROM parked_list where status = 2")->num_rows; ?>;
// Fetches the number of checked-out vehicles (status = 2) from the database and assigns it to totalCheckedOut

// Get data for the Parking Area vs Available Spaces pie chart
const parkingAreas = <?php echo json_encode($parkingAreas); ?>;
// Converts the PHP array of parking areas to a JSON object and assigns it to parkingAreas

const availableSpaces = <?php echo json_encode($availableSpaces); ?>;
// Converts the PHP array of available spaces to a JSON object and assigns it to availableSpaces

function chartClickHandler(event, chart, labels, blockId) {
    const points = chart.getElementsAtEventForMode(event, 'nearest', { intersect: true }, true);
    if (points.length) {
        const index = points[0].index;
        const selectedLabel = labels[index]; // Get the label of the clicked segment
        window.location.href = `index.php?page=reports&category=${encodeURIComponent(selectedLabel)}&block=${blockId}`;
    }
}

// Render the Total Parked vs Checked-Out Vehicles pie chart (Block 1)
const ctx1 = document.getElementById('vehicleStatusPieChart').getContext('2d');
const vehicleStatusPieChart = new Chart(ctx1, {
    type: 'pie',
    data: {
        labels: ['Total Parked Vehicle', 'Total Checked-Out Vehicle'],
        datasets: [{
            data: [totalParked, totalCheckedOut],
            backgroundColor: ['#6c757d', '#17a2b8'],
            hoverBackgroundColor: ['#5a6268', '#138496'],
            borderWidth: 1
        }]
    },
    options: {
        responsive: true,
        plugins: {
            legend: {
                position: 'bottom',
            }
        },
        onClick: function(event) {
            chartClickHandler(event, vehicleStatusPieChart, ['parked', 'checked_out'], 1); // Block 1
        }
    }
});

// Render the Parking Area vs Available Spaces pie chart (Block 2)
const ctx2 = document.getElementById('parkingAreaPieChart').getContext('2d');
const parkingAreaPieChart = new Chart(ctx2, {
    type: 'pie',
    data: {
        labels: parkingAreas,
        datasets: [{
            data: availableSpaces,
            backgroundColor: ['#ffadad','#ffd6a5','#fdffb6','#caffbf','#9bf6ff','#a0c4ff','#bdb2ff'],
            hoverBackgroundColor: ['#ff8787','#ffb26b','#fbff95','#9ef3b3','#76e4ff','#7fa2ff','#8e80ff'],
            borderWidth: 1
        }]
    },
    options: {
        responsive: true,
        plugins: {
            legend: {
                position: 'bottom',
            }
        },
        onClick: function(event) {
            chartClickHandler(event, parkingAreaPieChart, parkingAreas, 2); // Block 2
        }
    }
});

</script>
</div>
<script>
	
</script>