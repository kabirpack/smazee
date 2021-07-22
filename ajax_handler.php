<?php

include_once('db.php');


if(isset($_POST['filefrom']))
{
    if($_POST['filefrom']  == "MAIN"){
		$name=$_POST['name'];
		$phone=$_POST['phone'];
        $data_time=$_POST['date_time'];
        $datetime=date_create_from_format('m/d/Y H:i A',$data_time);
        $newdate = date("Y-m-d H:i", $datetime->getTimestamp());
		$sql="INSERT INTO `contacts` (`id`, `name`, `phone`, `date`) 
		VALUES (NULL, '$name', '$phone', '$newdate');";
        $response=$con->query($sql);
        echo $response;
    }

}
?>