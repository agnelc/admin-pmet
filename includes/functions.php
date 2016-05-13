<?php

function mysql_prep($value) {
    global $connection;
		$magic_quotes_active = get_magic_quotes_gpc();
		$new_enough_php = function_exists( "mysqli_real_escape_string" ); // i.e. PHP >= v4.3.0
		if( $new_enough_php ) { // PHP v4.3.0 or higher
			// undo any magic quote effects so mysql_real_escape_string can do the work
			if( $magic_quotes_active ) 
                            { $value = stripslashes($value); }
			$value = mysqli_real_escape_string($connection,$value);
		} else { // before PHP v4.3.0
			// if magic quotes aren't already on then add slashes manually
			if( !$magic_quotes_active ) { $value = addslashes( $value ); }
			// if magic quotes are active, then the slashes already exist
		}
		return $value;
	}

function redirect_to($location = NULL){
    if($location!=NULL){
        header("Location:{$location}");
        exit();
    }
}


function confirm_query($result_set) {
    if (!$result_set) {
        die("Database query failed: " . mysqli_error());
    }
}

function get_all_subjects($public = true) {

    global $connection;
    $query = "SELECT * ";
    $query .= " FROM `subjects` ";
    if($public){
        $query .= " WHERE `visible` = 1 ";
    }
    $query .= " ORDER BY `subjects`.`position` ASC";
    $subject_set = mysqli_query($connection, $query);
    confirm_query($subject_set);
    return $subject_set;
}

function get_pages_for_subject($subject_id,$public = true) {

    global $connection;
    $query = "SELECT * ";
    $query .= "FROM `pages` ";
    $query .= "WHERE `pages`.`subject_id` = {$subject_id} ";
    if($public){
        $query .= " AND `visible` = 1 ";
    }
    $query .= "ORDER BY `pages`.`position` ASC";
    $page_set = mysqli_query($connection, $query);
    confirm_query($page_set);
    return $page_set;
}

function get_subject_by_id($subject_id) {

    global $connection;
    $query = "SELECT * ";
    $query .= "FROM `subjects` ";
    $query .= "WHERE id = {$subject_id} ";
    $query .= "LIMIT 1";
    $result_set = mysqli_query($connection, $query);
    confirm_query($result_set);
    $subject = mysqli_fetch_array($result_set);
    if ($subject) {
        return $subject;
    } else {
        return NULL;
    }
}

function get_page_by_id($page_id) {

    global $connection;
    $query = "SELECT * ";
    $query .= "FROM pages ";
    $query .= "WHERE id = {$page_id} ";
    $query .= "LIMIT 1 ";
    $result_set = mysqli_query($connection, $query);
    confirm_query($result_set);
    $page = mysqli_fetch_array($result_set);
    if ($page) {
        return $page;
    } else {
        return NULL;
    }
}

function get_subject_name_from_page_id($page_id) {

    global $connection;
    $query = "SELECT *,subjects.icon_class as subico,subjects.menu_name as subname ";
    $query .= "FROM pages,subjects ";
    $query .= "WHERE pages.id = {$page_id} ";
    $query .= "AND pages.subject_id = subjects.id ";
    $query .= "LIMIT 1 ";
    $result_set = mysqli_query($connection, $query);
    confirm_query($result_set);
    if ($subname = mysqli_fetch_array($result_set)) {
        return $subname;
    } else {
        return NULL;
    }
}

function get_default_page($subject_id){
    //Get all visible pages
    $page_set = get_pages_for_subject($subject_id, true);
    $first_page = mysqli_fetch_array($page_set);
    if($first_page != NULL){
        return $first_page;
    }else{
        return NULL;
    }
    
}

function find_selected_page() {
    global $sel_page;
    global $sel_subject;
    global $subname;

    if (isset($_GET['subj'])) {
        $sel_subject = get_subject_by_id($_GET['subj']);
        $sel_page = get_default_page($sel_subject['id']);
    } elseif (isset($_GET['page'])) {
        $sel_subject = NULL;
        $sel_page = get_page_by_id($_GET['page']);
        $subname = get_subject_name_from_page_id($_GET['page']);
    } else {
        $sel_subject = NULL;
        $sel_page = NULL;
        $subname = NULL;
    }
}

function navigation($sel_subject,$sel_page,$public = FALSE) {
    
    $subject_set = get_all_subjects($public);
    while ($subject = mysqli_fetch_array($subject_set)) {

        echo "<li";
        if ($subject['id'] == $sel_subject['id']) {
            echo " class=\"active\"";
        }
        echo "><a href=\"content.php?subj=" . urlencode($subject['id']) . "\">";
        echo "<i class=\"{$subject['icon_class']}\"></i> ";
        echo "<span>{$subject["menu_name"]}</span></a>";

        $page_set = get_pages_for_subject($subject["id"],$public);

        if (mysqli_num_rows($page_set) > 0) {
            echo "<ul>";
            while ($page = mysqli_fetch_array($page_set)) {
                echo "<li";
                if ($page['id'] == $sel_page['id']) {
                    echo " class=\"active\"";
                }
                echo "><a href=\"content.php?page=" . urlencode($page['id']) . "\">";
                echo "<i class=\"{$page['icon_class']}\"></i> ";
                echo "<span>{$page["menu_name"]}</span></a></li>";
            }
            echo "</ul>";
        }
        echo "</li>";
    }
}

function public_navigation($sel_subject, $sel_page,$public = TRUE) {
		
	$subject_set = get_all_subjects($public);
    while ($subject = mysqli_fetch_array($subject_set)) {

        echo "<li";
        if ($subject['id'] == $sel_subject['id']) {
            echo " class=\"active\"";
        }
        echo "><a href=\"index.php?subj=" . urlencode($subject['id']) . "\">";
        echo "<i class=\"{$subject['icon_class']}\"></i> ";
        echo "<span>{$subject["menu_name"]}</span></a>";

        $page_set = get_pages_for_subject($subject["id"],$public);

        if (mysqli_num_rows($page_set) > 0) {
            echo "<ul>";
            while ($page = mysqli_fetch_array($page_set)) {
                echo "<li";
                if ($page['id'] == $sel_page['id']) {
                    echo " class=\"active\"";
                }
                echo "><a href=\"index.php?page=" . urlencode($page['id']) . "\">";
                echo "<i class=\"{$page['icon_class']}\"></i> ";
                echo "<span>{$page["menu_name"]}</span></a></li>";
            }
            echo "</ul>";
        }
        echo "</li>";
    }
	}

?>
