<?php




define('_MPDF_PATH','../');
include("../mpdf.php");


$html = '
<style>
table.rightBorder { 
    border-collapse: collapse; 
  }
  table.rightBorder td, 
  table.rightBorder th { 
    border-right: 1px solid black; 
    padding: 10px; 
    text-align: left;
  }
</style>
<table style="width:100%; height: 100%;">
	<tr>
		<td><b>No.<b></td>
		<td align="right"><img src="logo.jpg" alt="Rentokil" height="65"></td>
	</tr>
	<tr>
		<td><font size="5"><b>FUMIGATION SERVICE REPORT</b></font></td>
		<td align="left"><font size="2">
		<address style="text-align:right;"><b>Rentokil Initial Singapore Pte Ltd</b><br>
		16 & 18 Jalan Mesin Singapore 368815 <br>
		<b>t</b> +65 6347 8138 (Pest Control)<br>
		<b>f</b> +65 6347 8102 (Pest Control)<br>
		<b>&nbsp;</b> +65 6755 0548 (Initial Hygiene)<br>
		<b>&nbsp;</b> +65 6283 6009 (Fumigation)<br>
		<b>w</b> www.rentokil-initial.com</address> </font>
		</td>
	</tr>
</table>

<div style="text-align: left;padding-bottom:15px;">
	<div style="float:left;display:inline;width:20%;"><font size="3">Company Name &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:</font></div> 
	<div style="width:80%;float:left;display:inline;border-bottom:1px solid #000;padding:0 0 5px 0;"><font size="3"> &nbsp;</font></div>
</div>
<div style="text-align: left;padding-bottom:15px;">
	<div style="float:left;display:inline;width:20%;"><font size="3">Servicing Address &nbsp;&nbsp;:</font></div> 
	<div style="width:80%;float:left;display:inline;border-bottom:1px solid #000;padding:0 0 5px 0;"><font size="3"> &nbsp;</font></div>
</div>
<div style="text-align: left;padding-bottom:15px;">
	<div style="float:left;display:inline;width:20%;"><font size="3">Date of Fumigation :</font></div> 
	<div style="width:30%;float:left;display:inline;border-bottom:1px solid #000;"><font size="3"> &nbsp;</font></div>
	<div style="float:left;display:inline;width:20%;"><font size="3">Time of Fumigation :</font></div> 
	<div style="width:30%;float:left;display:inline;border-bottom:1px solid #000;"><font size="3"> &nbsp;</font></div>
</div>
<div style="text-align: left;padding-bottom:15px;">
	<div style="float:left;display:inline;width:20%;"><font size="3">Date of Ventilation :</font></div> 
	<div style="width:30%;float:left;display:inline;border-bottom:1px solid #000;"><font size="3"> &nbsp;</font></div>
	<div style="float:left;display:inline;width:20%;"><font size="3">Time of Ventilation :</font></div> 
	<div style="width:30%;float:left;display:inline;border-bottom:1px solid #000;"><font size="3"> &nbsp;</font></div>
</div>

