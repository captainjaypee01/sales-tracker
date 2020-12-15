<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" lang="en" xml:lang="en">
	<head>
		<title>Download Application Form</title>
		<style type="text/css">
			@page {
	            margin-top: 50px;
	            margin-left: 40px;
	        }

			body {
				font-size: 7px;
				font-family: Arial, Helvetica, sans-serif;
				width: 720px;
				height: 970px;
			}
			
			.pagebreak {
				page-break-after:always;
			}
			
			table {
				font-size: 7px;
				position: relative;
				top:0;
			}
			
			table + table,span + table {
				margin-top: 15px;
			}
			
			#title {
				font-size: 15px;
				text-align: center;
				font-weight: 900;
				margin-bottom: 5px;
			}
			
			.black_bg {
				background-color: #000000;
				color: #FFFFFF;
				font-weight: 900;
				padding: 1px 10px;
				font-size: 7px;
			}
			
			.black_bg_table {
				background-color: #000000;
				color: #FFFFFF;
				text-align: left; 
				vertical-align: top;
				font-size: 7px;
			}
			
			.info_data {
				padding: 10px 0  0 10px;
			}
			
			#head strong {
				font-size: 7px;
				margin-left: 10px;
			}
			
			.selected {
				background-color: #000;
				color: #FFF;
				font-weight: 900;
			}
			
			.small_txt {
				font-size: 6px;
			}
			
			form {
				padding: 0;
				margin: 0;
			}
			
			div.leftchecked {
				width: 8px;
				height: 8px;
				border: 1px solid #000;
				background-color: #000;
			}
			
			div.leftunchecked {
				width: 8px;
				height: 8px;
				border: 1px solid #000;
				background-color: #FFF;
			}
			
			div.container div {
				display: inline-block;
			}
			
			ul {
				list-style:none;
				padding: 0;
				margin-bottom: 10px;
			}
			
			ul li {
				display: inline-block;
			}
		</style>
		<script type="text/javascript">
			<?php echo $this->session->flashdata('prompt')!='' ? "alert('{$this->session->flashdata('prompt')}');" : ""; ?>
		</script>
	</head>
	<body>
		<form method="post" action="">
		<div id="head">
			<div id="title">mioTV Contents Service (Simplified ACA)</div>
			<div id="info">
				<div class="black_bg">Customer's Particulars</div>
				<!--<div class="info_data"><span style="margin-left: 7px;">Name of Applicant (as in NRIC/FIN): Mr/Miss/Mdm/Dr*: <strong><?php echo $info['app_name']?></strong></span></div>-->
				<div class="info_data">
					<ul>
						<li>Name of Applicant (as in NRIC/FIN): Mr/Miss/Mdm/Dr*: <strong><?php echo $info['app_name']?></strong></li>
					</ul>
					<ul>
						<li style="width: 25%;">NRIC/FIN No: <strong><?php echo $info['NRIC']?></strong></li>
						<li style="width: 33%;">Date of Birth (dd/mm/yy): <strong><?php echo $info['dob']?></strong></li>
						<li style="width: 33%;">Issue Date (dd/mm/yy): <strong><?php echo '01/01/2000';?></strong></li>
					</ul>
					<ul>
						<li style="width: 22%;">IPTV No: <strong><?php echo $info['IPTV_NO']?></strong></li>
						<li style="width: 55px;;">Telephone</li>
						<li style="width: 12%;">(H): <strong><?php echo $info['phone_no']?></strong> </li>
						<li style="width: 10%;">(M): <strong><?php echo $info['mobile_no']?></strong></li>
					</ul>
					<ul>
						<li>Approval Code: <strong>N/A</strong></li>
					</ul>
					<ul>
						<li style="width: 20%;">Dealer ID: <strong>D2566</strong></li>
						<li style="width: 20%;">Salesman code: <strong>5945</strong></li>
						<li style="width: 20%;">Salesman name: <strong><?php echo $info['agent_id']?></strong></li>
						<li style="width: 10%;">CRD: <strong><?php echo $info['crd']?></strong></li>
					</ul>
					<!--
					<table cellpadding="5">
						<tr>
							<td style="width: 210px">NRIC/FIN No: <strong><?php echo $info['NRIC']?></strong></td>
							<td style="width: 210px">Date of Birth (dd/mm/yy): <strong><?php echo $info['dob']?></strong></td>
							<td style="width: 210px">Issue Date (dd/mm/yy): <strong><?php echo '01/01/2000';//echo date('d/m/Y', strtotime($info['appt_date']));?></strong></td>
						</tr>
						<tr>
							<td style="width: 210px">IPTV No: <strong><?php echo $info['IPTV_NO']?></strong></td>
							<td style="width: 210px">Telephone (H): <strong><?php echo $info['phone_no']?></strong></td>
							<td style="width: 210px">Telephone (M): <strong><?php echo $info['mobile_no']?></strong></td>
						</tr>
						<tr>
							<td style="width: 210px">Approval Code: <strong>N/A</strong></td>
							<td style="width: 210px"></td>
							<td style="width: 210px"></strong></td>
						</tr>
						<tr>
							<td style="width: 210px">Dealer ID: <strong>D2566</strong></td>
							<td style="width: 210px">Salesman code: <strong>5945</strong></td>
							<td style="width: 210px">Salesman name: <strong><?php echo $info['agent_id']?></strong></td>
						</tr>
					</table>
					-->
				</div>
				<div class="black_bg" style="margin-bottom: 15px;">mioTV Ala-Carte Services</div>
			</div>
		</div>
		<div class="body">
			<table cellspacing="0" cellpadding="0" width="100%">
				<tr>
					<td width="50%" valign="top">
						<table cellspacing="0" cellpadding="2" width="100%" style="padding-right: 10px;">
							<thead>
								<tr class="black_bg_table">
									<th align="left">Entertainment Pack mio TV Channels Subscription on Monthly Term</th>
									<th align="left" style="width: 45px">Type</th>
									<th align="left" style="width: 40px">Per mo. or part thereof</th>
									<th align="left" style="width: 40px">12 mos. Term Per mo.</th>
									<th align="left" style="width: 60px">12 mos. Term Entertainment Pack Per mo.</th>
								</tr>
							</thead>
							<tbody>
								<tr>
									<td>Fox on Demand</td>
									<td>On Dd</td>
									<td>$12.84</td>
									<td>$11.56</td>
									<td></td>
								</tr>
								<tr>
									<td>KIX HD</td>
									<td>BTV-HD</td>
									<td>$12.84</td>
									<td></td>
									<td></td>
								</tr>
								<tr>
									<td>PictureBox</td>
									<td>On Dd</td>
									<td>$12.84</td>
									<td>$11.56</td>
									<td><?php $this->Record_model->create_chkbox("c1", "$21.90", isset($answers['c1'])?$answers['c1']:0, "50% off for 6mths<br />[PTFL0161]", FALSE); ?></td>
								</tr>
								<tr>
									<td>Sony Entertainment Television</td>
									<td>BTV</td>
									<td>$8.56</td>
									<td>$6.42</td>
									<td></td>
								</tr>
								<tr>
									<td>Sundance Channel (HD)</td>
									<td>BTV-HD</td>
									<td>$12.84</td>
									<td>$10.70</td>
									<td></td>
								</tr>
								<tr>
									<td>Sundance Channel on Demand (HD)</td>
									<td>On Dd</td>
									<td>$10.70</td>
									<td>$8.56</td>
									<td></td>
								</tr>
								<tr>
									<td>The Film Factory</td>
									<td>On Dd</td>
									<td>$12.84</td>
									<td>$11.56</td>
									<td></td>
								</tr>
							</tbody>
						</table>
						<table cellspacing="0" cellpadding="2" width="100%" style="padding-right: 10px;">
							<thead>
								<tr class="black_bg_table">
									<th align="left">Jingxuan Pack mio TV Channels Subscription on Monthly Term</th>
									<th align="left" style="width: 45px">Type</th>
									<th align="left" style="width: 40px">Per mo. or part thereof</th>
									<th align="left" style="width: 40px">12 mos. Term Per mo.</th>
									<th align="left" style="width: 60px">12 mos. Term Jingxuan Pack Per mo.</th>
								</tr>
							</thead>
							<tbody>
								<tr>
									<td>CCTV-4</td>
									<td>BTV</td>
									<td>$4.28</td>
									<td>$3.21</td>
									<td></td>
								</tr>
								<tr>
									<td>Celestial Movies Channel</td>
									<td>BTV</td>
									<td>$9.90</td>
									<td></td>
									<td></td>
								</tr>
								<tr>
									<td>Celestial Movies on Demand</td>
									<td>On Dd</td>
									<td></td>
									<td></td>
									<td></td>
								</tr>
								<tr>
									<td>Celestial Classic Movies</td>
									<td>BTV</td>
									<td>$9.90</td>
									<td></td>
									<td></td>
								</tr>
								<tr>
									<td>Celestial Claasic Movies on Demand</td>
									<td>On Dd</td>
									<td></td>
									<td></td>
									<td></td>
								</tr>
								<tr>
									<td>Jia Le Channel</td>
									<td>BTV</td>
									<td>$9.90</td>
									<td></td>
									<td><?php $this->Record_model->create_chkbox("c2", "$21.90", isset($answers['c2'])?$answers['c2']:0, "50% off for 6mths<br />[PTFL0176]", FALSE); ?></td>
								</tr>
								<tr>
									<td>Jia Le On Demand</td>
									<td>On Dd</td>
									<td></td>
									<td></td>
									<td></td>
								</tr>
								<tr>
									<td>Mei Ah Movies Channel (Asia)</td>
									<td>BTV</td>
									<td>$10.70</td>
									<td>$8.56</td>
									<td></td>
								</tr>
								<tr>
									<td>Mei Ah Movies On Demand</td>
									<td>On Dd</td>
									<td>$12.84</td>
									<td>$11.56</td>
									<td></td>
								</tr>
								<tr>
									<td>mobtv SELECT</td>
									<td>On Dd</td>
									<td>$8.56</td>
									<td>$7.70</td>
									<td></td>
								</tr>
								<tr>
									<td>ONE HD</td>
									<td>BTV-HD</td>
									<td>$6.42</td>
									<td></td>
									<td></td>
								</tr>
								<tr>
									<td>Azio International Channel</td>
									<td>BTV</td>
									<td>$5.35</td>
									<td>$4.28</td>
									<td></td>
								</tr>
							</tbody>
						</table>
						<table cellspacing="0" cellpadding="2" width="100%" style="padding-right: 10px;">
							<thead>
								<tr class="black_bg_table">
									<th align="left">Uthayam Pack mioTV Channels Subscription on Monthly Term</th>
									<th align="left" style="width: 45px">Type</th>
									<th align="left" style="width: 40px">Per mo. or part thereof</th>
									<th align="left" style="width: 40px">12 mos. Term Per mo.</th>
									<th align="left" style="width: 60px">12 mos. Uthayam Pack Per mo.</th>
								</tr>
							</thead>
							<tbody>
								<tr>
									<td>Sun TV</td>
									<td>BTV</td>
									<td></td>
									<td></td>
									<td><?php $this->Record_model->create_chkbox("c3", "$14.90", isset($answers['c3'])?$answers['c3']:0, "[PTFL0418]", FALSE); ?></td>
								</tr>
								<tr>
									<td>Adithya TV</td>
									<td>BTV</td>
									<td></td>
									<td></td>
									<td></td>
								</tr>
							</tbody>
						</table>
						<table cellspacing="0" cellpadding="2" width="100%" style="padding-right: 10px;">
							<thead>
								<tr class="black_bg_table">
									<th align="left">Inbam Pack mioTV Channels Subscription on Monthly Term</th>
									<th align="left" style="width: 45px">Type</th>
									<th align="left" style="width: 40px">Per mo. or part thereof</th>
									<th align="left" style="width: 40px">12 mos. Term Per mo.</th>
									<th align="left" style="width: 60px">12 mos. Term Inbam Pack Per mo.</th>
								</tr>
							</thead>
							<tbody>
								<tr>
									<td>Kalaignar TV</td>
									<td>BTV</td>
									<td>$6.42</td>
									<td>$5.35</td>
									<td><?php $this->Record_model->create_chkbox("c4", "$14.90", isset($answers['c4'])?$answers['c4']:0, "[PTFL0424]", FALSE); ?></td>
								</tr>
								<tr>
									<td>Jaya TV</td>
									<td>BTV</td>
									<td>$6.42</td>
									<td>$5.35</td>
									<td></td>
								</tr>
							</tbody>
						</table>
					</td>
					<td valign="top">
						<table cellspacing="0" cellpadding="2" width="100%" style="padding-right: 10px;">
							<thead>
								<tr class="black_bg_table">
									<th align="left">Astro Pack mio TV Channels Subscription on Monthly Term</th>
									<th align="left" style="width: 45px">Type</th>
									<th align="left" style="width: 40px">Per mo. or part thereof</th>
									<th align="left" style="width: 40px">12 mos. Term Per mo.</th>
									<th align="left" style="width: 60px">12 mos. Term Astro Pack Per mo.</th>
								</tr>
							</thead>
							<tbody>
								<tr>
									<td>Astro Aruna</td>
									<td>BTV</td>
									<td>$10.70</td>
									<td>$8.56</td>
									<td></td>
								</tr>
								<tr>
									<td>Astro Ria</td>
									<td>BTV</td>
									<td>$8.56</td>
									<td>$6.42</td>
									<td><?php $this->Record_model->create_chkbox("c5", "$11.00", isset($answers['c5'])?$answers['c5']:0, "50% off 3mths<br />[PTFL0219]", FALSE); ?></td>
								</tr>
								<tr>
									<td>Astro World</td>
									<td>On Dd</td>
									<td>$6.42</td>
									<td>$5.78</td>
									<td></td>
								</tr>
							</tbody>
						</table>
						<table cellspacing="0" cellpadding="2" width="100%" style="padding-right: 10px;">
							<thead>
								<tr class="black_bg_table">
									<th align="left">Desi Pack mio TV Channels Subscription on Monthly Term</th>
									<th align="left" style="width: 45px">Type</th>
									<th align="left" style="width: 40px">Per mo. or part thereof</th>
									<th align="left" style="width: 40px">12 mos. Term Per mo.</th>
									<th align="left" style="width: 60px">12 mos. Term Desi Pack Per mo.</th>
								</tr>
							</thead>
							<tbody>
								<tr>
									<td>SAB TV</td>
									<td>BTV</td>
									<td></td>
									<td></td>
									<td></td>
								</tr>
								<tr>
									<td>SET (Hindi)</td>
									<td>BTV</td>
									<td></td>
									<td></td>
									<td></td>
								</tr>
								<tr>
									<td>Sony Max</td>
									<td>BTV</td>
									<td></td>
									<td></td>
									<td><?php $this->Record_model->create_chkbox("c6", "$29.90", isset($answers['c6'])?$answers['c6']:0, "$19.90 for 3 mths<br />[PTFL0414]", FALSE); ?></td>
								</tr>
								<tr>
									<td>Colors</td>
									<td>BTV</td>
									<td>$6.42</td>
									<td>$5.35</td>
									<td></td>
								</tr>
								<tr>
									<td>EROS Bollywood</td>
									<td>On Dd</td>
									<td>$10.70</td>
									<td>$9.63</td>
									<td></td>
								</tr>
								<tr>
									<td>MTV India</td>
									<td>BTV</td>
									<td>$4.20</td>
									<td>$3.21</td>
									<td></td>
								</tr>
							</tbody>
						</table>
						<table cellspacing="0" cellpadding="2" width="100%" style="padding-right: 10px;">
							<thead>
								<tr class="black_bg_table">
									<th align="left">Kondattam Pack mioTV Channels Subscription on Monthly Term</th>
									<th align="left" style="width: 45px">Type</th>
									<th align="left" style="width: 40px">Per mo. or part thereof</th>
									<th align="left" style="width: 40px">12 mos. Term Per mo.</th>
									<th align="left" style="width: 60px">12 mos. Term Kondattam Pack Per mo.</th>
								</tr>
							</thead>
							<tbody>
								<tr>
									<td>Sun TV</td>
									<td>BTV</td>
									<td></td>
									<td></td>
									<td></td>
								</tr>
								<tr>
									<td>Adithya TV</td>
									<td>BTV</td>
									<td></td>
									<td></td>
									<td><?php $this->Record_model->create_chkbox("c7", "$19.90", isset($answers['c7'])?$answers['c7']:0, "$14.90 for 3mths<br />[PTFL0409]", FALSE); ?></td>
								</tr>
								<tr>
									<td>Kalaignar TV</td>
									<td>BTV</td>
									<td>$6.42</td>
									<td>$5.35</td>
									<td></td>
								</tr>
								<tr>
									<td>Jaya TV</td>
									<td>BTV</td>
									<td>$6.42</td>
									<td>$5.35</td>
									<td></td>
								</tr>
							</tbody>
						</table>
						<table cellspacing="0" cellpadding="2" width="100%" style="padding-right: 10px;">
							<thead>
								<tr class="black_bg_table">
									<th align="left">Desi Mini Pack mioTV Channels Subscription on Monthly Term</th>
									<th align="left" style="width: 45px">Type</th>
									<th align="left" style="width: 40px">Per mo. or part thereof</th>
									<th align="left" style="width: 40px">12 mos. Term Per mo.</th>
									<th align="left" style="width: 60px">12 mos. Term Desi Mini Pack Per mo.</th>
								</tr>
							</thead>
							<tbody>
								<tr>
									<td>SAB TV</td>
									<td>BTV</td>
									<td></td>
									<td></td>
									<td></td>
								</tr>
								<tr>
									<td>SET (Hindi)</td>
									<td>BTV</td>
									<td></td>
									<td></td>
									<td><?php $this->Record_model->create_chkbox("c8", "$16.90", isset($answers['c8'])?$answers['c8']:0, "[PTFL0419]", FALSE); ?></td>
								</tr>
								<tr>
									<td>Sony Max</td>
									<td>BTV</td>
									<td></td>
									<td></td>
									<td></td>
								</tr>
							</tbody>
						</table>
						<table cellspacing="0" cellpadding="2" width="100%" style="padding-right: 10px;">
							<thead>
								<tr class="black_bg_table">
									<th align="left">US TV Pack mioTV Channels Subscription on Monthly Term</th>
									<th align="left" style="width: 45px">Type</th>
									<th>Entertainment/ Jingxuan/ Astro/ Bharata Plus Pack</th>
									<th align="left" style="width: 60px">12 mos. Term Per mo.</th>
								</tr>
							</thead>
							<tbody>
								<tr>
									<td>US TV Drama</td>
									<td>On Dd</td>
									<td>$7.00*</td>
									<td></td>
								</tr>
								<tr>
									<td>US TV Thriller</td>
									<td>On Dd</td>
									<td>$7.00*</td>
									<td></td>
								</tr>
								<tr>
									<td>US TV Crime</td>
									<td>On Dd</td>
									<td>$7.00*</td>
									<td><?php $this->Record_model->create_chkbox("c9", "$19.90", isset($answers['c9'])?$answers['c9']:0, "50% off 6 mths<br />[PTFL0333]", FALSE); ?></td>
								</tr>
								<tr>
									<td>US TV Entertainment</td>
									<td>On Dd</td>
									<td>$7.00*</td>
									<td></td>
								</tr>
							</tbody>
						</table>
						<span class="small_txt">*only applicable with Variety Packs</span>
					</td>
				</tr>
			</table>
		</div>
		<div class="pagebreak"></div>
		<div class="body">
			<table cellspacing="0" cellpadding="0" width="100%">
				<tr>
					<td width="50%" valign="top">
						<table cellspacing="0" cellpadding="2" width="100%" style="padding-right: 10px;">
							<thead>
								<tr class="black_bg_table">
									<th align="left">Easy Pack<br />mioTV Channels Subscription<br />on Monthly Term</th>
									<th align="left" style="width: 80px">12 mos. Term Easy Pack Per mo.</th>
								</tr>
							</thead>
							<tbody>
								<tr>
									<td>Easy Jingxuan Pack <br /><span class="small_txt">Includes: ESPN STAR Sports, Entertainment Pack and Jingxuan Pack</span></td>
									<td><?php $this->Record_model->create_chkbox("c10", "$29.90", isset($answers['c10'])?$answers['c10']:0, "50% off 6 mths<br />[PTFL0327]", FALSE); ?></td>
								</tr>
								<tr>
									<td></td>
									<td><?php $this->Record_model->create_chkbox("c11", "$29.90", isset($answers['c11'])?$answers['c11']:0, "4 mths free<br />[PTFL0402]", FALSE); ?></td>
								</tr>
								<tr>
									<td>Easy Astro Pack <br /><span class="small_txt">Includes: ESPN STAR Sports, Entertainment Pack and Astro Pack</span></td>
									<td><?php $this->Record_model->create_chkbox("c12", "$29.90", isset($answers['c12'])?$answers['c12']:0, "50% off 6 mths<br />[PTFL0315]", FALSE); ?></td>
								</tr>
							</tbody>
						</table>
						<table cellspacing="0" cellpadding="2" width="100%" style="padding-right: 10px;">
							<thead>
								<tr class="black_bg_table">
									<th align="left">Sports Channels mioTV Channels Subscription on Monthly Term</th>
									<th align="left" style="width: 45px">Type</th>
									<th align="left" style="width: 50px">Per mo. or part thereof</th>
									<th align="left" style="width: 50px">12 mos. Term Per mo.</th>
									<th align="left" style="width: 50px">12/18 mos. Term Pack Per mo.</th>
								</tr>
							</thead>
							<tbody>
								<tr>
									<td>Cricket Pack</td>
									<td>BTV</td>
									<td><?php $this->Record_model->create_chkbox("c13", "$39.80", isset($answers['c13'])?$answers['c13']:0, "", FALSE); ?></td>
									<td><?php $this->Record_model->create_chkbox("c14", "$19.90", isset($answers['c14'])?$answers['c14']:0, "", FALSE); ?></td>
									<td><?php $this->Record_model->create_chkbox("c15", "$9.90*", isset($answers['c15'])?$answers['c15']:0, "", FALSE); ?></td>
								</tr>
								<tr>
									<td>Sentanta Rugby</td>
									<td>BTV</td>
									<td><?php $this->Record_model->create_chkbox("c16", "$39.80", isset($answers['c16'])?$answers['c16']:0, "", FALSE); ?></td>
									<td><?php $this->Record_model->create_chkbox("c17", "$19.90", isset($answers['c17'])?$answers['c17']:0, "", FALSE); ?></td>
									<td><?php $this->Record_model->create_chkbox("c18", "$9.90*", isset($answers['c18'])?$answers['c18']:0, "", FALSE); ?></td>
								</tr>
								<tr>
									<td>Goal TV Pack</td>
									<td>BTV</td>
									<td><?php $this->Record_model->create_chkbox("c19", "$3.15**", isset($answers['c19'])?$answers['c19']:0, "", FALSE); ?></td>
									<td></td>
									<td></td>
								</tr>
								<tr>
									<td>ASN (HD)</td>
									<td>BTV-HD</td>
									<td><?php $this->Record_model->create_chkbox("c20", "$39.80", isset($answers['c20'])?$answers['c20']:0, "", FALSE); ?></td>
									<td><?php $this->Record_model->create_chkbox("c21", "$19.90", isset($answers['c21'])?$answers['c21']:0, "", FALSE); ?></td>
									<td><?php $this->Record_model->create_chkbox("c22", "$9.90*", isset($answers['c22'])?$answers['c22']:0, "", FALSE); ?></td>
								</tr>
							</tbody>
						</table>
						<span class="small_txt">* Applicable only with Sports Packs</span>
						<br /><span class="small_txt">* Applicable only for Ultimate Pack or mio Home Sports / Explore Home Sports</span>
						<table cellspacing="0" cellpadding="2" width="100%" style="padding-right: 10px;">
							<thead>
								<tr class="black_bg_table">
									<th align="left">Combo Pack<br />mioTV Channels Subscription<br />on Monthly Term</th>
									<th align="left" style="width: 80px">12 mos. Term Combo Pack Per mo.</th>
								</tr>
							</thead>
							<tbody>
								<tr>
									<td>Combo Pack <br /><span class="small_txt">Includes: ESPN STAR Sports, Entertainment Pack and Jingxuan Pack</span></td>
									<td><?php $this->Record_model->create_chkbox("c23", "$29.90", isset($answers['c23'])?$answers['c23']:0, "[PTFL0197]", FALSE); ?></td>
								</tr>
								<tr>
									<td>Combo Pack <br /><span class="small_txt">Includes: ESPN STAR Sports, Entertainment Pack and Jingxuan Pack</span></td>
									<td><?php $this->Record_model->create_chkbox("c32", "$29.90", isset($answers['c32'])?$answers['c32']:0, "1 mth free<br />[PTFL0198]", FALSE); ?></td>
								</tr>
								<tr>
									<td>Astro Combo Pack <br /><span class="small_txt">Includes: ESPN STAR Sports, mioStadium, Entertainment Pack and Astro Pack</span></td>
									<td><?php $this->Record_model->create_chkbox("c24", "$29.90", isset($answers['c24'])?$answers['c24']:0, "[PTFL0191]", FALSE); ?></td>
								</tr>
								<tr>
									<td>Astro Combo Pack <br /><span class="small_txt">Includes: ESPN STAR Sports, mioStadium, Entertainment Pack and Astro Pack</span></td>
									<td><?php $this->Record_model->create_chkbox("c33", "$29.90", isset($answers['c33'])?$answers['c33']:0, "1 mth free<br />[PTFL0192]", FALSE); ?></td>
								</tr>
								<tr>
									<td>Tamil Combo Pack (Bharata Combo + Uthayam Pack) <br /><span class="small_txt">Includes: ESPN STAR Sports, mioStadium, Bharata Pack and Uthayam Pack</span></td>
									<td><?php $this->Record_model->create_chkbox("c25", "$44.80", isset($answers['c25'])?$answers['c25']:0, "[PTFL0194] + <br />[PTFL0418]", FALSE); ?></td>
								</tr>
								<tr>
									<td>Tamil Combo Pack (Bharata Combo + Uthayam Pack) <br /><span class="small_txt">Includes: ESPN STAR Sports, mioStadium, Bharata Pack and Uthayam Pack</span></td>
									<td><?php $this->Record_model->create_chkbox("c34", "$44.80", isset($answers['c34'])?$answers['c34']:0, "1 mth free (Bharata combo only)<br />[PTFL0195] + <br />[PTFL0418]", FALSE); ?></td>
								</tr>
							</tbody>
						</table>
					</td>
					<td width="50%" valign="top">
						<table cellspacing="0" cellpadding="2" width="100%" style="padding-right: 10px;">
							<thead>
								<tr class="black_bg_table">
									<th align="left">Sports Pack Subscription<br />on Monthly Term</th>
									<th align="left" style="width: 80px">12/18 mos. Sports Pack Per mo.</th>
								</tr>
							</thead>
							<tbody>
								<tr>
									<td>Sports Pack</td>
									<td><?php $this->Record_model->create_chkbox("c26", "$34.90", isset($answers['c26'])?$answers['c26']:0, "1 mth Free<br />[PTFL0294]", FALSE); ?></td>
								</tr>
								<tr>
									<td></td>
									<td><?php $this->Record_model->create_chkbox("c27", "$29.90", isset($answers['c27'])?$answers['c27']:0, "[PTFL0251]", FALSE); ?></td>
								</tr>
							</tbody>
						</table>
						<table cellspacing="0" cellpadding="2" width="100%" style="padding-right: 10px;">
							<thead>
								<tr class="black_bg_table">
									<th align="left">Ultimate Pack<br />mioTV Channels Subscription<br />on Monthly Term</th>
									<th align="left" style="width: 80px">12 mos. Term Ultimate Pack Per mo.</th>
								</tr>
							</thead>
							<tbody>
								<tr>
									<td>Includes: mioStadium &amp; ESS, Entertainment, Jingxuan, Astro,<br />(Obsolete) Bharata, US TV Packs</td>
									<td><?php $this->Record_model->create_chkbox("c28", "$39.90", isset($answers['c28'])?$answers['c28']:0, "[PTFL0298]", FALSE); ?></td>
								</tr>
								<tr>
									<td>Includes: mioStadium &amp; ESS, Entertainment, Jingxuan, Astro,<br />(Obsolete) Bharata, US TV Packs</td>
									<td><?php $this->Record_model->create_chkbox("c31", "$39.90", isset($answers['c31'])?$answers['c31']:0, "1 mth free<br />[PTFL0305]", FALSE); ?></td>
								</tr>
							</tbody>
						</table>
						<span class="small_txt">Note: Ultimate Pack excludes GMA Pinoy TV, GoalTV Pack, Cricket Pack, ASN (HD), Setanta Rugbym, Season Pass titles, Mix-N-<br />Match Season Pass and any Video-On-Demand (VOD) content. (i.e. individual n Demand programmes and movies)</span>
						<table cellspacing="0" cellpadding="2" width="100%" style="padding-right: 10px;">
							<thead>
								<tr class="black_bg_table">
									<th align="left">Free VODs</th>
									<th align="left" style="width: 45px">Type</th>
									<th align="left" style="width: 40px"></th>
									<th align="left" style="width: 40px"></th>
									<th align="left" style="width: 60px">With Purchase of Content Packs</th>
								</tr>
							</thead>
							<tbody>
								<tr>
									<td>2 Free VODs per mth for 3 mths</td>
									<td>On Dd</td>
									<td></td>
									<td></td>
									<td><?php $this->Record_model->create_chkbox("c29", "$00.00", isset($answers['c29'])?$answers['c29']:0, "[PTFL0279]", FALSE); ?></td>
								</tr>
							</tbody>
						</table>
					</td>
				</tr>
			</table>
			<br /><br /><br />
			<div>
	    		<input type="hidden" name="sale_id" value="<?php echo $info['id']; ?>" />
	    		<input type="hidden" name="phone_no" value="<?php echo $info['phone_no']; ?>" />
			</div>
			<div style="width:50%; margin:0px auto;">
				__________________________________________________________________________________<?php $this->Record_model->create_chkbox("c30", "%10", isset($answers['c30'])?$answers['c30']:0, "", FALSE); ?><br />
				mio Home/mio Plan/exPlore Home Discount for mio TV content<br />
				<span class="small_txt">(Applicable only for mio Home/mio Plan/exPlore Home subscribers)</span><br />
				<span class="small_txt">Remarks:</span><br />
				<span class="small_txt"><strong>BTV</strong> = Broadcast TV <strong>BTV-HD</strong> = broadcast TV High Definition <strong>On Dd</strong> = On Demand High Definition</span>
			</div>
		</div>
		<input type="submit" name="save_form" value="Save" />
		</form>
	</body>
</html>