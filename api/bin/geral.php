<?php

	function connect() {
		$con = mysqli_connect("127.0.0.1","root","","sysne");
		return $con;
	}

	function fix($str) {
		return preg_replace('![*#/\"´`\']+!','',$str);
	}

	function date_convert($date,$type){
		if($type)
		{
			$array = explode(" ",$date);
			$date = explode("/",$array[0]);
			return $date[2]."-".$date[1]."-".$date[0]." ".$array[1].":00";
		}
		else
		{
			$array = explode(" ",$date);
			$date = explode("-",$array[0]);
			$time = explode(":",$array[1]);
			return $date[2]."/".$date[1]."/".$date[0]." ".$time[0].":".$time[1];
		}
	}

	function select_planos() {
		$return = array();

		$con = connect();
		if($con) {
			$query = $con->query("SELECT * FROM plano");
			while($row = $query->fetch_assoc()) {
				$return[] = $row;
			}
			$con->close();
		}
		return json_encode($return);
	}

?>