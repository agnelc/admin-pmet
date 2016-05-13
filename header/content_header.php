<!-- Page header -->
<div class="page-header">
    <div class="page-header-content">
        <div class="page-title">
            <h3> <span class="text-semibold">
                    <?php 
                    if (isset($sel_subject['menu_name'])) {
                        echo $sel_subject['menu_name']; 
                        } 
                   else if (isset($subname['subname'])) {
                        echo $subname['subname']; 
                        } 
                    else{
                        $url = 'http://' . $_SERVER['SERVER_NAME'] . $_SERVER['REQUEST_URI'];
                        if (strpos($url,'content.php') !== false) {
                            echo "Select a subject or page to view"; 
                        }
                        else if (strpos($url,'new_subject.php') !== false){
                            echo "Add Subject"; 
                        }
                        else if (strpos($url,'edit_subject.php') !== false){
                            echo "Edit Subject"; 
                        }
                    }
                        ?>
                </span>
                <?php 
                if (isset($subname['subname'])) {
                    echo " - " . $sel_page['menu_name']; 
                } 
                ?>
            </h3>
        </div>


    </div>

    <div class="breadcrumb-line">
        <ul class="breadcrumb">
            <li>
            <?php
            global $url;
                if (isset($sel_subject['menu_name'])) {
                    echo "<a href=\"content.php?subj=" . urlencode($sel_subject['id']) . "\">";
                    if (strpos($url,'edit_subject.php') !== false){
                    
                    echo "<i class=\"icon-file-plus\"></i>";
                    echo "<span>&nbsp;&nbsp;Edit Subject:{$sel_subject['menu_name']}</span></a>";
                }
                else{
                    echo "<i class=\"{$sel_subject['icon_class']}\"></i> \t";
                    echo "<span>&nbsp;&nbsp; {$sel_subject['menu_name']}</span></a>";
                }
                }
                if (isset($subname['subname'])) {
                    echo "<a href=\"content.php?subj=" . urlencode($subname['subject_id']) . "\">";
                    echo "<i class=\"{$subname['subico']}\"></i>";
                    echo "<span>&nbsp;&nbsp; {$subname['subname']}</span></a>";
                }
                else if (strpos($url,'new_subject.php') !== false){
                    echo "<a href=\"#\">";
                    echo "<i class=\"icon-file-plus\"></i>";
                    echo "<span>&nbsp;&nbsp;Add Subject</span></a>";
                }
            ?>
            </li>
            
            <?php
                if (isset($sel_page['menu_name'])) {
                    echo "<li class=\"active\"";
                    echo "><a href=\"content.php?page=" . urlencode($sel_page['id']) . "\">";
                    echo "<span>{$sel_page["menu_name"]}</span></a></li>";
                }
            ?>
        </ul>


    </div>
</div>
<!-- /page header -->
