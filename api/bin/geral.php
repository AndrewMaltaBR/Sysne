<?php

	function connect() {
		$con = mysqli_connect("127.0.0.1","root","","sysne");
		return $con;
	}

	function fix($str) {
		return preg_replace('![*#/\"´`\']+!','',$str);
	}

	function date_convert($date,$type){
		if($date != null) {
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
		else
			return null;
	}

	function img_resize($target,$newcopy,$ext,$w=720,$h=480)
    {
        list($w_orig, $h_orig) = getimagesize($target);
        $scale_ratio = $w_orig / $h_orig;
        if (($w / $h) > $scale_ratio) {
               $w = $h * $scale_ratio;
        } else {
               $h = $w / $scale_ratio;
        }
        $img = "";
        $ext = strtolower($ext);
        if($ext =="png"){ 
            $img = imagecreatefrompng($target);
        } else { 
            $img = imagecreatefromjpeg($target);
        }
        $tci = imagecreatetruecolor($w, $h);
        // imagecopyresampled(dst_img, src_img, dst_x, dst_y, src_x, src_y, dst_w, dst_h, src_w, src_h)
        imagecopyresampled($tci, $img, 0, 0, 0, 0, $w, $h, $w_orig, $h_orig);
        imagejpeg($tci, $newcopy, 80);
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