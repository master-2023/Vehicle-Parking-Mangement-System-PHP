<!-- main page of category -->
<?php include('db_connect.php');?>

<div class="container-fluid"> <!-- A full-width container that adapts to the screen size. -->
    <div class="col-lg-12"> <!-- A Bootstrap column that spans the full width of the page on large screens (col-lg-12). -->
        
        <!-- Add Category Button -->
        <div class="row mb-4 mt-4"> <!-- A row to contain the "Add Category" button with margin-top and margin-bottom classes. -->
            <div class="col-md-12"> <!-- A column that spans the full width of the row on medium and larger screens. -->
                <button class="btn btn-primary btn-sm float-right" type="button" id="new_category"> <!-- A small, right-aligned button with a primary color. -->
                    <i class="fa fa-plus"></i> <!-- Font Awesome icon representing a plus sign. -->
                    Add Category <!-- Button text. -->
                </button>
            </div>
        </div>
        
        <div class="row"> <!-- A row to contain the table panel. -->
            <!-- Table Panel -->
            <div class="col-md-12"> <!-- A column that spans the full width of the row on medium and larger screens. -->
                <div class="card"> <!-- A Bootstrap card component to encapsulate the table. -->
                    <div class="card-body"> <!-- The main content area of the card. -->
                        <table class="table table-condensed table-hover"> <!-- A Bootstrap table with a condensed look and hover effect. -->
                            <thead> <!-- Table header section. -->
                                <tr> <!-- A row in the table header. -->
                                    <th class="text-center">#</th> <!-- Center-aligned header cell for serial numbers. -->
                                    <th>Category</th> <!-- Header cell for the Category column. -->
                                    <th>Rate per Hour</th> <!-- Header cell for the Rate per Hour column. -->
                                    <th class="text-center">Action</th> <!-- Center-aligned header cell for the Action column. -->
                                </tr>
                            </thead>

                            <tbody> <!-- Table body section. This is where the dynamic content will be inserted. -->
                                <?php 
                                $i = 1; // Initialize a counter variable for serial numbers.
                                $types = $conn->query("SELECT * FROM category ORDER BY id ASC"); // Execute a SQL query to select all rows from the 'category' table, ordered by 'id' in ascending order.
                                while($row = $types->fetch_assoc()): // Start a loop to fetch each row of data as an associative array.
                                ?>
                                <tr> <!-- Start a new table row for each category. -->
                                    <td class="text-center"><?php echo $i++ ?></td> <!-- Display the serial number and increment it for each row. -->
                                    <td> <!-- Table cell for the Category name. -->
                                        <p><b><?php echo $row['name'] ?></b></p> <!-- Display the category name in bold. -->
                                    </td>
                                    <td> <!-- Table cell for the Rate per Hour. -->
                                        <p><b><?php echo number_format($row['rate'], 2) ?></b></p> <!-- Display the rate formatted to two decimal places in bold. -->
                                    </td>
                                    <td class="text-center"> <!-- Center-aligned cell for action buttons. -->
                                        <button class="btn btn-sm btn-outline-primary edit_category" type="button" data-id="<?php echo $row['id'] ?>">Edit</button> <!-- Button to edit the category, with a data-id attribute to store the category ID. -->
                                        <button class="btn btn-sm btn-outline-danger delete_category" type="button" data-id="<?php echo $row['id'] ?>">Delete</button> <!-- Button to delete the category, with a data-id attribute to store the category ID. -->
                                    </td>
                                </tr>
                                <?php endwhile; ?> <!-- End the PHP while loop. -->
                            </tbody> <!-- End of the table body section. -->
                        </table> <!-- End of the table. -->
                    </div> <!-- End of the card-body. -->
                </div> <!-- End of the card. -->
            </div> <!-- End of the table panel column. -->
            <!-- Table Panel -->
        </div> <!-- End of the row containing the table panel. -->
    </div> <!-- End of the main column that contains all content. -->
</div> <!-- End of the full-width container. -->

<style>
td {
    vertical-align: middle !important; /* Ensures that the content inside all table cells (td) is vertically aligned to the middle. The !important flag overrides any other conflicting styles. */
}

td p {
    margin: unset; /* Removes any margin from <p> elements inside table cells (td). The "unset" value resets the margin to its initial or inherited value, which is typically 0. */
}
</style>

<script>
    // #new category is a Jquery code Event listener for the "Add Category" button
    $('#new_category').click(function() {
        // Opens a modal with the title "New Vehicle Category" and loads the content from "manage_category.php"
        uni_modal("New Vehicle Category", "manage_category.php");
    });

    // Event listener for the "Edit Category" button
    $('.edit_category').click(function() {
        // Opens a modal with the title "Edit Vehicle Category" and loads the content from "manage_category.php"
        // Passes the ID of the selected category (using the data-id attribute) to the PHP script
        uni_modal("Edit Vehicle Category", "manage_category.php?id=" + $(this).attr('data-id'));
    });

    // Event listener for the "Delete Category" button
    $('.delete_category').click(function() {
        // Calls a custom confirmation function to confirm deletion
        // If confirmed, calls the delete_category function with the selected category ID
        _conf("Are you sure to delete this category?", "delete_category", [$(this).attr('data-id')]);
    });

    // Function to delete a category
    function delete_category($id) {
        // Starts a loading animation or process indicator
        start_load();
        
        // AJAX request to delete the category from the server
        $.ajax({
            url: 'ajax.php?action=delete_category', // The URL of the server-side script to handle the deletion
            method: 'POST', // The HTTP method used for the request
            data: { id: $id }, // Data sent to the server (category ID)
            success: function(resp) { // Callback function executed when the request succeeds
                if (resp == 1) { // Checks if the response indicates a successful deletion
                    // Displays a success message to the user
                    alert_toast("Data successfully deleted", 'success');
                    // Reloads the page after 1.5 seconds to reflect the changes
                    setTimeout(function() {
                        location.reload();
                    }, 1500);
                }
            }
        });
    }
</script>