<div>
	<b><font size="3">Fumigation Details</font></b>
	<table class="rightBorder" style="padding:8px; width:100%; border-collapse: collapse; border: 1px solid black;">
	<thead>
		<tr>
			<td style="border: 1px solid black; width:20%; text-align:center;"><b>Gas Type</b></td>
			<td style="border: 1px solid black; width:20%; text-align:center;"><b>Fumigation Type</b></td>
			<td style="border: 1px solid black; width:20%; text-align:center;"><b>Volume/Space (m3)</b></td>
			<td style="border: 1px solid black; width:30%; text-align:center;"><b>Dosage (g/m)3</b></td>
			<td style="border: 1px solid black; width:50%; text-align:center;"><b>Commodities Treated</b></td>
		</tr>
	</thead>
	<tbody>
		<tr>
			<td><input type="checkbox" name="QPC" value="ON" > Methyl Bromide<br></td>
			<td><input type="checkbox" name="QSC" value="ON" > Container 20</td>
			<td></td>
			<td><input type="checkbox" name="QSC" value="ON" > 1</td>
			<td><input type="checkbox" name="QSC" value="ON" > Pallet &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			<span style="float:left;"> Qty: <span style="width:100%;float:left;display:inline;border-bottom:1px solid #000;"><font size="3"> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</font></span></span></td>
		</tr>
		<tr>
			<td><input type="checkbox" name="QPC" value="ON" > Phosphine<br></td>
			<td><input type="checkbox" name="QSC" value="ON" > Container 40</td>
			<td></td>
			<td><input type="checkbox" name="QSC" value="ON" > 48</td>
			<td><input type="checkbox" name="QSC" value="ON" > Crates &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			<span style="float:left;"> Qty: <span style="width:100%;float:left;display:inline;border-bottom:1px solid #000;"><font size="3"> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</font></span></span></td>
		</tr>
		<tr>
			<td><input type="checkbox" name="QPC" value="ON" > Hydrogen Cyanide<br></td>
			<td><input type="checkbox" name="QSC" value="ON" > Loose Lot</td>
			<td></td>
			<td><input type="checkbox" name="QSC" value="ON" > 80</td>
			<td><input type="checkbox" name="QSC" value="ON" > Liftvans &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			<span style="float:left;"> Qty: <span style="width:100%;float:left;display:inline;border-bottom:1px solid #000;"><font size="3"> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</font></span></span></td>
		</tr>
		<tr>
			<td></td>
			<td><input type="checkbox" name="QSC" value="ON" > Silo</td>
			<td></td>
			<td><input type="checkbox" name="QSC" value="ON" > Others (Please State):</td>
			<td><input type="checkbox" name="QSC" value="ON" > Loose Pieces &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			<span style="float:left;"> Qty: <span style="width:100%;float:left;display:inline;border-bottom:1px solid #000;"><font size="3"> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</font></span></span></td>
		</tr>
		<tr>
			<td><br></td>
			<td><input type="checkbox" name="QSC" value="ON" > Ship</td>
			<td></td>
			<td><span style="width:100%;float:left;display:inline;border-bottom:1px solid #000;"><font size="3"> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</font></span></td>
			<td><input type="checkbox" name="QSC" value="ON" > Others (Please State):</td>
		</tr>
		<tr>
			<td></td>
			<td></td>
			<td></td>
			<td></td>
			<td><span style="width:100%;float:left;display:inline;border-bottom:1px solid #000;"><font size="3"> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</font></span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			<span style="float:left;"> Qty: <span style="width:100%;float:left;display:inline;border-bottom:1px solid #000;"><font size="3"> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</font></span></span></td>
		</tr>
	</tbody>
	</table>
</div>
<div>
<table style="width:100%;">
	<tr>
		<td style="width:50%;">
			<b>Marking Done By:</b>
		</td>
		<td style="width:50%; text-align: left;">
			<b>Marking No:</b>
		</td>
	</tr>
	<tr>
		<td style="width:50%;">
			<input type="checkbox" name="fumigation_team" value="ON" ><font size="2">Fumigation Team</font>
		</td>
		<td style="width:50%;">
			<input type="checkbox" name="sg" value="ON"><font size="2">SG11</font> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			<input type="checkbox" name="lot_no" value="ON" style="float:left;display:inline;"><font size="2"> Lot No. &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;: </font><span style="width:100%;float:left;display:inline;border-bottom:1px solid #000;"><font size="3"> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</font></span>
		</td>
	</tr>
	<tr>
		<td style="width:50%;">
			<input type="checkbox" name="customer" value="ON" ><font size="2"> Customer (From <span style="border-bottom: 1px solid black; text-align: justify; width:10%;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span> To <span style="border-bottom: 1px solid black; text-align: justify; width:10%;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span>) </font>
		</td>
		<td style="width:50%;">
			<input type="checkbox" name="sg" value="ON"><font size="2"> Normal</font> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			<input type="checkbox" name="lot_no" value="ON" style="float:left;display:inline;"><font size="2"> Lot/Ship No.: </font><span style="width:100%;float:left;display:inline;border-bottom:1px solid #000;"><font size="3"> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</font></span>
		</td>
	</tr>
</table></div>
<div>
	<b style="margin:0 0 25px 0;">Recommendations & Remarks</b>
	<div style="width:100%;float:left;display:inline;border-bottom:1px solid #000;padding:0 0 5px 0;"><font size="3"> &nbsp; </font></div>
	<div style="width:100%;float:left;display:inline;border-bottom:1px solid #000;padding:0 0 5px 0;"><font size="3"> &nbsp; </font></div>
	<div style="width:100%;float:left;display:inline;border-bottom:1px solid #000;padding:0 0 5px 0;"><font size="3"> &nbsp; </font></div>
