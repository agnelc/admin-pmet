<?php require_once("includes/session.php"); ?>
<?php confirm_logged_in();  ?>
<?php require_once("includes/connection.php"); ?>
<?php require_once("includes/functions.php"); ?>
<?php
include_once("includes/form_functions.php");

// START FORM PROCESSING
if (isset($_POST['submit'])) { // Form has been submitted.
    
                $errors = array();

		// perform validations on the form data
		$required_fields = array('username', 'password');
		$errors = array_merge($errors, check_required_fields($required_fields, $_POST));

		$fields_with_lengths = array('username' => 30, 'password' => 30);
		$errors = array_merge($errors, check_max_field_lengths($fields_with_lengths, $_POST));

		$username = trim(mysql_prep($_POST['username']));
		$password = trim(mysql_prep($_POST['password']));
		$hashed_password = sha1($password);

		if ( empty($errors) ) {
			$query = "INSERT INTO users (
							username, hashed_password
						) VALUES (
							'{$username}', '{$hashed_password}'
						)";
			$result = mysqli_query($connection,$query);
			if ($result) {
				$message = "The user was successfully created.";
			} else {
				$message = "The user could not be created.";
				$message .= "<br />" . mysqli_error();
			}
		} else {
			if (count($errors) == 1) {
				$message = "There was 1 error in the form.";
			} else {
				$message = "There were " . count($errors) . " errors in the form.";
			}
		}
	} else { // Form has not been submitted.
		$username = "";
		$password = "";
	}
?>
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
                                <h2 class="panel-title">Create New User</h2>
                                <?php
                                if (!empty($message)) {
                                    echo "<p class=\"message\">" . $message . "</p>";
                                }
                                ?>
                                <?php
                                if (!empty($errors)) {
                                    display_errors($errors);
                                }
                                ?>

                            </div>
                            <div class="panel-body">

                                <form action="new_user.php" method="post">
                                    <div class="panel panel-body">
                                        <div class="form-group">
                                            <input type="text" name="username" maxlength="30" value="<?php echo htmlentities($username); ?>"  class="form-control" placeholder="Username">
                                            
                                        </div>

                                        <div class="form-group">
                                            <input type="password" name="password" maxlength="30" value="<?php echo htmlentities($password); ?>"  class="form-control" placeholder="Password">
                                            
                                        </div>

                                        <div class="form-group">
                                            <button type="submit" name="submit" value="Create user" class="btn btn-primary btn-block">Create user <i class="icon-circle-right2 position-right"></i></button>
                                        </div>
                                    </div>

                                </form>
                            </div>


                        </div>
                    </div>

                </div>
<?php include("includes/footer.php"); ?>

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

