<?php
include("quickstart.php");
$client = getClient();
$service = new Google_Service_Drive($client);
$folderId = '1tF3rDH4jvUSYo2_0z6V0zU3_zrKGbcEM';
$fileId = '1LBmNBsxD7p9BOerrASfowFnT7TzzSQiJ';
if($fileId != '') {
	$service->files->delete($fileId);
}
$fileMetadata = new Google_Service_Drive_DriveFile(array(
    'name' => 'ETI - 2018080318.pdf',
    'parents' => array($folderId)
));
$content = file_get_contents('eti/downloads/eti_pdf/ETI - 2018080318.pdf');
$file = $service->files->create($fileMetadata, array(
    'data' => $content,
    'mimeType' => 'application/pdf',
    'uploadType' => 'multipart',
    'fields' => 'id'));
printf("File ID: %s\n", $file->id);
