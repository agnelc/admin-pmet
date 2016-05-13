<?php require_once("includes/session.php"); ?>
<?php confirm_logged_in();  ?>
<?php require_once("includes/connection.php"); ?>
<?php require_once("includes/functions.php"); ?>
<?php
if (intval($_GET['subj']) == 0) {
    redirect_to('content.php');
}
global $connection;
if (isset($_POST['submit'])) {
    $errors = array();

//Form Validation
    $required_fields = array('menu_name', 'position', 'visible');
    foreach ($required_fields as $fieldname) {
        if (!isset($_POST[$fieldname]) || ((empty($_POST[$fieldname])) && ($_POST[$fieldname] != 0))) {
            $errors[] = $fieldname;
        }
    }

    $fields_with_lengths = array('menu_name' => 30);
    foreach ($fields_with_lengths as $fieldname => $maxlength) {
        if (strlen(trim(mysql_prep($_POST[$fieldname]))) > $maxlength) {
            $errors[] = $fieldname;
        }
    }

    if (empty($errors)) {
        // Perform Update
        $id = mysql_prep($_GET['subj']);
        $menu_name = mysql_prep($_POST['menu_name']);
        $position = mysql_prep($_POST['position']);
        $visible = mysql_prep($_POST['visible']);

        $query = "UPDATE subjects SET 
                menu_name = '{$menu_name}', 
                position = {$position}, 
                visible = {$visible} 
                WHERE id = {$id}";
        $result = mysqli_query($connection, $query);
        if (mysqli_affected_rows($connection) == 1) {
            // Success
            $message = "The subject was successfully updated.";
        } else {
            // Failed
            $message = "The subject update failed.";
            $message .= "<br/>" . mysqli_error($connection);
        }
    } else {
        // Errors occurred
        $message = "There were " . count($errors) . " errors in the form.";
    }
}// end: if (isset($_POST['submit']))
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
                                    <?php
                                    if (!empty($message)) {

                                        echo "<p class=\"message\">" . $message . "</p>";
                                    }
                                    // output a list of the fields that had errors
                                    if (!empty($errors)) {
                                        echo "<p class=\"errors\">";
                                        echo "Please review the following fields:<br />";
                                        foreach ($errors as $error) {
                                            echo " - " . $error . "<br />";
                                        }
                                        echo "</p>";
                                    }
                                    ?>
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
                                <form class="form-horizontal" action="edit_subject.php?subj=<?php echo urlencode($sel_subject['id']); ?>" method="post">
                                    <div class="form-group">
                                        <label class="control-label col-lg-2">Subject name</label>
                                        <div class="col-lg-10">
                                            <input type="text" class="form-control" name="menu_name" value="<?php echo $sel_subject['menu_name']; ?>" id ="menu_name" >
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label col-lg-2">Position</label>
                                        <div class="col-lg-10">
                                            <select name="position" class="form-control">
                                                <?php
                                                $subject_set = get_all_subjects();
                                                $subject_count = mysqli_num_rows($subject_set);
                                                //$subject_count+1 because we are adding a subject
                                                for ($count = 1; $count <= $subject_count + 1; $count++) {
                                                    echo "<option value=\"{$count}\"";
                                                    if ($sel_subject['position'] == $count) {
                                                        echo " selected";
                                                    }
                                                    echo ">{$count}</option>";
                                                }
                                                ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="display-block col-lg-2">Visible</label>
                                        <div class="col-lg-10">
                                            <label class="radio-inline">
                                                <input type="radio" name="visible" class="styled" value="0"
                                                <?php
                                                if ($sel_subject['visible'] == 0) {
                                                    echo " checked";
                                                }
                                                ?>
                                                       >
                                                No
                                            </label>
                                            <label class="radio-inline">
                                                <input type="radio" name="visible" class="styled" value="1"
                                                <?php
                                                if ($sel_subject['visible'] == 1) {
                                                    echo " checked";
                                                }
                                                ?>  
                                                       >
                                                Yes
                                            </label>
                                        </div>
                                    </div>
                                    <div class="text-right">
                                        
                                        <a href="delete_subject.php?subj=<?php echo urlencode($sel_subject['id']); ?>" onclick="return confirm('Are you sure?');" class="btn btn-danger" value="Delete Subject">Delete Subject<i class="icon-cancel-square2 position-right"></i></a>
                                    
                                        <button type="submit" name="submit" class="btn btn-primary" value="Update Subject">Update Subject<i class="icon-arrow-right14 position-right"></i></button>
                                    </div>
                                   
                                </form>
                                <br />
                                <a href="content.php?subj=<?php echo $sel_subject['id']; ?>">Cancel</a>
                            </div>
                              	<div style="margin-top: 2em; border-top: 1px solid #000000;">
				<h3>Pages in this subject:</h3>
				<ul>
<?php 
	$subject_pages = get_pages_for_subject($sel_subject['id']);
	while($page = mysqli_fetch_array($subject_pages)) {
		echo "<li><a href=\"content.php?page={$page['id']}\">
		{$page['menu_name']}</a></li>";
	}
?>
				</ul>
				<br />
				+ <a href="new_page.php?subj=<?php echo $sel_subject['id']; ?>">Add a new page to this subject</a>
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
