<?php require_once("includes/session.php"); ?>
<?php confirm_logged_in();  ?>
<?php require_once("includes/connection.php"); ?>
<?php require_once("includes/functions.php"); ?>
<?php
	// make sure the subject id sent is an integer
	if (intval($_GET['page']) == 0) {
		redirect_to('content.php');
	}

	include_once("includes/form_functions.php");
        global $connection;
	// START FORM PROCESSING
	// only execute the form processing if the form has been submitted
	if (isset($_POST['submit'])) {
		// initialize an array to hold our errors
		$errors = array();
	
		// perform validations on the form data
		$required_fields = array('menu_name', 'position', 'visible', 'content');
		$errors = array_merge($errors, check_required_fields($required_fields));
		
		$fields_with_lengths = array('menu_name' => 30);
		$errors = array_merge($errors, check_max_field_lengths($fields_with_lengths));
		
		// clean up the form data before putting it in the database
		$id = mysql_prep($_GET['page']);
		$menu_name = trim(mysql_prep($_POST['menu_name']));
		$position = mysql_prep($_POST['position']);
		$visible = mysql_prep($_POST['visible']);
		$content = mysql_prep($_POST['content']);
	
		// Database submission only proceeds if there were NO errors.
		if (empty($errors)) {
			$query = 	"UPDATE pages SET 
							menu_name = '{$menu_name}',
							position = {$position}, 
							visible = {$visible},
							content = '{$content}'
						WHERE id = {$id}";
			$result = mysqli_query($connection,$query);
			// test to see if the update occurred
			if (mysqli_affected_rows($connection) == 1 ) {
				// Success!
				$message = "The page was successfully updated.";
			} else {
				$message = "The page could not be updated.";
				$message .= "<br />" . mysqli_error($connection);
			}
		} else {
			if (count($errors) == 1) {
				$message = "There was 1 error in the form.";
			} else {
				$message = "There were " . count($errors) . " errors in the form.";
			}
		}
		// END FORM PROCESSING
	}
?>
<?php find_selected_page(); ?>
<?php include("includes/header.php"); ?>
<!-- Page container -->
<div class="page-container">

    <!-- Page content -->
    <div class="page-content">

        <?php include("includes/content_sidebar.php"); ?>

        <!-- Main content -->
        <div class="content-wrapper">
            <?php include("header/content_header.php"); ?>

            <!-- Content area -->
            <div class="content">
                <div class="row">
                    <div class="col-md-12 col-sm-12">
                        <div class="panel panel-flat">
                            <div class="panel-heading">
                                <h2 class="panel-title">
                                   <h2>Edit page: <?php echo $sel_page['menu_name']; ?></h2>
			<?php if (!empty($message)) {echo "<p class=\"message\">" . $message . "</p>";} ?>
			<?php if (!empty($errors)) { display_errors($errors); } ?>
			
                                </h2>
                                <div class="heading-elements">
                                    <ul class="icons-list">
                                        <li><a data-action="collapse"></a></li>
                                        <li><a data-action="reload"></a></li>
                                        <li><a href="content.php"><i class="fa fa-times"></i></a></li>
                                    </ul>
                                </div>

                            </div>
                            <div class="panel-body">
                                <form class="form-horizontal" action="edit_page.php?page=<?php echo urlencode($sel_page['id']); ?>" method="post">
                                   
                                    
                                    <?php include "page_form.php" ?>
                                    
                                <br />
                                    <div class="text-right">
                                        
                                        <a href="delete_page.php?page=<?php echo urlencode($sel_page['id']); ?>" onclick="return confirm('Are you sure you want to delete this page?');" class="btn btn-danger" value="Delete page">Delete page<i class="icon-cancel-square2 position-right"></i></a>
                                    
                                        <button type="submit" name="submit" class="btn btn-primary" value="Update Page">Update Page<i class="icon-arrow-right14 position-right"></i></button>
                                    </div>
                                   
                                </form>
                                <br />
                                <a href="content.php?page=<?php echo $sel_page['id']; ?>">Cancel</a>
                            </div>


                        </div>
                        <!-- /panel area -->

                    </div>

                </div>
                <!-- /row area -->

                <?php require("includes/footer.php"); ?>

            </div>
            <!-- /content area -->

        </div>
        <!-- /main content -->

    </div>
    <!-- /page content -->

</div>
<!-- /page container -->

</body>
</html>


