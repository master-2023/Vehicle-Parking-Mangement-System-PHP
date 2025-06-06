<?php 

?>
<style>  
	/* Container and Spacing */
.container {
    width: 100%;
    padding: 20px;
    box-sizing: border-box;
}

.mt-4 {
    margin-top: 20px;
}

.mb-3 {
    margin-bottom: 15px;
}

/* Button Styles */
.btn-new-user {
    background-color: #007bff;
    color: #fff;
    padding: 10px 25px;
    border: none;
    border-radius: 4px;
    cursor: pointer;
    font-size: 12px;
    /* float:right; */
    display: inline-block;
    text-align: center;
}

.btn-new-user i {
    margin-right: 10px;
}

.btn-new-user:hover {
    background-color: #0056b3;
}

/* Card Styles */
.card {
    background-color: #fff;
    border: 1px solid #ddd;
    border-radius: 2px;
    width: 100%;
    margin-top: 10px;
    overflow: hidden;
    box-shadow: 0 2px 5px rgba(0,0,0,0.1);
}

.card-body {
    padding: 15px;
}

/* Table Styles */
.custom-table {
    width: 100%;
    border-collapse: collapse;
    margin: 15px 0;
    font-size: 14px;
    text-align: center;
}

.custom-table th, .custom-table td {
    border: 1px solid #ddd;
    padding: 8px;
}

.custom-table th {
    background-color: #007bff;
    color: white;
}

/* Button Group Styles */
.btn-group {
    position: relative;
    display: inline-block;
}

.btn {
    background-color: #007bff;/* header part  */
    color: #fff;
    border: none;
    padding: 5px 10px;
    cursor: pointer;
    border-radius: 4px;
    margin-right: 5px;
}

.btn.dropdown-toggle::after {
    content: "\25BC";
    font-size: 8px;
    margin-left: 5px;
}

/* Dropdown Menu */
.dropdown-menu {
    display: none;
    position: absolute;
    background-color: #fff;
    min-width: 50px;
    box-shadow: 0 2px 5px rgba(0,0,0,0.1);
    z-index: 1;
}

.dropdown-item {
    padding: 15px 16px;
    color: #333;
    text-decoration: none;
    display: block;
}

.dropdown-item:hover {
    background-color: #f8f9fa;
}

.dropdown-divider {
    height: 1px;
    margin: 4px 0;
    overflow: hidden;
    background-color: #e9ecef;
}

/* Show Dropdown Menu on Click */
.btn-group:hover .dropdown-menu {
    display: block;
}

