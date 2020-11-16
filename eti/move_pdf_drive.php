<?php
include ("../db/db_connect.php");
include("quickstart.php");

	$query2 = "select id,serial_number,google_drive from eti_sra where google_drive = ''";
	$exec2 = mysql_query($query2) or die ("Error in Query2".mysql_error());
	while ($res2 = mysql_fetch_array($exec2)){
		
		$eti_id = $res2['id'];
		$serial_number = $res2['serial_number'];
		$google_drive = $res2['google_drive'];
		
		$client = getClient();
		$service = new Google_Service_Drive($client);
		$folderId = '12LYEcfss_rzbPEjy4LEeAcAfBl-djLqb';
		/* $fileId = '';
		if($fileId != '') {
			$service->files->delete($fileId);
		} */
		$fileMetadata = new Google_Service_Drive_DriveFile(array(
			'name' => 'ETI - '.$serial_number.'.pdf',
			'parents' => array($folderId)
		));
		$content = file_get_contents('downloads/eti_pdf/ETI - '.$serial_number.'.pdf');
		$file = $service->files->create($fileMetadata, array(
			'data' => $content,
			'mimeType' => 'application/pdf',
			'uploadType' => 'multipart',
			'fields' => 'id'));
		printf("File ID: %s\n", $file->id);
		$google_drive_fileid = $file->id;
		
		$query33 = "update eti_sra set google_drive = '$google_drive_fileid' where id = '$eti_id'";
		$exec33 = mysql_query($query33) or die ("Error in Query33".mysql_error());
	}