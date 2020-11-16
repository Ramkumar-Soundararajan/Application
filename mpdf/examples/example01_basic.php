<?php
$main_last_id = '1';
$hostname = '148.72.232.128';
$hostlogin = 'rentokil';
$hostpassword = 'Rentokil!123';
$databasename = 'tpa_version_two';


$link = mysqli_connect($hostname, $hostlogin, $hostpassword,$databasename) or die('Could not connect Table zero : ' . mysqli_error());

$query1 = "select * from form_a where main_id = '$main_last_id'";
$exec1 = mysqli_query($link,$query1) or die ("Error in Query1".mysql_error());
$res1 = mysqli_fetch_array($exec1);
$a1_1 = $res1["a1_1"];
$a1_2 = $res1["a1_2"]; 
echo $html = '
<h2 align="center"><font color="red">Technician Performance Accessment</font></h2>

<h4 align="center">SECTION A : PERSONAL QUALITIES</h4>

<h4 align="center"></br></h5>
<table border="1">
<thead>
<tr>
<th colspan="3">A1-Appearance</th>
<th colspan="3">A2-Self Management</th>

</tr>
</thead>
<thead>
<tr>
<td>A1.1</td>
<td> The Uniform is complete, clean and fits well</td>
<td>'.$a1_1.'</td>
<td>A1.1</td>
<td>A1.1 The Uniform is complete, clean and fits well</td>
<td>'.$a1_2.'<br /></td>
</tr>
</thead>
<tbody>
<tr>
<td>A1.1</td>
<td>A1.1 The Uniform is complete, clean and fits well</td>

<td>NA</td>
<td>A1.1</td>
<td>A1.1 The Uniform is complete, clean and fits well</td>
<td>No<br /></td>
</tr>
<tr>
<td>A1.1</td>
<td>A1.1 The Uniform is complete, clean and fits well</td>
<td>NA</td>
<td>A1.1</td>
<td>A1.1 The Uniform is complete, clean and fits well</td>
<td>No<br /></td>
</tr>
<tr>
<td>A1.1</td>
<td>A1.1 The Uniform is complete, clean and fits well</td>
<td>Yes</td>
<td>A1.1</td>
<td>A1.1 The Uniform is complete, clean and fits well</td>
<td>NA<br /></td>
</tr>
</tbody>
</table>
';
exit;
include("../mpdf.php");
$mpdf=new mPDF('c'); 

$mpdf->WriteHTML($html);

$mpdf->Output();
exit;
?>