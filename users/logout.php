<?php
session_start();
include("includes/config.php");
$_SESSION['login']=="";
date_default_timezone_set('Africa/Lagos');
$ldate=date( 'd-m-Y h:i:s A', time () );
mysqli_query($bd, "UPDATE userlog  SET logout = '$ldate' WHERE matricNo = '".$_SESSION['login']."' ORDER BY id DESC LIMIT 1");
session_unset();

?>
<script language="javascript">
document.location="./";
</script>