<?php
define("DEVELOPMENT",TRUE);
function dbConnect(){
	$db=new mysqli("localhost","root","","db_resto_broto");
	return $db;
}
function showError($message){
	?>
<div style="background-color:#FAEBD7;padding:10px;border:1px solid red;margin:15px 0px">
<?php echo $message;?>
</div>
	<?php
}
?>