</style>
<div class="container mt-4"> <!-- Bootstrap container to structure the content with a top margin of 4 -->
    <div class="row mb-3"> <!-- Bootstrap row for layout purposes, with a bottom margin of 3 -->
        <div class="col"> <!-- Bootstrap column that spans the full width of the row -->
            <button class="btn-new-user" id="new_user"><!-- Button to create a new user, styled with a custom class -->
                <i class="fa fa-plus"></i> New User<!-- FontAwesome icon (plus sign) followed by the text "New User" -->
            </button>
        </div>
    </div>
    <div class="row"> <!-- Another Bootstrap row for content layout -->
         <div class="card"><!-- Bootstrap card component for containing table data -->
            <div class="card-body"><!-- Card body to hold the content of the card -->
                <table class="custom-table"> <!-- Custom-styled table for displaying user data -->
                     <thead> <!-- Table header to define column names -->
                        
                        <tr>
                            <th>#</th> <!-- Header for the serial number column -->
                             <th>Name</th> <!-- Header for the user name column -->
                            <th>Username</th><!-- Header for the username column -->
                             <th>Edit</th> <!-- Header for the edit action column -->
                        </tr>
                    </thead>
                    <tbody><!-- Table body for dynamically generated rows of user data -->
                        
                        <?php
                            include 'db_connect.php'; // Include the database connection file
                            
                            $users = $conn->query("SELECT * FROM users u ORDER BY name ASC");// Query to select all users from the "users" table, ordered alphabetically by name
                            $i = 1; // Initialize a counter for serial numbering of users
                            while ($row = $users->fetch_assoc()): // Loop through each user fetched from the database as an associative array
                        ?>
                        <tr>
                            <!-- Table row for each user -->
                            
                            <td><?php echo $i++; ?></td>
                            <!-- Display the serial number and increment the counter -->
                            
                            <td><?php echo ucwords($row['name']); ?></td>
                            <!-- Display the user's name with the first letter of each word capitalized -->
                            
                            <td><?php echo $row['username']; ?></td>
                            <!-- Display the user's username -->
                            
                            <td>
                                <!-- Column for action buttons (edit, delete) -->
                                
                                <div class="btn-group">
                                    <!-- Bootstrap button group to group related buttons -->
                                    
                                    <button type="button" class="btn">Edit</button>
                                    <!-- Button to edit user details -->
                                    
                                    <button type="button" class="btn dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        <!-- Dropdown toggle button for additional actions -->
                                        
                                        <span class="sr-only">Toggle Dropdown</span>
                                        <!-- Screen reader only text for accessibility -->
                                    </button>
                                    
                                    <div class="dropdown-menu">
                                        <!-- Dropdown menu for the edit and delete actions -->
                                        
                                        <a class="dropdown-item edit_user" href="javascript:void(0)" data-id="<?php echo $row['id']; ?>">Edit</a>
                                        <!-- Edit action link, with JavaScript action and data attribute for user ID -->
                                        
                                        <div class="dropdown-divider"></div>
                                        <!-- Divider line between edit and delete actions -->
                                        
                                        <a class="dropdown-item delete_user" href="javascript:void(0)" data-id="<?php echo $row['id']; ?>">Delete</a>
                                        <!-- Delete action link, with JavaScript action and data attribute for user ID -->
                                    </div>
                                </div>
                            </td>
                        </tr>
                        <?php endwhile; ?>
                        <!-- End of the PHP loop that generates table rows dynamically -->
                    </tbody>
                </table>
                <!-- End of the table that displays user data -->
            </div>
        </div>
    </div>
</div>
<!-- End of the container for the entire content -->

<script>
// Initialize DataTables plugin on all <table> elements, which adds features like sorting, pagination, etc.
$('table').dataTable();
// Bind a click event to the element with id 'new_user'.
// When the element is clicked, open a modal with the title 'New User' and load the content from 'manage_user.php'.
$('#new_user').click(function(){
    uni_modal('New User', 'manage_user.php')
})

// Bind a click event to all elements with class 'edit_user'.
// When an 'edit_user' element is clicked, open a modal with the title 'Edit User'.
// Load content from 'manage_user.php' and pass the 'data-id' of the clicked element as a query string parameter.
$('.edit_user').click(function(){
    uni_modal('Edit User', 'manage_user.php?id=' + $(this).attr('data-id'))
})

// Bind a click event to all elements with class 'delete_user'.
// When a 'delete_user' element is clicked, show a confirmation dialog (_conf).
// If confirmed, call the 'delete_user' function and pass the 'data-id' of the clicked element to it.
$('.delete_user').click(function(){
    _conf("Are you sure to delete this user?", "delete_user", [$(this).attr('data-id')])
})

// Function to handle deleting a user by their ID.
function delete_user($id){
    // Start loading indicator (likely shows a spinner or loading animation).
    start_load()
    
    // Send an AJAX POST request to 'ajax.php?action=delete_user' to delete the user with the given ID.
    $.ajax({
        url: 'ajax.php?action=delete_user',  // URL where the delete request is sent
        method: 'POST',                      // HTTP method used for the request
        data: { id: $id },                   // Data being sent in the request (user ID)
        
        // Success callback function that runs when the server responds.
        success: function(resp){
            // If the server responds with '1', indicating successful deletion:
            if(resp == 1){
                // Show a success message using 'alert_toast'.
                alert_toast("Data successfully deleted", 'success')
                
                // After a delay of 1.5 seconds, reload the page to reflect changes.
                setTimeout(function(){
                    location.reload()
                }, 1500)
            }
        }
    })
}

</script>