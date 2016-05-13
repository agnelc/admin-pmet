<?php // this page is included by new_page.php and edit_page.php   ?>
<?php
if (!isset($new_page)) {
    $new_page = false;
}
?>
<div class="form-group">
    <label class="control-label col-lg-2">Page name</label>
    <div class="col-lg-10">
        <input type="text" class="form-control" name="menu_name" value="<?php echo $sel_page['menu_name']; ?>" id ="menu_name" >
    </div>
</div>
<div class="form-group">
    <label class="control-label col-lg-2">Position</label>
    <div class="col-lg-10">
        <select name="position" class="form-control">
            <?php
            if (!$new_page) {
                $page_set = get_pages_for_subject($sel_page['subject_id']);
                $page_count = mysqli_num_rows($page_set);
            } else {
                $page_set = get_pages_for_subject($sel_subject['id']);
                $page_count = mysqli_num_rows($page_set) + 1;
            }
            for ($count = 1; $count <= $page_count; $count++) {
                echo "<option value=\"{$count}\"";
                if ($sel_page['position'] == $count) {
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
            if ($sel_page['visible'] == 0) {
                echo " checked";
            }
            ?>
                   >
            No
        </label>
        <label class="radio-inline">
            <input type="radio" name="visible" class="styled" value="1"
            <?php
            if ($sel_page['visible'] == 1) {
                echo " checked";
            }
            ?>  
                   >
            Yes
        </label>
    </div>
</div>

<textarea class="ckeditor" name="content" id="content" rows="4" cols="4">
<?php echo $sel_page['content']; ?>
</textarea>



