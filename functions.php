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

function getListMeja(){
    $db=dbConnect();
    if($db->connect_errno==0){
        $res=$db->query("SELECT * FROM meja WHERE Status ='Kosong' ORDER BY no_meja");
        if($res){
            $data=$res->fetch_all(MYSQLI_ASSOC);
            $res->free();
            return $data;
        }
        else
            return FALSE;
    }
    else
        return FALSE;
}

function getListMenu(){
    $db=dbConnect();
    if($db->connect_errno==0){
        $res=$db->query("SELECT * 
						 FROM menu WHERE status = 'Tersedia'
						 ORDER BY nama_menu");
        if($res){
            $data=$res->fetch_all(MYSQLI_ASSOC);
            $res->free();
            return $data;
        }
        else
            return FALSE;
    }
    else
        return FALSE;
}

function getName($n) {
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $randomString = '';

    for ($i = 0; $i < $n; $i++) {
        $index = rand(0, strlen($characters) - 1);
        $randomString .= $characters[$index];
    }

    return $randomString;
}


?>