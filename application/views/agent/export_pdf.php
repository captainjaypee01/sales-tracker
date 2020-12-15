<html>
	<head>
		<title>Export PDF</title>
		<style type="text/css">
			@page {
	            margin-top: 30px;
	            margin-left: 30px;
	        }

			body {
				font-size: 10px;
				font-family: Arial, Helvetica, sans-serif;
				width: 720px;
				height: 970px;
			}
			
			table {
				font-size: 10px;
			}
			
			#title {
				font-size: 25px;
				text-align: center;
				font-weight: 900;
				margin-bottom: 20px;
			}
			
			.black_bg {
				background-color: #000000;
				color: #FFFFFF;
				font-weight: 900;
				padding: 1px 10px;
				font-size: 11px;
			}
			
			.black_bg_table {
				background-color: #000000;
				color: #FFFFFF;
				text-align: left; 
				vertical-align: top;
				font-size: 9px;
			}
			
			.info_data {
				padding: 10px 0  0 10px;
			}
			
			#head strong {
				font-size: 12px;
			}
			
			.selected {
				background-color: #000;
				color: #FFF;
				font-weight: 900;
			}
			
			.small_txt {
				font-size: 6px;
			}
		</style>
	</head>
	<body>
		<div id="head">
			<div id="title">mioTV Contents Service (Simplified ACA)</div>
			<div id="info">
				<div class="black_bg">Customer's Particulars</div>
				<div class="info_data"><span style="margin-left: 7px;">Name of Applicant: Mr/Miss/Mdm/Dr (as in NRIC/FIN): <strong><?php echo $info['app_name']?></strong></span></div>
				<div class="info_data">
					<table cellpadding="5">
						<tr>
							<td style="width: 210px">NRIC/FIN No: <strong><?php echo $info['NRIC']?></strong></td>
							<td style="width: 210px">Date of Birth (dd/mm/yy): <strong><?php echo $info['dob']?></strong></td>
							<td style="width: 210px">Issue Date (dd/mm/yy): <strong><?php echo date('d/m/Y', strtotime($info['appt_date']));?></strong></td>
						</tr>
						<tr>
							<td style="width: 210px">IPTV No: <strong><?php echo $info['IPTV_NO']?></strong></td>
							<td style="width: 210px">Telephone: <strong><?php echo $info['phone_no']?></strong></td>
							<td style="width: 210px">Mobile: <strong><?php echo $info['mobile_no']?></strong></td>
						</tr>
						<tr>
							<td style="width: 210px">Dealer ID: <strong>D2566</strong></td>
							<td style="width: 210px">Salesman code: <strong>5945</strong></td>
							<td style="width: 210px">Salesman name: <strong><?php echo $info['agent_id']?></strong></td>
						</tr>
					</table>
				</div>
				<div class="black_bg" style="margin-bottom: 15px;">mioTV Ala-Carte Services</div>
			</div>
		</div>
		<div id="body">
			<table cellspacing="0" cellpadding="0" width="100%">
				<tr>
					<td width="50%">
						<table cellspacing="0" cellpadding="3" width="100%" style="padding-right: 10px;">
							<thead>
								<tr class="black_bg_table">
									<th align="left">Entertainment Pack mio TV Channels Subscription on Monthly Term</th>
									<th align="left" style="width: 45px">Type</th>
									<th align="left" style="width: 40px">Per mo. or part thereof</th>
									<th align="left" style="width: 40px">12 mos. Term Per mo.</th>
									<th align="left" style="width: 60px">12 mos. Term Entertainment Pack Per mo.</th>
								</tr>
							</thead>
							<tbody style=" font-size: 9px;">
								<tr>
									<td>Fox on Demand</td>
									<td>On Dd</td>
									<td <?php echo (isset($answers[1][1]) AND $answers[1][1] == 12.84) ? 'class="selected"' : '';?>>$12.84</td>
									<td <?php echo (isset($answers[1][1]) AND $answers[1][1] == 11.56) ? 'class="selected"' : '';?>>$11.56</td>
									<td></td>
								</tr>
								<tr>
									<td>KIX HD</td>
									<td>BTV-HD</td>
									<td <?php echo (isset($answers[1][2]) AND $answers[1][2] == 12.84) ? 'class="selected"' : '';?>>$12.84</td>
									<td></td>
									<td></td>
								</tr>
								<tr>
									<td>PictureBox</td>
									<td>On Dd</td>
									<td <?php echo (isset($answers[1][3]) AND $answers[1][3] == 12.84) ? 'class="selected"' : '';?>>$12.84</td>
									<td <?php echo (isset($answers[1][3]) AND $answers[1][3] == 11.56) ? 'class="selected"' : '';?>>$11.56</td>
									<td></td>
								</tr>
								<tr>
									<td>Sont Entertainment Television</td>
									<td>BTV</td>
									<td <?php echo (isset($answers[1][4]) AND $answers[1][4] == 8.56) ? 'class="selected"' : '';?>>$8.56</td>
									<td <?php echo (isset($answers[1][4]) AND $answers[1][4] == 6.42) ? 'class="selected"' : '';?>>$6.42</td>
									<td></td>
								</tr>
								<tr>
									<td>Sundance Channel (HD)</td>
									<td>BTV-HD</td>
									<td <?php echo (isset($answers[1][5]) AND $answers[1][5] == 12.84) ? 'class="selected"' : '';?>>$12.84</td>
									<td <?php echo (isset($answers[1][5]) AND $answers[1][5] == 10.70) ? 'class="selected"' : '';?>>$10.70</td>
									<td <?php echo (isset($answers[1][0]) AND $answers[1][0] == 21.90) ? 'class="selected"' : '';?>>$21.90<br><span class="small_txt">50% off for 6mths</span></td>
								</tr>
								<tr>
									<td>Sundance Channel on Demand (HD)</td>
									<td>On Dd-HD</td>
									<td <?php echo (isset($answers[1][6]) AND $answers[1][6] == 10.70) ? 'class="selected"' : '';?>>$10.70</td>
									<td <?php echo (isset($answers[1][6]) AND $answers[1][6] == 8.56) ? 'class="selected"' : '';?>>$8.56</td>
									<td></td>
								</tr>
								<tr>
									<td>The Film Factory</td>
									<td>On Dd</td>
									<td <?php echo (isset($answers[1][7]) AND $answers[1][7] == 12.84) ? 'class="selected"' : '';?>>$12.84</td>
									<td <?php echo (isset($answers[1][7]) AND $answers[1][7] == 11.56) ? 'class="selected"' : '';?>>$11.56</td>
									<td></td>
								</tr>
							</tbody>
						</table>
						<table cellspacing="0" cellpadding="3" width="100%" style="padding-right: 10px;">
							<thead>
								<tr class="black_bg_table">
									<th align="left">Jingxuan Pack mio TV Channels Subscription on Monthly Term</th>
									<th align="left" style="width: 45px">Type</th>
									<th align="left" style="width: 40px">Per mo. or part thereof</th>
									<th align="left" style="width: 40px">12 mos. Term Per mo.</th>
									<th align="left" style="width: 60px">12 mos. Term Entertainment Pack Per mo.</th>
								</tr>
							</thead>
							<tbody style=" font-size: 9px;">
								<tr>
									<td>CCTV-4</td>
									<td>BTV</td>
									<td <?php echo (isset($answers[2][8]) AND $answers[2][8] == 4.28) ? 'class="selected"' : '';?>>$4.28</td>
									<td <?php echo (isset($answers[2][8]) AND $answers[2][8] == 3.21) ? 'class="selected"' : '';?>>$3.21</td>
									<td></td>
								</tr>
								<tr>
									<td>Celestial Movies Channel</td>
									<td>BTV</td>
									<td <?php echo (isset($answers[2][10]) AND $answers[2][10] == 9.90) ? 'class="selected"' : '';?>>$9.90</td>
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
									<td>Jia Le Channel</td>
									<td>BTV</td>
									<td <?php echo (isset($answers[2][12]) AND $answers[2][12] == 9.90) ? 'class="selected"' : '';?>>$9.90</td>
									<td></td>
									<td></td>
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
									<td <?php echo (isset($answers[2][14]) AND $answers[2][14] == 10.70) ? 'class="selected"' : '';?>>$10.70</td>
									<td <?php echo (isset($answers[2][14]) AND $answers[2][14] == 8.56) ? 'class="selected"' : '';?>>$8.56</td>
									<td <?php echo (isset($answers[2][0]) AND $answers[2][0] == 21.90) ? 'class="selected"' : '';?>>$21.90<br><span class="small_txt">50% off for 6mths</span></td>
								</tr>
								<tr>
									<td>Mei Ah Movies On Demand</td>
									<td>On Dd</td>
									<td <?php echo (isset($answers[2][15]) AND $answers[2][15] == 12.84) ? 'class="selected"' : '';?>>$12.84</td>
									<td <?php echo (isset($answers[2][15]) AND $answers[2][15] == 11.56) ? 'class="selected"' : '';?>>$11.56</td>
									<td></td>
								</tr>
								<tr>
									<td>mobtv SELECT</td>
									<td>On Dd</td>
									<td <?php echo (isset($answers[2][16]) AND $answers[2][16] == 8.56) ? 'class="selected"' : '';?>>$8.56</td>
									<td <?php echo (isset($answers[2][16]) AND $answers[2][16] == 7.70) ? 'class="selected"' : '';?>>$7.70</td>
									<td></td>
								</tr>
								<tr>
									<td>ONE HD</td>
									<td>BTV</td>
									<td <?php echo (isset($answers[2][17]) AND $answers[2][17] == 6.42) ? 'class="selected"' : '';?>>$6.42</td>
									<td></td>
									<td></td>
								</tr>
								<tr>
									<td>Xinya Azio</td>
									<td>BTV</td>
									<td <?php echo (isset($answers[2][18]) AND $answers[2][18] == 5.35) ? 'class="selected"' : '';?>>$5.35</td>
									<td <?php echo (isset($answers[2][18]) AND $answers[2][18] == 4.28) ? 'class="selected"' : '';?>>$4.28</td>
									<td></td>
								</tr>
							</tbody>
						</table>
						<table cellspacing="0" cellpadding="3" width="100%" style="padding-right: 10px;">
							<thead>
								<tr class="black_bg_table">
									<th align="left">Astro Pack mio TV Channels Subscription on Monthly Term</th>
									<th align="left" style="width: 45px">Type</th>
									<th align="left" style="width: 40px">Per mo. or part thereof</th>
									<th align="left" style="width: 40px">12 mos. Term Per mo.</th>
									<th align="left" style="width: 60px">12 mos. Term Entertainment Pack Per mo.</th>
								</tr>
							</thead>
							<tbody style=" font-size: 9px;">
								<tr>
									<td>Astro Aruna</td>
									<td>BTV</td>
									<td <?php echo (isset($answers[3][19]) AND $answers[3][19] == 10.70) ? 'class="selected"' : '';?>>$10.70</td>
									<td <?php echo (isset($answers[3][19]) AND $answers[3][19] == 8.56) ? 'class="selected"' : '';?>>$8.56</td>
									<td></td>
								</tr>
								<tr>
									<td>Astro Ria</td>
									<td>BTV</td>
									<td <?php echo (isset($answers[3][20]) AND $answers[3][20] == 8.56) ? 'class="selected"' : '';?>>$8.56</td>
									<td <?php echo (isset($answers[3][20]) AND $answers[3][20] == 6.42) ? 'class="selected"' : '';?>>$6.42</td>
									<td <?php echo (isset($answers[3][0]) AND $answers[3][0] == 11.00) ? 'class="selected"' : '';?>>$11.00<br><span class="small_txt">50% off for 3mths</span></td>
								</tr>
								<tr>
									<td>Astro World</td>
									<td>On Dd</td>
									<td <?php echo (isset($answers[3][21]) AND $answers[3][21] == 6.42) ? 'class="selected"' : '';?>>$6.42</td>
									<td <?php echo (isset($answers[3][21]) AND $answers[3][21] == 5.78) ? 'class="selected"' : '';?>>$5.78</td>
									<td></td>
								</tr>
							</tbody>
						</table>
						<table cellspacing="0" cellpadding="3" width="100%" style="padding-right: 10px;">
							<thead>
								<tr class="black_bg_table">
									<th align="left">Bharata Pack mio TV Channels Subscription on Monthly Term</th>
									<th align="left" style="width: 45px">Type</th>
									<th align="left" style="width: 40px">Per mo. or part thereof</th>
									<th align="left" style="width: 40px">12 mos. Term Per mo.</th>
									<th align="left" style="width: 60px">12 mos. Term Entertainment Pack Per mo.</th>
								</tr>
							</thead>
							<tbody style=" font-size: 9px;">
								<tr>
									<td>Colors</td>
									<td>BTV</td>
									<td <?php echo (isset($answers[4][22]) AND $answers[4][22] == 6.42) ? 'class="selected"' : '';?>>$6.42</td>
									<td <?php echo (isset($answers[4][22]) AND $answers[4][22] == 5.35) ? 'class="selected"' : '';?>>$5.35</td>
									<td></td>
								</tr>
								<tr>
									<td>MTV India</td>
									<td>BTV</td>
									<td <?php echo (isset($answers[4][23]) AND $answers[4][23] == 4.28) ? 'class="selected"' : '';?>>$4.28</td>
									<td <?php echo (isset($answers[4][23]) AND $answers[4][23] == 3.21) ? 'class="selected"' : '';?>>$3.21</td>
									<td <?php echo (isset($answers[4][0]) AND $answers[4][0] == 11.00) ? 'class="selected"' : '';?>>$11.00</td>
								</tr>
								<tr>
									<td>Kalaignar TV</td>
									<td>BTV</td>
									<td <?php echo (isset($answers[4][24]) AND $answers[4][24] == 6.42) ? 'class="selected"' : '';?>>$6.42</td>
									<td <?php echo (isset($answers[4][24]) AND $answers[4][24] == 5.35) ? 'class="selected"' : '';?>>$5.35</td>
									<td></td>
								</tr>
								<tr>
									<td>EROS Bollywood</td>
									<td>BTV</td>
									<td <?php echo (isset($answers[4][25]) AND $answers[4][25] == 10.70) ? 'class="selected"' : '';?>>$10.70</td>
									<td <?php echo (isset($answers[4][25]) AND $answers[4][25] == 9.63) ? 'class="selected"' : '';?>>$9.63</td>
									<td></td>
								</tr>
								<tr>
									<td>Jaya TV</td>
									<td>BTV</td>
									<td <?php echo (isset($answers[4][26]) AND $answers[4][26] == 6.42) ? 'class="selected"' : '';?>>$6.42</td>
									<td <?php echo (isset($answers[4][26]) AND $answers[4][26] == 5.35) ? 'class="selected"' : '';?>>$5.35</td>
									<td></td>
								</tr>
							</tbody>
						</table>
						<table cellspacing="0" cellpadding="3" width="100%" style="padding-right: 10px;">
							<thead>
								<tr class="black_bg_table">
									<th align="left">US TV Pack Pack mio TV Channels Subscription on Monthly Term</th>
									<th align="left" style="width: 45px">Type</th>
									<th>Entertainment/ Jingxuan/ Astro/ Bharata Plus Pack</th>
									<th align="left" style="width: 60px">12 mos. Term Per mo.</th>
								</tr>
							</thead>
							<tbody style=" font-size: 9px;">
								<tr>
									<td>US TV Drama</td>
									<td>On Dd</td>
									<td <?php echo (isset($answers[5][27]) AND $answers[5][27] == 7.00) ? 'class="selected"' : '';?>>$7.00</td>
									<td></td>
								</tr>
								<tr>
									<td>US TV Thriller</td>
									<td>On Dd</td>
									<td <?php echo (isset($answers[5][28]) AND $answers[5][28] == 7.00) ? 'class="selected"' : '';?>>$7.00</td>
									<td <?php echo (isset($answers[5][0]) AND $answers[5][0] == 19.90) ? 'class="selected"' : '';?>>$19.90</td>
								</tr>
								<tr>
									<td>US TV Crime</td>
									<td>On Dd</td>
									<td <?php echo (isset($answers[5][29]) AND $answers[5][29] == 7.00) ? 'class="selected"' : '';?>>$7.00</td>
									<td></td>
								</tr>
								<tr>
									<td>US TV Entertainment</td>
									<td>On Dd</td>
									<td <?php echo (isset($answers[5][30]) AND $answers[5][30] == 7.00) ? 'class="selected"' : '';?>>$7.00</td>
									<td></td>
								</tr>
							</tbody>
						</table>
					</td>
					<td valign="top">
						<table cellspacing="0" width="100%">
							<thead>
								<tr class="black_bg_table">
									<th align="left">mio TV Sports Packs Subscription on Monthly Term</th>
									<th align="left" style="width: 50px"></th>
									<th align="left" style="width: 50px"></th>
									<th align="left" style="width: 40px"></th>
									<th align="left" style="width: 70px">18 mos. Term Per mo.</th>
								</tr>
							</thead>
							<tbody style=" font-size: 9px;">
								<tr>
									<td>Sports Pack</td>
									<td></td>
									<td></td>
									<td></td>
									<td <?php echo (isset($answers[6][31]) AND $answers[6][31] == 34.90) ? 'class="selected"' : '';?>>$34.90</td>
								</tr>
							</tbody>
						</table>
						<table cellspacing="0" cellpadding="3" width="100%" style="padding-right: 10px;">
							<thead>
								<tr class="black_bg_table">
									<th align="left">mio TV Sports Packs Subscription on Monthly Term</th>
									<th align="left" style="width: 45px">Type</th>
									<th align="left" style="width: 40px">12 mos. Term Per mo.</th>
									<th align="left" style="width: 40px">Per mo. or part thereof</th>
									<th align="left" style="width: 40px">12 mos. Term Per mo.</th>
								</tr>
							</thead>
							<tbody style=" font-size: 9px;">
								<tr>
									<td>Cricket Pack</td>
									<td>BTV</td>
									<td>$9.90</td>
									<td>$39.80</td>
									<td>$19.90</td>
								</tr>
								<tr>
									<td>Sentanta Rugby</td>
									<td>BTV</td>
									<td>$9.90</td>
									<td>$39.80</td>
									<td>$19.90</td>
								</tr>
								<tr>
									<td>Goal TV Pack</td>
									<td>BTV</td>
									<td></td>
									<td>$3.15</td>
									<td></td>
								</tr>
								<tr>
									<td>ASN (HD)</td>
									<td>BTV-HD</td>
									<td>$9.90</td>
									<td>$39.80</td>
									<td>$19.90</td>
								</tr>
							</tbody>
						</table>
						<table cellspacing="0" cellpadding="3" width="100%" style="padding-right: 10px;">
							<thead>
								<tr class="black_bg_table">
									<th align="left">Other mio TV Channels Subscription on Monthly Term</th>
									<th align="left" style="width: 45px">Type</th>
									<th align="left" style="width: 40px"></th>
									<th align="left" style="width: 40px">Per mo. or part thereof</th>
									<th align="left" style="width: 40px">12 mos. Term Per mo.</th>
								</tr>
							</thead>
							<tbody style=" font-size: 9px;">
								<tr>
									<td>GMA Pinoy TV</td>
									<td>BTV</td>
									<td></td>
									<td <?php echo (isset($answers[7][33]) AND $answers[7][33] == 14.98) ? 'class="selected"' : '';?>>$14.98</td>
									<td></td>
								</tr>
							</tbody>
						</table>
						<table cellspacing="0" cellpadding="3" width="100%" style="padding-right: 10px;">
							<thead>
								<tr class="black_bg_table">
									<th align="left">Easy Pack</th>
									<th align="left" style="width: 40px">12 mos. Term Per mo.</th>
								</tr>
							</thead>
							<tbody style=" font-size: 9px;">
								<tr>
									<td>Easy Jingxuan Pack <br />Includes: ESPN STAR Sports, Entertainment Pack and Jingxuan Pack</td>
									<td <?php echo (isset($answers[8][34]) AND $answers[8][34] == 29.90) ? 'class="selected"' : '';?>>$29.90</td>
								</tr>
								<tr>
									<td>Easy Astro Pack <br />Includes: ESPN STAR Sports, Entertainment Pack and Astro Pack</td>
									<td <?php echo (isset($answers[8][39]) AND $answers[8][39] == 29.90) ? 'class="selected"' : '';?>>$29.90</td>
								</tr>
								<tr>
									<td>Easy Bharata Pack <br />Includes: ESPN STAR Sports, Entertainment Pack and Bharata Pack</td>
									<td <?php echo (isset($answers[8][40]) AND $answers[8][40] == 29.90) ? 'class="selected"' : '';?>>$29.90</td>
								</tr>
							</tbody>
						</table>
						<table cellspacing="0" cellpadding="3" width="100%" style="padding-right: 10px;">
							<thead>
								<tr class="black_bg_table">
									<th align="left">Ultimate Pack</th>
									<th align="left" style="width: 45px"></th>
									<th align="left" style="width: 40px">12 mos. Term Per mo.</th>
									<th align="left" style="width: 40px"></th>
								</tr>
							</thead>
							<tbody style=" font-size: 9px;">
								<tr>
									<td>Includes: mio Stadium & ESPN STAR Sports <br />Entertainment, Jingxuan, Astra, Bharata, US TV Packs</td>
									<td></td>
									<td <?php echo (isset($answers[9][41]) AND $answers[9][41] == 39.90) ? 'class="selected"' : '';?>>$39.90</td>
									<td></td>
								</tr>
							</tbody>
						</table>
						<table cellspacing="0" cellpadding="3" width="100%" style="padding-right: 10px;">
							<thead>
								<tr class="black_bg_table">
									<th align="left">Desi Mini Pack mio TV Channels Subscription on Monthly Term</th>
									<th align="left" style="width: 45px">Type</th>
									<th align="left" style="width: 40px">Per mo. or part thereof</th>
									<th align="left" style="width: 40px">12 mos. Term Per mo.</th>
									<th align="left" style="width: 60px">12 mos. Term Desi Mini Pack Per mo.</th>
								</tr>
							</thead>
							<tbody style=" font-size: 9px;">
								<tr>
									<td>SET Hindi</td>
									<td>BTV</td>
									<td></td>
									<td></td>
									<td></td>
								</tr>
								<tr>
									<td>SAB TV</td>
									<td>BTV</td>
									<td></td>
									<td></td>
									<td <?php echo (isset($answers[10][0]) AND $answers[10][0] == 16.90) ? 'class="selected"' : '';?>>$16.90</td>
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
						<table cellspacing="0" cellpadding="3" width="100%" style="padding-right: 10px;">
							<thead>
								<tr class="black_bg_table">
									<th align="left">Desi Pack mio TV Channels Subscription on Monthly Term</th>
									<th align="left" style="width: 45px">Type</th>
									<th align="left" style="width: 40px">Per mo. or part thereof</th>
									<th align="left" style="width: 40px">12 mos. Term Per mo.</th>
									<th align="left" style="width: 60px">12 mos. Term Desi Pack Per mo.</th>
								</tr>
							</thead>
							<tbody style=" font-size: 9px;">
								<tr>
									<td>SET Hindi</td>
									<td>BTV</td>
									<td></td>
									<td></td>
									<td></td>
								</tr>
								<tr>
									<td>SAB TV</td>
									<td>BTV</td>
									<td></td>
									<td></td>
									<td <?php echo (isset($answers[11][0]) AND $answers[11][0] == 29.90) ? 'class="selected"' : '';?>>$29.90</td>
								</tr>
								<tr>
									<td>Sony Max</td>
									<td>BTV</td>
									<td></td>
									<td></td>
									<td></td>
								</tr>
								<tr>
									<td>Colors</td>
									<td>BTV</td>
									<td></td>
									<td></td>
									<td></td>
								</tr>
								<tr>
									<td>MTV India</td>
									<td>BTV</td>
									<td></td>
									<td></td>
									<td></td>
								</tr>
								<tr>
									<td>EROS Bollywood</td>
									<td>BTV</td>
									<td></td>
									<td></td>
									<td></td>
								</tr>
							</tbody>
						</table>
					</td>
				</tr>
			</table>
		</div>
		<div id="body">
			<table cellspacing="0" cellpadding="0" width="100%">
				<tr>
					<td width="50%">
						<table cellspacing="0" cellpadding="3" width="100%" style="padding-right: 10px;">
							<thead>
								<tr class="black_bg_table">
									<th align="left">Desi Pack mio TV Channels Subscription on Monthly Term</th>
									<th align="left" style="width: 45px">Type</th>
									<th align="left" style="width: 40px"></th>
									<th align="left" style="width: 40px"></th>
									<th align="left" style="width: 60px">With Purchase of Content Packs</th>
								</tr>
							</thead>
							<tbody style=" font-size: 9px;">
								<tr>
									<td>2 Free VODs per mth for 3 Mths</td>
									<td>On Dd</td>
									<td></td>
									<td></td>
									<td <?php echo (isset($answers[12][0]) AND $answers[12][0] == 0.00 ? 'class="selected"' : '');?>>$0.00</td>
								</tr>
							</tbody>
						</table>
					</td>
					<td width="50%">
						________________________________________________________<br />
						mio Home/mio Plan/exPlore Home Discount for mio TV content<br />
						(Applicable only for mio Home/mio Plan subscribers)<br />
						Remarks:<br />
						BTV = Broadcast TV BTV-HD = broadcast TV High Definition On Dd = On Demand High Definition
					</td>
				</tr>
			</table>
		</div>
	</body>
</html>