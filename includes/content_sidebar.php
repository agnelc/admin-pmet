<!-- Main sidebar -->
<div class="sidebar sidebar-main sidebar-fixed">
    <div class="sidebar-content">

        <!-- User menu -->
        <div class="sidebar-user">
            <div class="category-content">
                <div class="media">
                    <a href="#" class="media-left"><img src="assets/images/placeholder.jpg" class="img-circle img-sm" alt=""></a>
                    <div class="media-body">
                        <span class="media-heading text-semibold">AGNEL THOMAS</span>
                        <div class="text-size-mini text-muted">
                            <i class="icon-pin text-size-small"></i> &nbsp;Thrissur, INDIA
                        </div>
                    </div>

                    <div class="media-right media-middle">
                        <ul class="icons-list">
                            <li>
                                <a href="#"><i class="icon-cog3"></i></a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <!-- /user menu -->


        <!-- Main navigation -->
        <div class="sidebar-category sidebar-category-visible">
            <div class="category-content no-padding">
                <ul class="navigation navigation-main navigation-accordion">
                    
                    <li class="navigation-header"><span>MY Main</span> <i class="icon-menu" title="Main pages"></i></li>
                    <li><a  href="index.php"><i class="icon-home4"></i> <span>Dashboard</span></a></li>
                    <?php
                    $url = 'http://' . $_SERVER['SERVER_NAME'] . $_SERVER['REQUEST_URI'];
                    if(strpos($url,'new_user.php') !== false) {
                        echo "<li><a href=\"staff.php\"><i class=\"fa fa-arrow-circle-left\"></i><span>Return to Menu</span></a></li>";
                    }else{
                    ?>
                    <!-- Main -->
                    <li><a href="staff.php"><i class="icon-user-plus"></i> <span>Staff</span></a></li>
                    <li><a href="content.php"><i class="icon-insert-template"></i> <span>Manage Website Content</span></a></li>
                    <li><a href="new_user.php"><i class="icon-user-plus"></i> <span>Add Staff User</span></a></li>
                    <li><a href="logout.php"><i class="fa fa-sign-out"></i> <span>Logout</span></a></li>
                    <!-- /main -->
                    <?php
                        if (strpos($url,'index.php') !== false) {
                            public_navigation($sel_subject,$sel_page);
                        }
                        elseif (strpos($url,'new_page.php') !== false) {
                            navigation($sel_subject,$sel_page, $public = false);
                        }else {
                           navigation($sel_subject,$sel_page);
                        }
                        
                        echo "<li><a href=\"new_subject.php\"><i class=\"icon-file-plus\"></i><span>Add a new Subject</span></a></li>";
                    }
                    ?>
                </ul>
            </div>
        </div>
        <!-- /main navigation -->

    </div>
</div>
<!-- /main sidebar -->