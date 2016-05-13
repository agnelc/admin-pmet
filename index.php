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
                                    <?php
                                    
                                    $url = 'http://' . $_SERVER['SERVER_NAME'] . $_SERVER['REQUEST_URI'];
                                    if (!is_null($sel_page)) {
                                        echo htmlentities($sel_page['menu_name']);
                                    }
                                    else{
                                        echo"Welcome to Widget Corp";
                                    }
                                    ?></h2>

                            </div>
                            <div class="panel-body">
                                <?php
                                
                                if (strpos($url, 'page') !== false) {
                                    
                                    echo strip_tags(nl2br($sel_page['content']),"<b><br><p><a>");
                                 }
                                ?>   
                                <br />
                                
                               
                                    

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