</div>
<div>
	<b style="margin:0 0 25px 0;">Additional remarks on fumigated timber or consignment:</b>
	<table>
		<tr>
			<td style="width:28%;">
			<input type="checkbox" name="bark" value="ON"> <font size="2">Bark</font>
			</td>
			<td style="width:28%;">
			<input type="checkbox" name="fungi" value="ON"><font size="2"> Fungi / Mold</font>
			</td>
			<td style="width:43%;">
			<input type="checkbox" name="pla_wrapp" value="ON"><font size="2"> Plastic wrapping has not been used in this consignment.</font>
			</td>
		</tr>
		<tr>
			<td style="width:28%;">
			<input type="checkbox" name="soil" value="ON"><font size="2"> Soil</font>
			</td>
			<td style="width:28%;">
			<input type="checkbox" name="seed_weed" value="ON"><font size="2"> Seed / Weed</font>
			</td>
			<td style="width:43%;">
			<input type="checkbox" name="con_pri" value="ON"><font size="2"> This consignment has been fumigated prior to application of plastic wrapping.</font>
			</td>
		</tr>
		<tr>
			<td style="width:28%;">
			<input type="checkbox" name="live_insect" value="ON"><font size="2"> Live Insect</font>
			</td>
			<td style="width:28%;">
			<input type="checkbox" name="dirts_debris" value="ON"><font size="2"> Dirts / Debris</font>
			</td>
			<td style="width:44%;">
			<input type="checkbox" name="con_wrapp" value="ON"><font size="2"> Plastic wrapping used in this consignment conforms to the AQIS perforation standards.</font>
			</td>
		</tr>
		<tr>
			<td style="width:28%;">
			<input type="checkbox" name="dead_insect" value="ON"><font size="2"> Dead Insect</font>
			</td>
			<td style="width:28%;">
			<input type="checkbox" name="others" value="ON"><font size="2"> Others (Please State):</font>
			</td>
			<td style="width:44%;">
			</td>
		</tr>
		<tr>
			<td style="width:28%;">
			<input type="checkbox" name="bird_rodent" value="ON"><font size="2"> Bird / Rodent Droppings</font>
			</td>
			<td style="width:28%;">
			<input type="checkbox" name="dirts_debris" value="ON"><font size="2"> Dirts / Debris</font>
			</td>
			<td style="width:44%;">
			</td>
		</tr>
	</table>
</div> <br>
<div style="text-align: left;width:100%;float: left;">
    
	<div style="float:left;display:inline;width:50%;">
	<div style="float:left;display:inline;width:35%;">Clients Signature :</div>
	<div style="border-bottom:1px solid #000;float:left;display:inline;width:65%;">&nbsp;</div>
	</div>
    <div style="float:left;display:inline;width:50%;">
	<div style="float:left;display:inline;width:45%;">Technicians Signature :</div>
	<div style="float:left;display:inline;width:55%;border-bottom:1px solid #000;">&nbsp;</div>
	</div>
	
    <div style="width:100%;float: left;">
	<div style="float:left;display:inline;width:15%;">&nbsp;</div>
	<div style="text-align: center;font-size: 10px; width:35%;">(Companys Stamp is required)</div>
	<div style="float:left;display:inline;width:45%;">&nbsp;</div>
	<div style="float:left;display:inline;width:45%;">&nbsp;</div>
	</div>
	
	<div style="float:left;display:inline;width:50%;">
	<div style="float:left;display:inline;width:35%;">Clients Name &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:</div>
	<div style="border-bottom:1px solid #000;float:left;display:inline;width:65%;">&nbsp;</div>
	</div>
    <div style="float:left;display:inline;width:50%;">
	<div style="float:left;display:inline;width:45%;">Technicians Name &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:</div>
	<div style="float:left;display:inline;width:55%;border-bottom:1px solid #000;">&nbsp;</div>
	</div>
</div> 
<br>
<div style="text-align: left;"><font size="2"><b>A Rentokil Initial Company</b> Co. Regn. No. 1959 00145N</font></div>
';

//==============================================================
//==============================================================
//==============================================================

$mpdf=new mPDF('c'); 

// LOAD a stylesheet
//$stylesheet = file_get_contents('mpdfstyletables.css');
//$mpdf->WriteHTML($stylesheet,1);	// The parameter 1 tells that this is css/style only and no body/html/text

//$mpdf->SetColumns(2,'J');

$mpdf->WriteHTML($html);

$mpdf->Output();
exit;


?>