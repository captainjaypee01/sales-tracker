		<div class="clearFix"></div>
		<div class="contentBody">
			<div class="contentTitle">Calculator</div>
			<div class="clearFix"></div>
			<div class="leftcontentBody">
				<ul>
					<li><a href="<?php echo base_url().'agent'; ?>">Search</a></li>
					<li><a href="<?php echo base_url(); ?>agent/calculator">Calculator</a></li>
					<li><a href="<?php echo base_url(); ?>login/logout">Logout</a></li>
				</ul>
	        </div>
	        <div class="rightcontentBody">
        		<div class="frm_container">
	        		<div class="frm_heading"><span>Calculator</span></div>
	        		<div class="frm_inputs">
	        			<script>
						  $(function() {
						    $( "#format" ).buttonset();
						  });
						  </script>
						<div id="row_notes">
							<span id="standalone_note" class="ctype_notes" style="display: none;">
								<p><b>Stand Alone Customer is entitled to:</b></p>
								<p style="font-size: 10px;">&gt;&gt; Applicable Monthly Promotion of each Package</p>
							</span>
							<span id="bundle_note" class="ctype_notes" style="display: none;">
								<p><b>Bundle Customer is entitled to:</b></p>
								<p style="font-size: 10px;"> &gt;&gt; $20 discount for Combo or Premium Pack</p>
								<p style="font-size: 10px;"> &gt;&gt; Applicable Monthly Promotion of each Package</p>
								<p style="font-size: 10px;"> &gt;&gt; 10% discount on all Mio TV Contents</p>
							</span>
							<span id="standalone_mio_note" class="ctype_notes" style="display: none;">
								<p><b>Stand Alone Customer with Mio Plan is entitled to:</b></p>
								<p style="font-size: 10px;">&gt;&gt; Applicable Monthly Promotion of each Package</p>
								<p style="font-size: 10px;"> &gt;&gt; 10% discount on all Mio TV Contents</p>
							</span>
							<span><p><b>Promotion Details:</b></p></span>
							<span id="promotion_detail" style="font-size: 10px;"></span>
						</div>
		        		<table class="form_tbl" width="100%">
		        			<tr>
								<td width="160">Select Discount Groups:</td>
								<td>
									<form action="" method="POST" name="form_discounts">
										<div id="format">
											<?php foreach($discount_groups->result() as $row): ?>
												<input type="radio" class="discount_radio" name="discount[]" id="discount_<?php echo $row->id; ?>" value="<?php echo $row->id; ?>" <?php echo in_array($row->id, $selected_groups)?'checked="checked"':'';  ?> onclick="this.form.submit();" /><label for="discount_<?php echo $row->id; ?>"><?php echo $row->name; ?></label>
											<?php endforeach; ?>
										</div>
									</form>
								</td>
							</tr>
		        			<?php if(isset($_POST['discount']) AND count($_POST['discount']) > 0) : ?>
		        			<tr>
								<td>Customer Type:</td>
								<td>
									<div id="cust_types">
										<?php foreach ($cust_type->result() as $row): ?>
										<input type="radio" name="ctypes" id="<?php echo $row->name; ?>" value="<?php echo $row->name; ?>" /><label for="<?php echo $row->name; ?>"><?php echo $row->name; ?></label>
										<?php endforeach; ?>
									    <!-- <input type="radio" id="standalone" name="ctypes" value="standalone" /><label for="standalone">Standalone</label>
									    <input type="radio" id="bundle" name="ctypes" value="bundle" /><label for="bundle">Bundle</label>
									    <input type="radio" id="standalone_mio" name="ctypes" value="standalone_mio" /><label for="standalone_mio">Standalone + MIO</label> -->
									</div>
									<!-- <?php echo form_dropdown('customer', array('standalone' => 'Standalone', 'bundle' => 'Bundle', 'standalone_mio' => 'Standalone with MIO Plan')); ?> -->
								</td>
							</tr>
							
							<tr id="row_contents" style="display: none;">
								<td>Content:</td>
								<td>
									<select id="contents" name="contents" multiple="multiple" style="width:400px;">
									<?php foreach($contents->result() as $row): ?>
										<option value="<?php echo $row->value; ?>"><?php echo $row->name; ?></option>
									<?php endforeach; ?>
									</select>
								</td>
							</tr>
							<tr id="stb_contents" style="display: none;">
								<td>STB:</td>
								<td>
									<select id="stbs" name="stbs" multiple="multiple" style="width:400px;">
									<?php foreach($stbs->result() as $row): ?>
										<option value="<?php echo $row->value; ?>"><?php echo $row->name; ?></option>
									<?php endforeach; ?>
									</select>
								</td>
							</tr>
							<tr id="bundle_contents" style="display: none;">
								<td>Bundle:</td>
								<td>
									<select id="bundles" name="bundles" multiple="multiple" style="width:400px;">
									<?php foreach($bundles->result() as $row): ?>
										<option value="<?php echo $row->value; ?>"><?php echo $row->name; ?></option>
									<?php endforeach; ?>
									</select>
								</td>
							</tr>
		        			<tr>
								<td>Monthly Subscription:</td>
								<td>
									<div id="result_table"></div>
								</td>
							</tr>
							<?php endif; ?>
		        		</table>
		        		
	        		</div>
        		</div>
	        </div>
	        <div class="clearFix"></div>
	        <script>
	        	var myPrices = {};
	        	var mySTB = {};
	        	var myBundle = {};
	        	/*$.getJSON('<?php echo site_url("agent/json_prices"); ?>', function(data) {
				  myPrices = data;
				  //console.log(data);
				});*/

				$.post('<?php echo site_url("agent/json_prices"); ?>', {id:<?php echo json_encode($selected_groups); ?>}, function(data, textStatus) {
				  //data contains the JSON object
				  //textStatus contains the status: success, error, etc
				  myPrices = data;
				  console.log(data);
				  console.log(<?php echo json_encode($selected_groups); ?>);
				}, "json");

				$.post('<?php echo site_url("agent/json_stbs"); ?>', {id:<?php echo json_encode($selected_groups); ?>}, function(data, textStatus) {
				  //data contains the JSON object
				  //textStatus contains the status: success, error, etc
				  
				  mySTB = data;
				  console.log(data);
				  console.log(<?php echo json_encode($selected_groups); ?>);
				}, "json");

				$.post('<?php echo site_url("agent/json_bundle"); ?>', {id:<?php echo json_encode($selected_groups); ?>}, function(data, textStatus) {
				  //data contains the JSON object
				  //textStatus contains the status: success, error, etc
				  
				  myBundle = data;
				  console.log(data);
				  console.log(<?php echo json_encode($selected_groups); ?>);
				}, "json");

		        $( "#cust_types" ).buttonset();
		        $( ":checkbox" ).button();

		        //this will fire where agent checked/unchecked a content in the dropdown
		        $("#bundles")
		        .multiselect({
		        	header: "Select an option",
   					noneSelectedText: "Select an Option"
		        });

		        $("#bundles")
		        .multiselect({
		        	click: function(e){
				       if( $(this).multiselect("widget").find("input:checked").length > 1 ){
				           return false;
				       } else {
				           compute_total();
				       }
				    }
		        });

		        $("#contents, #stbs")
		        .multiselect({
		        	header: '<a class="ui-multiselect-none" href="#"><span class="ui-icon ui-icon-closethick"></span><span>Uncheck all</span></a>',

   					noneSelectedText: "Select an Option",

		        	click: function(){
			        	compute_total();
					},
					uncheckAll: function(){
			        	compute_total();
					},
					checkAll: function(){
			        	compute_total();
					}
		        });

		        var cust_type = "";
	        	var string_contents = "";
	        	var total_price = 0;

		        //show contents options where customer type was selected
		        $( ":radio" ).not('.discount_radio').click(function() {
		        	
		       		//store selected customer type into variable
		       		cust_type = $(this).attr("id");

		        	//show contents dropdown
		       		$( "#row_contents" ).show();
		       		//show stb dropdown
		       		$( "#stb_contents" ).show();
		       		//show notes
		       		$( "#row_notes" ).dialog({
		       			position: { my: "right top", at: "right top", of: ".contentBody" }
		       		});


		       		$( "#row_notes" ).show(0, function(){
		       			$(".ctype_notes").hide();

						$("#" + cust_type + "_note").show();		       			
		       		});
		       		if($(this).val() == 'bundle') {
			       		//show bundle dropdown
			       		$( "#bundle_contents" ).show();
		       		} else {
		       			$("#bundles").multiselect("uncheckAll");
		       			$( "#bundle_contents" ).hide();
		       		}
		       		//call
		       		compute_total();
		        });

		        
				

		        /**
	        	 * This function will compute for the total price of
	        	 * every selected content and display it.
	        	 */
				function compute_total() {
					//always reset total_price to zero and string to blank
		        	total_price = 0;
		        	string_contents = "";
		        	
					var _price_monthly_all = {};
					var _price_monthly_all_stb = {};
					var _price_monthly_all_bundle = {};
					var _stb_discount = {};
					var _promotions_detail = {};
		        	$('#result_table').empty();
					
		        	//get all checked contents and store it on array
					var checked_contents = $("#contents").multiselect("getChecked").map(function(){
					   return this;	
					}).get();

					if(checked_contents.length > 0) {

						//loop on array
						jQuery.each(checked_contents, function() {
							//monthly prices container
							var _price_monthly = [];

							//get regular price
							var _price = myPrices[cust_type][this.value]['price'];

							//get discounts object
							var _discount_obj = myPrices[cust_type][this.value]['discount'];
							
							//create promotion details
							var _discount_temp = []; 
							for (var key in _discount_obj) {
							   var obj = _discount_obj[key];
							   _discount_temp.push(prettyfy_discount(obj));
							}
						   _promotions_detail[this.title] = _discount_temp;

							//loop on 12 months
							for(i=1;i<=13;i++) {
							   var temp_price = _price;
								//loop on all discounts
								for (var key in _discount_obj) {
								   var obj = _discount_obj[key];
									//check if discount applied on the current month
									if(i <= obj['duration']) {

										if(obj['type'] == 'stb') {
											//store discount
											_stb_discount = obj;
											//console.log(_stb_discount);
										}
										//compute for discounts
										if(obj['type'] == 'percent') {
											temp_price = Math.round((temp_price - (temp_price * obj['value']))*1000)/1000;
										} else if(obj['type'] == 'fixed') {
											temp_price = Math.round((temp_price - obj['value'])*1000)/1000;
										} else if(obj['type'] == 'free') {
											//temp_price = 'Free';
											temp_price = 0;
											break;
										}
									} else {
										temp_price = Math.round(temp_price * 1000)/1000;
									}
								}
								_price_monthly.push(temp_price);
							}
							_price_monthly_all[this.title] = _price_monthly;
					   	});
					}

					//get all checked stb and store it on array
					var checked_stbs = $("#stbs").multiselect("getChecked").map(function(){
					   return this;	
					}).get();

					if(checked_stbs.length > 0) {
						
						table_stb = table;
						var loop = 0;
						//loop on array
						jQuery.each(checked_stbs, function() {
							//loop counter to determine the first stb to apply the discount
							loop = loop + 1;
							//monthly prices container
							var _price_monthly_stb = [];
							
							var _price = mySTB[cust_type][this.value]['price'];

							//loop on 12 months
							for(i=1;i<=13;i++) {
							   var temp_price = _price;

								//check if first loop and not recontract
								if(i <= _stb_discount['duration'] && loop == 1 && this.value.substring(this.value.length - 2) != 're') {
									//compute for discounts
									temp_price = Math.round((temp_price - (temp_price * _stb_discount['value']))*1000)/1000;
								} else {
									temp_price = Math.round(temp_price * 1000)/1000;
								}
								
								_price_monthly_stb.push(temp_price);
							}
							_price_monthly_all_stb[this.title] = _price_monthly_stb;
						});
					}


					//get all checked bundle and store it on array
					var checked_bundles = $("#bundles").multiselect("getChecked").map(function(){
					   return this;	
					}).get();

					if(checked_bundles.length > 0) {
						
						table_bundle = table;
						//loop on array
						jQuery.each(checked_bundles, function() {
							//monthly prices container
							var _price_monthly_bundle = [];
							
							var _price = myBundle[cust_type][this.value]['price'];

							//loop on 12 months
							for(i=1;i<=13;i++) {
								_price_monthly_bundle.push(Math.round(_price * 1000)/1000);
							}
							_price_monthly_all_bundle[this.title] = _price_monthly_bundle;
						});

					}

					//////////////////////////////////
					//			Create table		//
					//////////////////////////////////
					
					var monthly_total = new Array(0,0,0,0,0,0,0,0,0,0,0,0,0);
					//create result table with header
					var table = $('<table style="width:100%" class="tablesorter"></table>');
					table.append('<thead><th>Type</th><th>Name</th><th>1st</th><th>2nd</th><th>3rd</th><th>4th</th><th>5th</th><th>6th</th><th>7th</th><th>8th</th><th>9th</th><th>10th</th><th>11th</th><th>12th</th><th>13th - onwards</th></thead>');

					//loop on all checked contents
					for (var key in _price_monthly_all) {
						var obj = _price_monthly_all[key];

						var table_row = $('<tr></tr>');
						table_row.append('<td>CONTENT</td>');
						table_row.append('<td>' + key + '</td>');
						for(var j=0; j<13; j++) {
							var table_td = $('<td style="text-align:center;"></td>');
							table_td.append(obj[j]);
							monthly_total[j] = monthly_total[j] + obj[j];
							table_row.append(table_td);
						}
					    table.append(table_row);
					}

					//loop on all checked stb
					for (var key in _price_monthly_all_stb) {
						var obj = _price_monthly_all_stb[key];

						var table_row = $('<tr></tr>');
						table_row.append('<td>STB</td>');
						table_row.append('<td>' + key + '</td>');
						for(var j=0; j<13; j++) {
							var table_td = $('<td style="text-align:center;"></td>');
							table_td.append(obj[j]);
							monthly_total[j] = monthly_total[j] + obj[j];
							table_row.append(table_td);
						}
					    table.append(table_row);
					}

					//loop on all checked bundle
					for (var key in _price_monthly_all_bundle) {
						var obj = _price_monthly_all_bundle[key];

						var table_row = $('<tr></tr>');
						table_row.append('<td>BUNDLE</td>');
						table_row.append('<td>' + key + '</td>');
						for(var j=0; j<13; j++) {
							var table_td = $('<td style="text-align:center;"></td>');
							table_td.append(obj[j]);
							monthly_total[j] = monthly_total[j] + obj[j];
							table_row.append(table_td);
						}
					    table.append(table_row);
					}

					//console.log(monthly_total);

					//append monthly total
					var table_row = $('<tr style="font-weight:900"></tr>');
					table_row.append('<td></td><td style="text-align:center;">Total Charges</td>');
					if(checked_contents.length > 0 || checked_stbs.length > 0 || checked_bundles.length > 0) {
						var r = 255;
						var g = 50;
						var b = 50;
					} else {
						var r = 205;
						var g = 205;
						var b = 205;
					}
					
					for(var j=0; j<13; j++) {
						var table_td = $('<td style="text-align:center;"></td>');
						if(j != 0 && Math.round(monthly_total[j-1] * 1000)/1000 != Math.round(monthly_total[j] * 1000)/1000) {
							g = g + 50;
							b = b + 50;
						}

						table_td.css('background-color','rgb('+r+','+g+','+b+')');
						table_td.append(Math.round(monthly_total[j] * 1000)/1000);
						table_row.append(table_td);
					}
					
					var table_foot = $('<tfoot></tfoot>');
					table_foot.append(table_row);
				    table.append(table_foot);
				    //table.append('<thead><th>Type</th><th>Name</th><th>1st</th><th>2nd</th><th>3rd</th><th>4th</th><th>5th</th><th>6th</th><th>7th</th><th>8th</th><th>9th</th><th>10th</th><th>11th</th><th>12th</th></thead>');

					$('#result_table').append(table);

					//populate promotion details
					$('#promotion_detail').html("");
					for (var key in _promotions_detail) {
						$('#promotion_detail').append("<p>>> " + key + ": <strong>" + _promotions_detail[key] + "</strong></p>");
					}

					//prettyfy the discounts
					function prettyfy_discount(discount) {
						//duration for 25 months
						var duration = "";
						if(discount['duration'] > 24) {
							duration = "every month";
						} else {
							duration = discount['duration'] + " months";
						}
						if(discount['type'] == 'percent') {
							var label = (discount['value'] * 100) + " percent off for " + duration;
						} else if(discount['type'] == 'fixed') {
							var label = discount['value'] + "$ off for " + duration;
						} else if(discount['type'] == 'free') {
							var label = duration + " FREE";
						} else if(discount['type'] == 'stb') {
							var label = (discount['value'] * 100) + " percent off for " + duration + " in STB";
						}

						return label;
					}

					
				}
		    </script>
		</div>

<?php 
	
	//$items = array('test1'=>array('price'=>111,'discount'=>array(array('type'=>'percent','value'=>1,'duration'=>3), array('type'=>'percent','value'=>1,'duration'=>3))),'test2'=>array('qq','ww'));

	//echo json_encode((object)$items);

?>