<?php require_once("includes/session.php"); ?>
<?php require_once("includes/connection.php"); ?>
<?php require_once("includes/functions.php"); ?>
<?php find_selected_page(); ?>
<?php confirm_logged_in();  ?>
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
                                <h2 class="panel-title">Staff Menu</h2>
                                
                            </div>
                            <div class="panel-body">
                                
                            <p>Welcome to staff Area.<?php echo $_SESSION['username']; ?></p>
                                <ul>
                                   <li><a href="content.php"><i class="icon-insert-template"></i> <span>Manage Website Content</span></a></li>
								<li><a href="new_user.php"><i class="icon-user-plus"></i> <span>Add Staff User</span></a></li>
								
								<li><a href="logout.php"><i class="fa fa-sign-out"></i> <span>Logout</span></a></li>
								
                            </ul>
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
