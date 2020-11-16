<?php
session_start();
if (!isset($_SESSION["userloginid"])) header ("location:../index.php");

include ("../db/db_connect.php");

header('Content-Type: text/csv; charset=utf-8');
header('Content-Disposition: attachment; filename=eti_report.csv');

// create a file pointer connected to the output stream
$output = fopen('php://output', 'w');

// output the column headings
fputcsv($output, array('Sl. No.', 'Serial No', 'SRA', 'Contract No', 'Date', 'Customer Name', 'Service Address', 'Postal Code', 'Telephone No', 'Job Type','Business Origin', 'Business Origin Code', 'Business Origin Detail Code', 'Prospect Number', 'Competitor', 'Contract Cost', 'Price Accepted [exclusive of GST]','Price Accepted + 7% GST','Total Percentage (GM1)','Fixed Percentage (GM2)', 'Wfixed Percentage (GM3)','Billing Email', 'Submitter', 'Completed Date', 'Status'));
	if (isset($_REQUEST["job_type"])) { $job_type = $_REQUEST["job_type"]; } else { $job_type = ""; }
	if (isset($_REQUEST["eti_status"])) { $eti_status = $_REQUEST["eti_status"]; } else { $eti_status = ""; }
	if (isset($_REQUEST["completed_date"])) { 
		$completed_date = $_REQUEST["completed_date"];
        $completeddate = explode("/",$completed_date);
		$completed_start_date = $completeddate[0];
		$completed_start_date = date('Y-m-d', strtotime($completed_start_date));
		$completed_end_date = $completeddate[1];
		$completed_end_date = date('Y-m-d', strtotime($completed_end_date));
	} else { 
		$completed_date = ""; 
	}
	if ($job_type == '' && $eti_status == '' && $completed_date==''){
	$query2 = mysql_query("SELECT 
		(@a:=@a + 1) AS si_no,
		b.serial_number,
		b.sra,
		b.contract_no,
		b.eti_date,
		b.name,
		CONCAT_WS('\n',
				b.address_a,
				b.address_b) AS service_address,
		b.postcode_a,
		b.tel_a,
		b.job_type,
		f.business_name,
		b.business_code,
		b.business_origin_code,
		b.prospect_no,
		g.competitor_name,
		FORMAT(c.total_annual_cost, 2),
		FORMAT(c.price_accept, 2),
		FORMAT(c.price_accept_tax, 2),
		c.total_percentage,
		c.fix_percentage,
		c.wfix_percentage,
		b.billing_email,
	    e.employee_name,
		b.date_completed,
		CASE 
			WHEN b.form_status = 0 AND d.approve_desc ='' THEN 'Pending'
			WHEN b.form_status = 1 THEN 'Submitted'
			WHEN b.form_status = 2 THEN 'Cancelled'
			WHEN b.form_status = 3 THEN 'Completed'
			WHEN b.form_status = 0 AND d.approve_desc ='Rejected By Admin' THEN 'Rejected'
			ELSE NULL
		END AS status
	FROM
		eti_sra b
			CROSS JOIN
		(SELECT @a:=0) AS a
			LEFT JOIN
		eti_total_details c ON b.id = c.sra_id
			LEFT JOIN
		eti_sra_status d ON b.id = d.sra_id
			LEFT JOIN
		eti_portal_user e ON b.created_by = e.id
			LEFT JOIN
		eti_business f ON b.business_origin = f.id
			LEFT JOIN
		eti_competitor g ON b.competitor_id = g.id
	ORDER BY b.serial_number");
	} else if ($job_type!='' && $eti_status=='' && $completed_date=='') {
		$query2 = mysql_query("SELECT 
		(@a:=@a + 1) AS si_no,
		b.serial_number,
		b.sra,
		b.contract_no,
		b.eti_date,
		b.name,
		CONCAT_WS('\n',
				b.address_a,
				b.address_b) AS service_address,
		b.postcode_a,
		b.tel_a,
		b.job_type,
		f.business_name,
		b.business_code,
		b.business_origin_code,
		b.prospect_no,
		g.competitor_name,
		FORMAT(c.total_annual_cost, 2),
		FORMAT(c.price_accept, 2),
		FORMAT(c.price_accept_tax, 2),
		c.total_percentage,
		c.fix_percentage,
		c.wfix_percentage,
		b.billing_email,
		e.employee_name,
		b.date_completed,
		CASE 
			WHEN b.form_status = 0 AND d.approve_desc ='' THEN 'Pending'
			WHEN b.form_status = 1 THEN 'Submitted'
			WHEN b.form_status = 2 THEN 'Cancelled'
			WHEN b.form_status = 3 THEN 'Completed'
			WHEN b.form_status = 0 AND d.approve_desc ='Rejected By Admin' THEN 'Rejected'
			ELSE NULL
		END AS status
	FROM
		eti_sra b
			CROSS JOIN
		(SELECT @a:=0) AS a
			LEFT JOIN
		eti_total_details c ON b.id = c.sra_id
			LEFT JOIN
		eti_sra_status d ON b.id = d.sra_id
			LEFT JOIN
		eti_portal_user e ON b.created_by = e.id
			LEFT JOIN
		eti_business f ON b.business_origin = f.id
			LEFT JOIN
		eti_competitor g ON b.competitor_id = g.id
	WHERE
		b.job_type='".$job_type."'
	ORDER BY b.serial_number");
	} else if ($job_type=='' && $eti_status!='' && $completed_date=='') {
		$query2 = mysql_query("SELECT 
		(@a:=@a + 1) AS si_no,
		b.serial_number,
		b.sra,
		b.contract_no,
		b.eti_date,
		b.name,
		CONCAT_WS('\n',
				b.address_a,
				b.address_b) AS service_address,
		b.postcode_a,
		b.tel_a,
		b.job_type,
		f.business_name,
		b.business_code,
		b.business_origin_code,
		b.prospect_no,
		g.competitor_name,
		FORMAT(c.total_annual_cost, 2),
		FORMAT(c.price_accept, 2),
		FORMAT(c.price_accept_tax, 2),
		c.total_percentage,
		c.fix_percentage,
		c.wfix_percentage,
		b.billing_email,
		e.employee_name,
		b.date_completed,
		CASE 
			WHEN b.form_status = 0 AND d.approve_desc ='' THEN 'Pending'
			WHEN b.form_status = 1 THEN 'Submitted'
			WHEN b.form_status = 2 THEN 'Cancelled'
			WHEN b.form_status = 3 THEN 'Completed'
			WHEN b.form_status = 0 AND d.approve_desc ='Rejected By Admin' THEN 'Rejected'
			ELSE NULL
		END AS status
	FROM
		eti_sra b
			CROSS JOIN
		(SELECT @a:=0) AS a
			LEFT JOIN
		eti_total_details c ON b.id = c.sra_id
			LEFT JOIN
		eti_sra_status d ON b.id = d.sra_id
			LEFT JOIN
		eti_portal_user e ON b.created_by = e.id
			LEFT JOIN
		eti_business f ON b.business_origin = f.id
			LEFT JOIN
		eti_competitor g ON b.competitor_id = g.id
	WHERE
		b.form_status='".$eti_status."'
	ORDER BY b.serial_number");
	} else if ($job_type=='' && $eti_status=='' && $completed_date!='') {
		$query2 = mysql_query("SELECT 
		(@a:=@a + 1) AS si_no,
		b.serial_number,
		b.sra,
		b.contract_no,
		b.eti_date,
		b.name,
		CONCAT_WS('\n',
				b.address_a,
				b.address_b) AS service_address,
		b.postcode_a,
		b.tel_a,
		b.job_type,
		f.business_name,
		b.business_code,
		b.business_origin_code,
		b.prospect_no,
		g.competitor_name,
		FORMAT(c.total_annual_cost, 2),
		FORMAT(c.price_accept, 2),
		FORMAT(c.price_accept_tax, 2),
		c.total_percentage,
		c.fix_percentage,
		c.wfix_percentage,
		b.billing_email,
		e.employee_name,
		b.date_completed,
		CASE 
			WHEN b.form_status = 0 AND d.approve_desc ='' THEN 'Pending'
			WHEN b.form_status = 1 THEN 'Submitted'
			WHEN b.form_status = 2 THEN 'Cancelled'
			WHEN b.form_status = 3 THEN 'Completed'
			WHEN b.form_status = 0 AND d.approve_desc ='Rejected By Admin' THEN 'Rejected'
			ELSE NULL
		END AS status
		FROM
			eti_sra b
				CROSS JOIN
			(SELECT @a:=0) AS a
				LEFT JOIN
			eti_total_details c ON b.id = c.sra_id
				LEFT JOIN
			eti_sra_status d ON b.id = d.sra_id
				LEFT JOIN
			eti_portal_user e ON b.created_by = e.id
				LEFT JOIN
			eti_business f ON b.business_origin = f.id
				LEFT JOIN
			eti_competitor g ON b.competitor_id = g.id
		WHERE
			b.date_completed BETWEEN '".$completed_start_date."' AND '".$completed_end_date."'
		ORDER BY b.serial_number");
	} else if ($job_type!='' && $eti_status!='' && $completed_date=='') {
		$query2 = mysql_query("SELECT 
		(@a:=@a + 1) AS si_no,
		b.serial_number,
		b.sra,
		b.contract_no,
		b.eti_date,
		b.name,
		CONCAT_WS('\n',
				b.address_a,
				b.address_b) AS service_address,
		b.postcode_a,
		b.tel_a,
		b.job_type,
		f.business_name,
		b.business_code,
		b.business_origin_code,
		b.prospect_no,
		g.competitor_name,
		FORMAT(c.total_annual_cost, 2),
		FORMAT(c.price_accept, 2),
		FORMAT(c.price_accept_tax, 2),
		c.total_percentage,
		c.fix_percentage,
		c.wfix_percentage,
		b.billing_email,
		e.employee_name,
		b.date_completed,
		CASE 
			WHEN b.form_status = 0 AND d.approve_desc ='' THEN 'Pending'
			WHEN b.form_status = 1 THEN 'Submitted'
			WHEN b.form_status = 2 THEN 'Cancelled'
			WHEN b.form_status = 3 THEN 'Completed'
			WHEN b.form_status = 0 AND d.approve_desc ='Rejected By Admin' THEN 'Rejected'
			ELSE NULL
		END AS status
	FROM
		eti_sra b
			CROSS JOIN
		(SELECT @a:=0) AS a
			LEFT JOIN
		eti_total_details c ON b.id = c.sra_id
			LEFT JOIN
		eti_sra_status d ON b.id = d.sra_id
			LEFT JOIN
		eti_portal_user e ON b.created_by = e.id
			LEFT JOIN
		eti_business f ON b.business_origin = f.id
			LEFT JOIN
		eti_competitor g ON b.competitor_id = g.id
	WHERE
		b.job_type='".$job_type."' and b.form_status='".$eti_status."'
	ORDER BY b.serial_number");
	} else if ($job_type!='' && $eti_status=='' && $completed_date!='') {
		$query2 = mysql_query("SELECT 
		(@a:=@a + 1) AS si_no,
		b.serial_number,
		b.sra,
		b.contract_no,
		b.eti_date,
		b.name,
		CONCAT_WS('\n',
				b.address_a,
				b.address_b) AS service_address,
		b.postcode_a,
		b.tel_a,
		b.job_type,
		f.business_name,
		b.business_code,
		b.business_origin_code,
		b.prospect_no,
		g.competitor_name,
		FORMAT(c.total_annual_cost, 2),
		FORMAT(c.price_accept, 2),
		FORMAT(c.price_accept_tax, 2),
		c.total_percentage,
		c.fix_percentage,
		c.wfix_percentage,
		b.billing_email,
		e.employee_name,
		b.date_completed,
		CASE 
			WHEN b.form_status = 0 AND d.approve_desc ='' THEN 'Pending'
			WHEN b.form_status = 1 THEN 'Submitted'
			WHEN b.form_status = 2 THEN 'Cancelled'
			WHEN b.form_status = 3 THEN 'Completed'
			WHEN b.form_status = 0 AND d.approve_desc ='Rejected By Admin' THEN 'Rejected'
			ELSE NULL
		END AS status
		FROM
			eti_sra b
				CROSS JOIN
			(SELECT @a:=0) AS a
				LEFT JOIN
			eti_total_details c ON b.id = c.sra_id
				LEFT JOIN
			eti_sra_status d ON b.id = d.sra_id
				LEFT JOIN
			eti_portal_user e ON b.created_by = e.id
				LEFT JOIN
			eti_business f ON b.business_origin = f.id
				LEFT JOIN
			eti_competitor g ON b.competitor_id = g.id
		WHERE
			b.job_type='".$job_type."'
		AND
			b.date_completed BETWEEN '".$completed_start_date."' AND '".$completed_end_date."'
		ORDER BY b.serial_number");
	} else if ($job_type=='' && $eti_status!='' && $completed_date!=''){
		$query2 = mysql_query("SELECT 
		(@a:=@a + 1) AS si_no,
		b.serial_number,
		b.sra,
		b.contract_no,
		b.eti_date,
		b.name,
		CONCAT_WS('\n',
				b.address_a,
				b.address_b) AS service_address,
		b.postcode_a,
		b.tel_a,
		b.job_type,
		f.business_name,
		b.business_code,
		b.business_origin_code,
		b.prospect_no,
		g.competitor_name,
		FORMAT(c.total_annual_cost, 2),
		FORMAT(c.price_accept, 2),
		FORMAT(c.price_accept_tax, 2),
		c.total_percentage,
		c.fix_percentage,
		c.wfix_percentage,
		b.billing_email,
		e.employee_name,
		b.date_completed,
		CASE 
			WHEN b.form_status = 0 AND d.approve_desc ='' THEN 'Pending'
			WHEN b.form_status = 1 THEN 'Submitted'
			WHEN b.form_status = 2 THEN 'Cancelled'
			WHEN b.form_status = 3 THEN 'Completed'
			WHEN b.form_status = 0 AND d.approve_desc ='Rejected By Admin' THEN 'Rejected'
			ELSE NULL
		END AS status
		FROM
			eti_sra b
				CROSS JOIN
			(SELECT @a:=0) AS a
				LEFT JOIN
			eti_total_details c ON b.id = c.sra_id
				LEFT JOIN
			eti_sra_status d ON b.id = d.sra_id
				LEFT JOIN
			eti_portal_user e ON b.created_by = e.id
				LEFT JOIN
			eti_business f ON b.business_origin = f.id
				LEFT JOIN
			eti_competitor g ON b.competitor_id = g.id
		WHERE
			b.form_status='".$eti_status."' 
		AND
			b.date_completed BETWEEN '".$completed_start_date."' AND '".$completed_end_date."'
		ORDER BY b.serial_number");
	} else if ($job_type!='' && $eti_status!='' && $completed_date!='') {
		$query2 = mysql_query("SELECT 
		(@a:=@a + 1) AS si_no,
		b.serial_number,
		b.sra,
		b.contract_no,
		b.eti_date,
		b.name,
		CONCAT_WS('\n',
				b.address_a,
				b.address_b) AS service_address,
		b.postcode_a,
		b.tel_a,
		b.job_type,
		f.business_name,
		b.business_code,
		b.business_origin_code,
		b.prospect_no,
		g.competitor_name,
		FORMAT(c.total_annual_cost, 2),
		FORMAT(c.price_accept, 2),
		FORMAT(c.price_accept_tax, 2),
		c.total_percentage,
		c.fix_percentage,
		c.wfix_percentage,
		b.billing_email,
		e.employee_name,
		b.date_completed,
		CASE 
			WHEN b.form_status = 0 AND d.approve_desc ='' THEN 'Pending'
			WHEN b.form_status = 1 THEN 'Submitted'
			WHEN b.form_status = 2 THEN 'Cancelled'
			WHEN b.form_status = 3 THEN 'Completed'
			WHEN b.form_status = 0 AND d.approve_desc ='Rejected By Admin' THEN 'Rejected'
			ELSE NULL
		END AS status
		FROM
			eti_sra b
				CROSS JOIN
			(SELECT @a:=0) AS a
				LEFT JOIN
			eti_total_details c ON b.id = c.sra_id
				LEFT JOIN
			eti_sra_status d ON b.id = d.sra_id
				LEFT JOIN
			eti_portal_user e ON b.created_by = e.id
				LEFT JOIN
			eti_business f ON b.business_origin = f.id
				LEFT JOIN
			eti_competitor g ON b.competitor_id = g.id
		WHERE
			b.job_type='".$job_type."'
		AND
			b.form_status='".$eti_status."'
		AND
			b.date_completed BETWEEN '".$completed_start_date."' AND '".$completed_end_date."'
		ORDER BY b.serial_number");
	}
while ($row = mysql_fetch_assoc($query2)) fputcsv($output, $row);
?>