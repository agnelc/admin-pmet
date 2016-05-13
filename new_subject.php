<?php require_once("includes/session.php"); ?>
<?php confirm_logged_in();  ?>
<?php require_once("includes/connection.php"); ?>
<?php require_once("includes/functions.php"); ?>
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
                                <form class="form-horizontal" action="create_subject.php" method="post">
                                    <div class="form-group">
                                        <label class="control-label col-lg-2">Subject name</label>
                                        <div class="col-lg-10">
                                            <input type="text" class="form-control" name="menu_name" value="" id ="menu_name" >
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
                                                    for($count=1;$count<=$subject_count+1;$count++){
                                                      echo "<option value=\"{$count}\">{$count}</option>";  
                                                    }
                                                ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="display-block col-lg-2">Visible</label>
                                        <div class="col-lg-10">
                                            <label class="radio-inline">
                                                <input type="radio" name="visible" class="styled" checked="checked" value="0">
                                                0
                                            </label>
                                            <label class="radio-inline">
                                                <input type="radio" name="visible" class="styled" value="1">
                                                1
                                            </label>
                                        </div>
                                    </div>
                                    <div class="text-right">
                                        <button type="submit" class="btn btn-primary" value="Add Subject">Add Subject<i class="icon-arrow-right14 position-right"></i></button>
                                    </div>
                                </form>
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
