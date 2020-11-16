<?php
include ("../db/db_connect.php");
if(isset($_POST['preparation_a'])) {
	$preparation_a_id = $_POST['preparation_a'];
	$query111 = "select selling_price,cost_price from eti_equipment where id = '$preparation_a_id'";
	$exec111 = mysql_query($query111) or die ("Error in Query111".mysql_error());
	$res111 = mysql_fetch_array($exec111);
	echo json_encode($res111,true);
}
if(isset($_POST['preparation_b'])) {
	$preparation_b_id = $_POST['preparation_b'];
	$query111 = "select selling_price,cost_price from eti_equipment where id = '$preparation_b_id'";
	$exec111 = mysql_query($query111) or die ("Error in Query111".mysql_error());
	$res111 = mysql_fetch_array($exec111);
	echo json_encode($res111,true);
}
if(isset($_POST['preparation_c'])) {
	$preparation_c_id = $_POST['preparation_c'];
	$query111 = "select selling_price,cost_price from eti_equipment where id = '$preparation_c_id'";
	$exec111 = mysql_query($query111) or die ("Error in Query111".mysql_error());
	$res111 = mysql_fetch_array($exec111);
	echo json_encode($res111,true);
}
if(isset($_POST['preparation_d'])) {
	$preparation_d_id = $_POST['preparation_d'];
	$query111 = "select selling_price,cost_price from eti_equipment where id = '$preparation_d_id'";
	$exec111 = mysql_query($query111) or die ("Error in Query111".mysql_error());
	$res111 = mysql_fetch_array($exec111);
	echo json_encode($res111,true);
}
if(isset($_POST['preparation_e'])) {
	$preparation_e_id = $_POST['preparation_e'];
	$query111 = "select selling_price,cost_price from eti_equipment where id = '$preparation_e_id'";
	$exec111 = mysql_query($query111) or die ("Error in Query111".mysql_error());
	$res111 = mysql_fetch_array($exec111);
	echo json_encode($res111,true);
}
if(isset($_POST['preparation_f'])) {
	$preparation_f_id = $_POST['preparation_f'];
	$query111 = "select selling_price,cost_price from eti_equipment where id = '$preparation_f_id'";
	$exec111 = mysql_query($query111) or die ("Error in Query111".mysql_error());
	$res111 = mysql_fetch_array($exec111);
	echo json_encode($res111,true);
}
if(isset($_POST['preparation_g'])) {
	$preparation_g_id = $_POST['preparation_g'];
	$query111 = "select selling_price,cost_price from eti_equipment where id = '$preparation_g_id'";
	$exec111 = mysql_query($query111) or die ("Error in Query111".mysql_error());
	$res111 = mysql_fetch_array($exec111);
	echo json_encode($res111,true);
}
if(isset($_POST['preparation_h'])) {
	$preparation_h_id = $_POST['preparation_h'];
	$query111 = "select selling_price,cost_price from eti_equipment where id = '$preparation_h_id'";
	$exec111 = mysql_query($query111) or die ("Error in Query111".mysql_error());
	$res111 = mysql_fetch_array($exec111);
	echo json_encode($res111,true);
}
if(isset($_POST['sra'])) {
	$sra = $_POST['sra'];
	$query111 = "select * from eti_sra where sra = '$sra'";
	$exec111 = mysql_query($query111) or die ("Error in Query111".mysql_error());
	$res111 = mysql_num_rows($exec111);
	if($res111>0){
		echo "SRA Number Already Exist";
	} else {
		echo "OK";
	}
	exit();
}

if(isset($_POST['prospect_no'])) {
	$prospect_no = $_POST['prospect_no'];
	$query1111 = "select * from eti_sra where prospect_no = '$prospect_no'";
	$exec1111 = mysql_query($query1111) or die ("Error in Query1111".mysql_error());
	$res1111 = mysql_num_rows($exec1111);
	if($res1111>0){
		echo "Prospect Number Already Exist";
	} else {
		echo "OK";
	}
	exit();
}

if(isset($_POST['cancel_id'])) {
	$cancel_id = $_POST['cancel_id'];
	$query111 = "select * from eti_sra where id = '$cancel_id' and form_status = 3";
	$exec111 = mysql_query($query111) or die ("Error in Query111".mysql_error());
	$res111 = mysql_num_rows($exec111);
	if($res111== 1){
		echo "ETI Already Cancelled!!!";
	} else {
		$query222 = "update eti_sra set form_status = 3 where id = '$cancel_id'";
		$exec222 = mysql_query($query222) or die ("Error in Query222".mysql_error());
		echo "ETI Cancelled Successfully!!!";
	}
	exit();
}
if(isset($_POST['surveyor_id'])) {
	$surveyor_id = $_POST['surveyor_id'];
	$query111 = "select employee_id from eti_surveyor where id = '$surveyor_id'";
	$exec111 = mysql_query($query111) or die ("Error in Query111".mysql_error());
	$res111 = mysql_fetch_array($exec111);
	echo json_encode($res111,true);
}
if(isset($_POST['industry_id'])) {
	$industry_id = $_POST['industry_id'];
	$query111 = "select industry_code from eti_industry where id = '$industry_id'";
	$exec111 = mysql_query($query111) or die ("Error in Query111".mysql_error());
	$res111 = mysql_fetch_array($exec111);
	echo json_encode($res111,true);
}
if(isset($_POST['business_id'])) {
	$business_id = $_POST['business_id'];
	$query111 = "select business_code,business_detail_code from eti_business where id = '$business_id'";
	$exec111 = mysql_query($query111) or die ("Error in Query111".mysql_error());
	$res111 = mysql_fetch_array($exec111);
	echo json_encode($res111,true);
}

if(isset($_POST['job_type'])) {
	$job_type = $_POST['job_type'];
	if ($job_type == 'Contract') {
		$query111 = "select visit_frequency from eti_visit where code = 1 and deleted = 0";
		$exec111 = mysql_query($query111) or die ("Error in Query111".mysql_error());
		echo "<option value=''>Visit</option>";
		while ($res111 = mysql_fetch_array($exec111)){
			$visit_frequency = $res111['visit_frequency'];
			 echo "<option value='".$visit_frequency."'>".$visit_frequency."</option>";
		}
	} else {
		$query111 = "select visit_frequency from eti_visit where code = 2 and deleted = 0";
		$exec111 = mysql_query($query111) or die ("Error in Query111".mysql_error());
		echo "<option value=''>Visit</option>";
		while ($res111 = mysql_fetch_array($exec111)){
			$visit_frequency = $res111['visit_frequency'];
			 echo "<option value='".$visit_frequency."'>".$visit_frequency."</option>";
		}
	}
}

if(isset($_POST['job_type_a'])) {
	$job_type_a = $_POST['job_type_a'];
	if ($job_type_a == 'Job') {
		$query111 = "select job_duration from eti_job_duration where deleted = 0";
		$exec111 = mysql_query($query111) or die ("Error in Query111".mysql_error());
		echo "<option value=''>Please Choose Job Duration</option>";
		while ($res111 = mysql_fetch_array($exec111)){
			$job_duration = $res111['job_duration'];
			 echo "<option value='".$job_duration."'>".$job_duration."</option>";
		}
	} else {
		echo "<option value=''>Please Choose Job Duration</option>";
	}
}
?>