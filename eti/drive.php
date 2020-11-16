<?php
  include ("../db/db_connect.php");
  include 'quickstart_test.php';
	/* $query2 = "select id,serial_number,google_drive from eti_sra where google_drive IS NULL OR google_drive = ''";
	$exec2 = mysql_query($query2) or die ("Error in Query2".mysql_error());
	while ($res2 = mysql_fetch_array($exec2)){
		$eti_id = $res2['id'];
		$serial_number = $res2['serial_number'];
		$google_drive = $res2['google_drive'];
		
		$drive = new GoogleDrive();
		$file = $drive->upload('downloads/eti_pdf/','ETI - '.$serial_number.'.pdf');
		$google_drive_fileid = $file->id;
		
	$query33 = "update eti_sra set google_drive = '$google_drive_fileid' where id = '$eti_id'";
	$exec33 = mysql_query($query33) or die ("Error in Query33".mysql_error());
    printf("File ID: %s\n", $file->id);
	}  */
	$drive = new GoogleDrive();
	/* $query2 = "select id,serial_number,google_drive from eti_sra";
	$exec2 = mysql_query($query2) or die ("Error in Query2".mysql_error());
	while($res2 = mysql_fetch_array($exec2)){
		$eti_id = $res2['id'];
		$serial_number = $res2['serial_number'];
		$fileId  = $res2['google_drive'];
		if ($fileId != '') {
			$file = $drive->removeFileFromFolder($fileId);
			$file = $drive->upload('downloads/eti_pdf/','ETI - '.$serial_number.'.pdf');
			$google_drive_fileid = $file->id;
			$query33 = "update eti_sra set google_drive = '$google_drive_fileid' where id = '$eti_id'";
			$exec33 = mysql_query($query33) or die ("Error in Query33".mysql_error());
		} else {
			$file = $drive->upload('downloads/eti_pdf/','ETI - '.$serial_number.'.pdf');
			$google_drive_fileid = $file->id;
			$query33 = "update eti_sra set google_drive = '$google_drive_fileid' where id = '$eti_id'";
			$exec33 = mysql_query($query33) or die ("Error in Query33".mysql_error());
		}
	} */
	$fileId = '1hmHxCjv0rE6oP9l8jTnpr5pttaXEkWZM';
	$file = $drive->getFileID($fileId);
	 
	
	//$drive = new GoogleDrive();
	//$file = $drive->removeFileFromFolder($fileId);
?>
