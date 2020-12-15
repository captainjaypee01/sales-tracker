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
		        		<table class="form_tbl" width="100%">
		        			<tr>
								<td>COMPUTATION:</td>
								<td>
									<div id="result_table"></div>
								</td>
							</tr>
		        			<tr>
								<td>Customer Type:</td>
								<td>
									<div id="cust_types">
									    <input type="radio" id="standalone" name="ctypes" value="standalone" /><label for="standalone">Standalone</label>
									    <input type="radio" id="bundle" name="ctypes" value="bundle" /><label for="bundle">Bundle</label>
									    <input type="radio" id="standalone_mio" name="ctypes" value="standalone_mio" /><label for="standalone_mio">Standalone + MIO</label>
									</div>
									<!-- <?php echo form_dropdown('customer', array('standalone' => 'Standalone', 'bundle' => 'Bundle', 'standalone_mio' => 'Standalone with MIO Plan')); ?> -->
								</td>
							</tr>
							<tr id="row_contents" style="display: none;">
								<td>Content:</td>
								<td>
									<select id="contents" name="contents" multiple="multiple">
										<option value="family">Family+</option>
										<option value="jingxuan">Jingxuan+</option>
										<option value="inspirasi">Inspirasi+</option>
										<option value="jingxuan_movie_combo">Jingxuan Movie Combo</option>
										<option value="jingxuan_sports_combo">Jingxuan Sports Combo</option>
									</select>
								</td>
							</tr>
							<tr id="stb_contents" style="display: none;">
								<td>STB:</td>
								<td>
									<select id="stbs" name="stbs" multiple="multiple">
										<option value="stb">STB (1st)</option>
										<option value="stb_dvr">STB w/ DVR (1st)</option>
										<option value="stb_add">STB (additional)</option>
										<option value="stb_dvr_add">STB w DVR (additional)</option>
									</select>
								</td>
							</tr>
							<tr id="bundle_contents" style="display: none;">
								<td>Bundle:</td>
								<td>
									<select id="bundles" name="bundles" multiple="multiple">
										<option value="mio_home_10_del">mio Home 10 (DEL)</option>
										<option value="mio_home_10_voice">mio Home 10 (VOICE)</option>
										<option value="mio_home_15_del">mio Home 15 (DEL)</option>
										<option value="mio_home_10_voice">mio Home 15 (VOICE)</option>
										<option value="explore_home_100">explore home 100</option>
										<option value="explore_home_300">explore home 300</option>
									</select>
								</td>
							</tr>
		        		</table>
	        		</div>
        		</div>
	        </div>
	        <div class="clearFix"></div>
	        <script>

	        	$.getJSON('<?php echo site_url("agent/json_prices"); ?>', function(data) {
				  console.log(data);
				});

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

		        

		        //setup box price mappings
		        var myBundle = {
		        	'standalone': {
		        		'mio_home_10_del':0,
		        		'mio_home_10_voice':0,
		        		'mio_home_15_del':0,
		        		'mio_home_10_voice':0,
		        		'explore_home_100':0,
		        		'explore_home_300':0
		        	},
		        	'bundle': {
		        		'mio_home_10_del':49.9,
		        		'mio_home_10_voice':52.9,
		        		'mio_home_15_del':59.9,
		        		'mio_home_10_voice':62.9,
		        		'explore_home_100':69.9,
		        		'explore_home_300':99.9
		        	},
		        	'standalone_mio': {
		        		'mio_home_10_del':0,
		        		'mio_home_10_voice':0,
		        		'mio_home_15_del':0,
		        		'mio_home_10_voice':0,
		        		'explore_home_100':0,
		        		'explore_home_300':0
		        	}
		        };

		        //setup box price mappings
		        var mySTB = {
		        	'standalone': {
		        		'stb':4.9,
		        		'stb_dvr':10.7,
		        		'stb_add':14.9,
		        		'stb_dvr_add':20.7
		        	},
		        	'bundle': {
		        		'stb':4.9,
		        		'stb_dvr':10.7,
		        		'stb_add':14.9,
		        		'stb_dvr_add':20.7
		        	},
		        	'standalone_mio': {
		        		'stb':4.9,
		        		'stb_dvr':10.7,
		        		'stb_add':14.9,
		        		'stb_dvr_add':20.7
		        	}
		        };

	        	//price and discount mappings
	        	var myPrices = {
	        		'standalone': {
	        			'family': { 
	        				'price':26.9, 
	        				'discount': [
	        					{
		        					'type':'percent',
		        					'value':0,
		        					'duration':12
		        				},
		        				{
		        					'type':'percent',
		        					'value':0,
		        					'duration':12
		        				},
		        				{
		        					'type':'stb',
		        					'value':.5,
		        					'duration':3
		        				}
	        				]
	        			}, 
	        			'jingxuan': { 
	        				'price':29.9, 
	        				'discount': [
	        					{
		        					'type':'percent',
		        					'value':0,
		        					'duration':12
	        					},
	        					{
		        					'type':'percent',
		        					'value':.5,
		        					'duration':3
	        					},
		        				{
		        					'type':'stb',
		        					'value':.5,
		        					'duration':3
		        				}

	        				]
	        			}, 
	        			'inspirasi': { 
	        				'price':16.9, 
	        				'discount': [
		        				{
		        					'type':'fixed',
		        					'value':7,
		        					'duration':6
		        				}
		        			]
	        			}, 
	        			'jingxuan_movie_combo': { 
	        				'price':44.9, 
	        				'discount': [
		        				{
		        					'type':'free',
		        					'value':0,
		        					'duration':2
		        				},
		        				{
		        					'type':'stb',
		        					'value':.5,
		        					'duration':3
		        				}
		        			]
	        			}, 
	        			'jingxuan_sports_combo': { 
	        				'price':54.9, 
	        				'discount': [
		        				{
		        					'type':'percent',
		        					'value':.5,
		        					'duration':3
		        				},
		        				{
		        					'type':'stb',
		        					'value':.5,
		        					'duration':3
		        				}
		        			]
	        			}
	        		},
	        		'bundle': {
	        			'family': { 
	        				'price':0, 
	        				'discount': [
	        					{
		        					'type':'percent',
		        					'value':1,
		        					'duration':12
		        				},
		        				{
		        					'type':'percent',
		        					'value':0,
		        					'duration':12
		        				},
		        				{
		        					'type':'stb',
		        					'value':.5,
		        					'duration':3
		        				}
	        				]
	        			}, 
	        			'jingxuan': { 
	        				'price':29.9, 
	        				'discount': [
	        					{
		        					'type':'percent',
		        					'value':.5,
		        					'duration':3
	        					},
	        					{
		        					'type':'percent',
		        					'value':.1,
		        					'duration':12
		        				},
		        				{
		        					'type':'stb',
		        					'value':.5,
		        					'duration':3
		        				}
	        				]
	        			}, 
	        			'inspirasi': { 
	        				'price':16.9, 
	        				'discount': [
		        				{
		        					'type':'fixed',
		        					'value':7,
		        					'duration':6
		        				},
	        					{
		        					'type':'percent',
		        					'value':.1,
		        					'duration':12
		        				}
		        			]
	        			},
	        			'jingxuan_movie_combo': { 
	        				'price':44.9, 
	        				'discount': [
		        				{
		        					'type':'free',
		        					'value':0,
		        					'duration':2
		        				},
	        					{
		        					'type':'fixed',
		        					'value':20,
		        					'duration':12
		        				},
	        					{
		        					'type':'percent',
		        					'value':.1,
		        					'duration':12
		        				},
		        				{
		        					'type':'stb',
		        					'value':.5,
		        					'duration':3
		        				}
	        				]
	        			}, 
	        			'jingxuan_sports_combo': { 
	        				'price':54.9, 
	        				'discount': [
		        				{
		        					'type':'fixed',
		        					'value':20,
		        					'duration':12
		        				},
	        					{
		        					'type':'percent',
		        					'value':.5,
		        					'duration':3
		        				},
		        				{
		        					'type':'percent',
		        					'value':.1,
		        					'duration':12
		        				},
		        				{
		        					'type':'stb',
		        					'value':.5,
		        					'duration':3
		        				}
		        			]
	        			}
	        		},
	        		'standalone_mio': {
	        			'family':{ 
	        				'price':26.9, 
	        				'discount': [
	        					{
		        					'type':'percent',
		        					'value':.1,
		        					'duration':12
		        				},
		        				{
		        					'type':'stb',
		        					'value':.5,
		        					'duration':3
		        				}
	        				]
	        			}, 
	        			'jingxuan': { 
	        				'price':29.9, 
	        				'discount': [
	        					{
		        					'type':'percent',
		        					'value':.5,
		        					'duration':3
	        					},
	        					{
		        					'type':'percent',
		        					'value':.1,
		        					'duration':12
		        				},
		        				{
		        					'type':'stb',
		        					'value':.5,
		        					'duration':3
		        				}
	        				]
	        			}, 
	        			'inspirasi': { 
	        				'price':16.9, 
	        				'discount': [
	        					{
		        					'type':'fixed',
		        					'value':7,
		        					'duration':6
	        					},
	        					{
		        					'type':'percent',
		        					'value':.1,
		        					'duration':12
		        				}
	        				]
	        			}, 
	        			'jingxuan_movie_combo': { 
	        				'price':44.9, 
	        				'discount': [
	        					{
		        					'type':'free',
		        					'value':0,
		        					'duration':2
		        				},
		        				{
		        					'type':'percent',
		        					'value':.1,
		        					'duration':12
		        				},
		        				{
		        					'type':'stb',
		        					'value':.5,
		        					'duration':3
		        				}
		        			]
	        			}, 
	        			'jingxuan_sports_combo': { 
	        				'price':54.9, 
	        				'discount': [
	        					{
		        					'type':'percent',
		        					'value':.5,
		        					'duration':3
		        				},
		        				{
		        					'type':'percent',
		        					'value':.1,
		        					'duration':12
		        				},
		        				{
		        					'type':'stb',
		        					'value':.5,
		        					'duration':3
		        				}
		        			]
	        			}
	        		}
	        	};

	        	var cust_type = "";
	        	var string_contents = "";
	        	var total_price = 0;

		        //show contents options where customer type was selected
		        $( ":radio" ).click(function() {

		        	console.log();
		        	//show contents dropdown
		       		$( "#row_contents" ).show();
		       		//show stb dropdown
		       		$( "#stb_contents" ).show();

		       		if($(this).val() == 'bundle') {
			       		//show bundle dropdown
			       		$( "#bundle_contents" ).show();
		       		} else {
		       			$("#bundles").multiselect("uncheckAll");
		       			$( "#bundle_contents" ).hide();
		       		}
		       		//store selected customer type into variable
		       		cust_type = $(this).attr("id");
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
							
							//loop on 12 months
							for(i=1;i<=12;i++) {
							   var temp_price = _price;
								//loop on all discounts
								for (var key in _discount_obj) {
								   var obj = _discount_obj[key];
									//check if discount applied on the current month
									if(i <= obj['duration']) {
										//compute for discounts
										if(obj['type'] == 'percent') {
											temp_price = Math.round((temp_price - (temp_price * obj['value']))*1000)/1000;
										} else if(obj['type'] == 'fixed') {
											temp_price = Math.round((temp_price - obj['value'])*1000)/1000;
										} else if(obj['type'] == 'free') {
											//temp_price = 'Free';
											temp_price = 0;
											break;
										} else if(obj['type'] == 'stb') {
											//store discount
											_stb_discount = obj;
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

							var _price = mySTB[cust_type][this.value];

							//loop on 12 months
							for(i=1;i<=12;i++) {
							   var temp_price = _price;

								if(i <= _stb_discount['duration'] && loop == 1) {
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

							var _price = myBundle[cust_type][this.value];

							//loop on 12 months
							for(i=1;i<=12;i++) {
								_price_monthly_bundle.push(Math.round(_price * 1000)/1000);
							}
							_price_monthly_all_bundle[this.title] = _price_monthly_bundle;
						});

					}

					//////////////////////////////////
					//			Create table		//
					//////////////////////////////////
					
					var monthly_total = new Array(0,0,0,0,0,0,0,0,0,0,0,0);
					//create result table with header
					var table = $('<table style="width:100%" class="tablesorter"></table>');
					table.append('<thead><th>Type</th><th>Name</th><th>1st</th><th>2nd</th><th>3rd</th><th>4th</th><th>5th</th><th>6th</th><th>7th</th><th>8th</th><th>9th</th><th>10th</th><th>11th</th><th>12th</th></thead>');

					//loop on all checked contents
					for (var key in _price_monthly_all) {
						var obj = _price_monthly_all[key];

						var table_row = $('<tr></tr>');
						table_row.append('<td>CONTENT</td>');
						table_row.append('<td>' + key + '</td>');
						for(var j=0; j<12; j++) {
							var table_td = $('<td></td>');
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
						for(var j=0; j<12; j++) {
							var table_td = $('<td></td>');
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
						for(var j=0; j<12; j++) {
							var table_td = $('<td></td>');
							table_td.append(obj[j]);
							monthly_total[j] = monthly_total[j] + obj[j];
							table_row.append(table_td);
						}
					    table.append(table_row);
					}

					//append monthly total
					var table_row = $('<tr style="font-weight:900"></tr>');
					table_row.append('<td>TOTAL</td><td></td>');
					if(checked_contents.length > 0 || checked_stbs.length > 0 || checked_bundles.length > 0) {
						var r = 255;
						var g = 50;
						var b = 50;
					} else {
						var r = 205;
						var g = 205;
						var b = 205;
					}
					
					for(var j=0; j<12; j++) {
						var table_td = $('<td></td>');
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
				}
		    </script>
		</div>

<?php 
	
	//$items = array('test1'=>array('price'=>111,'discount'=>array(array('type'=>'percent','value'=>1,'duration'=>3), array('type'=>'percent','value'=>1,'duration'=>3))),'test2'=>array('qq','ww'));

	//echo json_encode((object)$items);

?>