<?php
include('includes/config.php');
if (!empty($_POST["deptid"])) {
    $id = intval($_POST['deptid']);
    if (!is_numeric($id)) {
        echo htmlentities("invalid department");
        exit;
    } else {
        $stmt = mysqli_query($bd, "SELECT department FROM department WHERE facultyid ='$id'");
?>
        <option selected="selected">Select Department </option>
        <?php
        while ($row = mysqli_fetch_array($stmt)) {
        ?>
            <option value="<?php echo htmlentities($row['department']); ?>"><?php echo htmlentities($row['department']); ?></option>
<?php
        }
    }
}
?>