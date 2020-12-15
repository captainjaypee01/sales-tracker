		<div class="clearFix"></div>
		<div class="contentBody">
			<div class="contentTitle">Manage Prices</div>
			<div class="clearFix"></div>
			<div class="leftcontentBody">
				<ul>
					<li><a href="<?php echo base_url().'manager/stats'; ?>">Home</a></li>
					<li><a href="<?php echo base_url().'manager/search'; ?>">Lead Search</a></li>
					<li><a href="<?php echo base_url().'manager/prices'; ?>">Manage Calculator</a></li>
					<li><a href="<?php echo base_url(); ?>login/logout">Logout</a></li>
				</ul>
	        </div>

	        <div class="rightcontentBody">
    			<div id="scroller-anchor"></div>
        		<div class="frm_container">
	        		<div class="manage_menu" id="scroller" >
	        			<div class="menu_buttons">
							<div class="menu_links" style="float: right;">
	        					<a href="" class="button_add" id="add_customer_type">Add Customer Type</a><a href="" class="button_add" id="add_discount_group">Add Discount Group</a><a href="" class="button_add" id="add_item">Add Item</a><a href="" class="button_add" id="add_discount">Add Discount</a>
        					</div>
        					<br /><br />
	        				<div class="menu_dropdown" style="float: right;">
			        			<select id="tables" name="tables" multiple="multiple">
									<option value="content" selected="selected">Content Table</option>
									<option value="stb" selected="selected">Stb Table</option>
									<option value="bundle" selected="selected">Bundle Table</option>
								</select>
								<select id="discounts" name="discounts" multiple="multiple">
									<?php foreach ($discount_groups->result() as $row): ?>
										<?php if($row->selected == 0): ?>
											<option value="<?php echo $row->id; ?>"><?php echo $row->name; ?></option>
										<?php endif; ?>
									<?php endforeach; ?>
								</select>
							</div>
	        			</div>
	        		</div>
	        		<div id="content_matrix">
		        		<div class="frm_heading" id="content_table_header" ><span>CONTENT</span></div>
		        		<div class="frm_inputs" id="content_table" ></div>
	        		</div>
	        		<div id="stb_matrix">
		        		<div class="frm_heading" id="stb_table_header" ><span>STB</span></div>
		        		<div class="frm_inputs" id="stb_table" ></div>
	        		</div>
	        		<div id="bundle_matrix">
		        		<div class="frm_heading" id="bundle_table_header" ><span>BUNDLE</span></div>
		        		<div class="frm_inputs" id="bundle_table" ></div>
	        		</div>
        		</div>
	        </div>
	        <div id="add_item_dialog" title="New Item">
				<p class="validateTips">Add new item with prices.</p>
				<form action="<?php echo base_url() . 'manager/add_item'?>" method="post" id="add_item_form">
					<fieldset>
						<ul>
							<li>
								<label for="item_type">Item Type</label>: 
								<select id="item_type" name="item_type">
									<option value="">Choose Item</option>
									<option value="content">Content</option>
									<option value="stb">Stb</option>
									<option value="bundle">Bundle</option>
								</select>
							</li>
							<li>
								<label for="item_name">Item Name</label>
								<input type="text" name="item_name" id="item_name" class="text ui-widget-content ui-corner-all" />
							</li>
							<?php foreach ($cust_type->result() as $row): ?>
								<li>
									<label for="<?php echo $row->name; ?>"><?php echo ucfirst($row->name); ?> Price</label>
									<input type="text" name="<?php echo $row->name; ?>_price" id="e<?php echo $row->name; ?>_price" value="0" class="text ui-widget-content ui-corner-all" />
								</li>
							<?php endforeach; ?>
						</ul>
					</fieldset>
				</form>
				<div id="result"></div>
			</div>
			<div id="edit_item_dialog" title="Edit Item">
				<p class="validateTips">Edit item with prices.</p>
				<form action="<?php echo base_url() . 'manager/update_item'?>" method="post" id="edit_item_form">
					<fieldset>
						<ul>
							<li>
								<label for="item_name">Item Name</label>
								<input type="text" name="item_name" id="eitem_name" class="text ui-widget-content ui-corner-all" />
							</li>
							<?php foreach ($cust_type->result() as $row): ?>
								<li>
									<label for="<?php echo $row->name; ?>"><?php echo $row->name; ?></label>
									<input type="text" class="edit_item_type_price"name="<?php echo $row->name; ?>_price" id="e<?php echo $row->name; ?>_price" value="0" class="text ui-widget-content ui-corner-all" />
								</li>
							<?php endforeach; ?>
					</fieldset>
					<input type="hidden" name="id" id="item_id" value="" />
				</form>
				<div id="result_edit"></div>
			</div>
			<div id="add_discount_dialog" title="Add Discount">
				<p class="validateTips">Add new discount.</p>
				<form action="<?php echo base_url() . 'manager/add_discount'?>" method="post" id="add_discount_form">
					<fieldset>
						<ul>
							<li>
								<label for="content">Content Name</label>
								<select id="content_item" name="content">
								<?php foreach($contents->result() as $row): ?>
									<option value="<?php echo $row->id; ?>"><?php echo $row->name; ?></option>
								<?php endforeach; ?>
								</select>
							</li>
							<li>
								<label for="group">Group</label>
								<select id="group" name="group">
								<?php foreach($discount_groups->result() as $row): ?>
									<option value="<?php echo $row->id; ?>"><?php echo $row->name; ?></option>
								<?php endforeach; ?>
								</select>
							</li>
							<li>
								<label for="bundle">Account Type</label>
								<select id="bundle" name="bundle">
								<?php foreach($bundles->result() as $row): ?>
									<option value="<?php echo $row->id; ?>"><?php echo $row->name; ?></option>
								<?php endforeach; ?>
								</select>
							</li>
							<li>
								<label for="discount_type">Discount Type</label>
								<select id="discount_type" name="discount_type">
								<?php foreach($discount_types->result() as $row): ?>
									<option value="<?php echo $row->id; ?>"><?php echo $row->name; ?></option>
								<?php endforeach; ?>
								</select>
							</li>
							<li id="discount_value_text">
								<label for="discount_value">Value</label>
								<input type="text" name="discount_value" id="discount_value" value="0" class="text ui-widget-content ui-corner-all" /><span id='value_unit'>%</span>
							</li>
							<li>
								<label for="discount_duration">Duration</label>
								<input type="text" name="discount_duration" id="discount_duration" value="0" class="text ui-widget-content ui-corner-all" />
							</li>
						</ul>
					</fieldset>
					<input type="hidden" name="content_id" id="content_id" value="" />
				</form>
				<div id="result_discount"></div>
			</div>
			<div id="edit_discount_dialog" title="Edit Discount">
				<p class="validateTips">Edit discount.</p>
				<form action="<?php echo base_url() . 'manager/update_discount'?>" method="post" id="edit_discount_form">
					<fieldset>
						<ul>
							<li id="ediscount_value_text">
								<label for="ediscount_value">Value</label>
								<input type="text" name="ediscount_value" id="ediscount_value" value="0" class="text ui-widget-content ui-corner-all" /><span id='evalue_unit'>%</span>
							</li>
							<li>
								<label for="ediscount_duration">Duration</label>
								<input type="text" name="ediscount_duration" id="ediscount_duration" value="0" class="text ui-widget-content ui-corner-all" />
							</li>
						</ul>
					</fieldset>
					<input type="hidden" name="content_id" id="econtent_id" value="" />
				</form>
				<div id="eresult_discount"></div>
			</div>
			<!-- Edit discount group -->
			<div id="edit_discount_group_dialog" title="Edit Discount Group">
				<p class="validateTips">Edit discount group.</p>
				<form action="<?php echo base_url() . 'manager/update_discount_group'?>" method="post" id="edit_discount_group_form">
					<fieldset>
						<ul>
							<li>
								<label for="ediscount_group_name">Discount Group Name</label>
								<input type="text" name="ediscount_group_name" id="ediscount_group_name" class="text ui-widget-content ui-corner-all" />
							</li>
						</ul>
					</fieldset>
					<input type="hidden" name="content_id" id="econtent_id" value="" />
				</form>
				<div id="eresult_discount_group"></div>
			</div>
			<!-- Add discount group-->
			<div id="add_discount_group_dialog" title="Add Discount Group">
				<p class="validateTips">Add new discount group</p>
				<form action="<?php echo base_url() . 'manager/add_discount_group'?>" method="post" id="add_discount_group_form">
					<fieldset>
						<ul>
							<li>
								<label for="discount_group_name">Discount Group Name</label>
								<input type="text" name="discount_group_name" id="discount_group_name" class="text ui-widget-content ui-corner-all" />
							</li>
							<li>
								<label for="discount_group_selected"></label>
								FIX/NOT: 
								<input type="radio" name="fix_or_not" class="text ui-widget-content ui-corner-all" value="1" />Fix
								<input type="radio" name="fix_or_not" class="text ui-widget-content ui-corner-all" value="0" />Not Fix
							</li>
						</ul>
					</fieldset>
				</form>
				<div id="discount_group_result"></div>
			</div>
			<!-- Add Customer type-->
			<div id="add_customer_type_dialog" title="Add Customer Type">
				<p class="validateTips">Add new customer type</p>
				<form action="<?php echo base_url() . 'manager/add_customer_type'?>" method="post" id="add_customer_type_form">
					<fieldset>
						<ul>
							<li>
								<label for="customer_type_name">Customer Type Name</label>
								<input type="text" name="customer_type_name" id="customer_type_name" class="text ui-widget-content ui-corner-all" />
							</li>
							<li>
								<label for="customer_type_label">Label</label>
								<input type="text" name="customer_type_label" id="customer_type_label" class="text ui-widget-content ui-corner-all" />
							</li>
						</ul>
					</fieldset>
				</form>
				<div id="customer_type_result"></div>
			</div>
			<!-- Edit Customer type-->
			<div id="edit_customer_type_dialog" title="Edit Customer Type">
				<p class="validateTips">Edit new customer type</p>
				<form action="<?php echo base_url() . 'manager/update_customer_type'?>" method="post" id="edit_customer_type_form">
					<fieldset>
						<ul>
							<li>
								<label for="ecustomer_type_name">Customer Type Name</label>
								<input type="text" name="ecustomer_type_name" id="ecustomer_type_name" class="text ui-widget-content ui-corner-all" />
							</li>
							<li>
								<label for="ecustomer_type_label">Label</label>
								<input type="text" name="ecustomer_type_label" id="ecustomer_type_label" class="text ui-widget-content ui-corner-all" />
							</li>
						</ul>
					</fieldset>
					<input type="hidden" name="eitem_id" id="eitem_id" value="" />
				</form>
				<div id="ecustomer_type_result"></div>
			</div>
	        <div id="dialog-delete-confirm" title="Delete discount?">
			  <p><span class="ui-icon ui-icon-alert" style="float: left; margin: 0 7px 20px 0;"></span>These discount will be permanently deleted and cannot be recovered. Are you sure?</p>
			</div>
			<div id="dialog-delete-item-confirm" title="Delete item?">
			  <p><span class="ui-icon ui-icon-alert" style="float: left; margin: 0 7px 20px 0;"></span>These item and all of its discounts will be permanently deleted and cannot be recovered. Are you sure?</p>
			</div>
			<div id="dialog-delete-discount-group-confirm" title="Delete item?">
			  <p><span class="ui-icon ui-icon-alert" style="float: left; margin: 0 7px 20px 0;"></span>These item and all of its discounts will be permanently deleted and cannot be recovered. Are you sure?</p>
			</div>
			<div id="dialog-delete-customer-type-confirm" title="Delete item?">
			  <p><span class="ui-icon ui-icon-alert" style="float: left; margin: 0 7px 20px 0;"></span>These item and all of its discounts will be permanently deleted and cannot be recovered. Are you sure?</p>
			</div>
	        <div class="clearFix"></div>
	        <script type="text/javascript">



	        	//multiselect dropdown declarations and functions
	        	$("#discounts")
			        .multiselect({
			        	header: "Select Discount Group",
	   					noneSelectedText: "Select Discount Group",
	   					click: function(){
	   						apply_multiselect('discounts');
					    },
	   					create: function() {
	   						apply_multiselect('discounts');
	   					}
			        });

	        	$("#tables")
			        .multiselect({
			        	header: "Select Table",
	   					noneSelectedText: "Select Table",
	   					click: function(){
	   						apply_multiselect('tables');
					    },
	   					create: function() {
	   						apply_multiselect('tables');
	   					}
			        });

		        function apply_multiselect(multi_select) {
		        	if(multi_select == 'discounts') {
			        	$("#discounts option").each(function(){
						    $(".disc_group_class_" + $(this).val()).hide();
						});

				    	var checked = $("#discounts").multiselect("getChecked");
   						$.each(checked, function(i, l){
   							$(".disc_group_class_" + l.value).show();
						});
		        	} else if(multi_select == 'tables') {
		        		$("#tables option").each(function(){
						    $("#" + $(this).val() + "_matrix").hide();
						});

				    	var checked = $("#tables").multiselect("getChecked");
   						$.each(checked, function(i, l){
   							$("#" + l.value + "_matrix").show();
						});
		        	}
		        }


	        	//load prices table via AJAX
	        	function load_prices(scroll_to, id) {
		        	$('#stb_table').load('<?php echo base_url() . 'manager/stb_prices_table'; ?>', 
		        		function() {
  							$.scrollTo( scroll_to, 800, {offset:-80});
  							apply_multiselect('discounts');

  					});
		        	$('#bundle_table').load('<?php echo base_url() . 'manager/bundle_prices_table'; ?>', 
		        		function() {
  							$.scrollTo( scroll_to, 800, {offset:-80});
  							apply_multiselect('discounts');
  					});
		        	$('#content_table').load('<?php echo base_url() . 'manager/content_prices_table' ?>', 
		        		function() {
  							$.scrollTo( scroll_to, 800, {offset:-80});
  							apply_multiselect('discounts');
  							if(id) {
  								var text = $(scroll_to + ' a').text();
  								$('#content_item').prepend('<option value='+ id +'>'+ text +'</option>');
  							}
  					});

	        	}


	        	//initial load price
	        	load_prices();

	        	//toggle to hide or show different table
	        	/*$( ".table_checkbox" ).on('click', function() {
			    	var check_content = $('form #checkbox_content').is(':checked');
			    	var check_stb = $('form #checkbox_stb').is(':checked');
			    	var check_bundle = $('form #checkbox_bundle').is(':checked');
			    	if(check_content) {
			    		$('#content_table_header').removeAttr( 'style' );
			    		$('#content_table').removeAttr( 'style' );
			    	} else { 
			    		$('#content_table').css('display','none'); 
			    		$('#content_table_header').css('display','none');
			    	}
			    	if(check_stb) {
			    		$('#stb_table_header').removeAttr( 'style' );
			    		$('#stb_table').removeAttr( 'style' );
			    	} else { 
			    		$('#stb_table').css('display','none'); 
			    		$('#stb_table_header').css('display','none');
			    	}
			    	if(check_bundle) {
			    		$('#bundle_table_header').removeAttr( 'style' );
			    		$('#bundle_table').removeAttr( 'style' );
			    	} else { 
			    		$('#bundle_table').css('display','none'); 
			    		$('#bundle_table_header').css('display','none');
			    	}

			    });*/


				//toggle to hide or show different table
	        	$( ".discount_group_row" ).on('click', function() {
			    	var id = $(this).val();
			    	var check =	$('#checkbox_dc_group_'+id).is(':checked');
			    	
			    	if(check) {
			    		$('.disc_group_class_'+id).removeAttr( 'style' );
			    	} else { 
			    		$('.disc_group_class_'+id).css('display','none');
			    	}
			    });





	        	/**
	        	 *
	        	 * 
	        	 * DIALOG BOXES
	        	 *
	        	 * 
	        	 */

	        	$( "#add_discount_group_dialog" ).dialog({
					autoOpen: false,
					width: 350,
					modal: true,
					buttons: {
						"Add Discount Group": function() {
							var $form = $('#add_discount_group_form'),
							idiscount_group_name = $form.find( 'input[name="discount_group_name"]' ).val(),
							idiscount_group_selected = $("input[type='radio'][name='fix_or_not']:checked").val(),
						    url = $form.attr( 'action' );

							$.post( url, { discount_group_name: idiscount_group_name, discount_group_selected: idiscount_group_selected },
						    	function( data ) {
							    	console.log(data);
							    	//test if update successfull
							    	if(data == 'Success') {
							        	//close dialog pop up
							        	$( "#add_discount_group_dialog" ).dialog('close');
							        	location.reload();
							        	//update price table
							        	//load_prices();
							    	} else {
							    		//display error
							    		$( "#discount_group_result" ).empty().append( data );
							    	}
							    }
						  );
						},
						Cancel: function() {
							$( this ).dialog( "close" );
						}
					},
					close: function() {

					}
				});

				
				$( "#edit_customer_type_dialog" ).dialog({
					autoOpen: false,
					width: 350,
					modal: true,
					buttons: {
						"Update": function() {
							var $form = $('#edit_customer_type_form'),
						    iid = $( "#edit_customer_type_dialog" ).data('id'),
						    url = $form.attr( 'action' );
						   	
						  	$('#eitem_id').val(iid);
						   	
						  	console.log($('#edit_customer_type_form').serialize());

							$.post( url,  $('#edit_customer_type_form').serialize(),
							    function( data ) {
							    	//test if update successfull
							    	if(data == 'Success') {
							        	//close dialog pop up
							        	$( "#edit_customer_type_dialog" ).dialog('close');

							        	//update price table
							        	load_prices();
							    	} else {
							    		//display error
							    		$( "#edit_customer_type_dialog" ).empty().append( data );
							    	}
							    }
						    );
						},
						Delete: function() {
							$( "#dialog-delete-customer-type-confirm" ).dialog( "open" );
						},
						Cancel: function() {
							$( this ).dialog( "close" );
						}
					},
					close: function() {

					}
				});

	        	$( "#add_customer_type_dialog" ).dialog({
					autoOpen: false,
					width: 350,
					modal: true,
					buttons: {
						"Add Customer Type": function() {
							var $form = $('#add_customer_type_form'),
							icustomer_type_name = $form.find( 'input[name="customer_type_name"]' ).val(),
							icustomer_type_label = $form.find( 'input[name="customer_type_label"]' ).val(),
						    url = $form.attr( 'action' );

							$.post( url, { customer_type_name: icustomer_type_name, customer_type_label: icustomer_type_label },
						    	function( data ) {
							    	console.log(data);
							    	//test if update successfull
							    	if(data == 'Success') {
							        	//close dialog pop up
							        	$( "#add_customer_type_dialog" ).dialog('close');
							        	location.reload();
							        	//update price table
							        	//load_prices();
							    	} else {
							    		//display error
							    		$( "#customer_type_result" ).empty().append( data );
							    	}
							    }
						  );
						},
						Cancel: function() {
							$( this ).dialog( "close" );
						}
					},
					close: function() {

					}
				});


	        	$( "#add_item_dialog" ).dialog({
					autoOpen: false,
					width: 350,
					modal: true,
					buttons: {
						"Add Item": function() {
							var $form = $('#add_item_form'),
							url = $form.attr( 'action' );

							$.post( url, $('#add_item_form').serialize(),
						    	function( data ) {
							    	//test if update successfull
							    	if(jQuery.isNumeric(data) == true) {
							        	//close dialog pop up
							        	$( "#add_item_dialog" ).dialog('close');

							        	//update price table
							        	load_prices('#row_' + data, data);

							        } else {
							    		//display error
							    		$( "#result" ).empty().append( data );
							    	}
							    }
						  );
						},
						Cancel: function() {
							$( this ).dialog( "close" );
						}
					},
					close: function() {

					}
				});
				

				$( "#edit_discount_group_dialog" ).dialog({
					autoOpen: false,
					width: 350,
					modal: true,
					buttons: {
						"Update": function() {
							var $form = $('#edit_discount_group_form'),
						    idiscount_group_name = $form.find( 'input[name="ediscount_group_name"]' ).val(),
						    iid = $( "#edit_discount_group_dialog" ).data('id'),
						    url = $form.attr( 'action' );
						 
							$.post( url, { id: iid, discount_group_name: idiscount_group_name },
							    function( data ) {
							    	//test if update successfull
							    	if(data == 'Success') {
							        	//close dialog pop up
							        	$( "#edit_discount_group_dialog" ).dialog('close');
							        	location.reload();

							    	} else {
							    		//display error
							    		$( "#eresult_discount_group" ).empty().append( data );
							    	}
							    }
						    );
						},

						Delete: function() {
							$( "#dialog-delete-discount-group-confirm" ).dialog( "open" );
						},

						Cancel: function() {
							$( this ).dialog( "close" );
						}
					},
					close: function() {

					}
				});


				$( "#edit_item_dialog" ).dialog({
					autoOpen: false,
					width: 350,
					modal: true,
					buttons: {
						"Update": function() {
							var $form = $('#edit_item_form'),
						    iid = $( "#edit_item_dialog" ).data('id'),
						    url = $form.attr( 'action' );
						   	
						  	$('#item_id').val(iid);
						   	
							$.post( url,  $('#edit_item_form').serialize(),
							    function( data ) {
							    	//test if update successfull
							    	if(data == 'Success') {
							        	//close dialog pop up
							        	$( "#edit_item_dialog" ).dialog('close');

							        	//update price table
							        	load_prices();
							    	} else {
							    		//display error
							    		$( "#result_edit" ).empty().append( data );
							    	}
							    }
						    );
						},
						"Delete": function() {
							$( "#dialog-delete-item-confirm" ).dialog( "open" );
						},
						Cancel: function() {
							$( this ).dialog( "close" );
						}
					},
					close: function() {

					}
				});


				$( "#add_discount_dialog" ).dialog({
					autoOpen: false,
					width: 350,
					modal: true,
					buttons: {
						"Add Discount": function() {
							var $form = $('#add_discount_form');
						    icontent = $form.find( 'select[name="content"]' ).val();
						    igroup = $form.find( 'select[name="group"]' ).val();
						    ibundle = $form.find( 'select[name="bundle"]' ).val();
						    idiscount = $form.find( 'select[name="discount_type"]' ).val();
						    ivalue = $form.find( 'input[name="discount_value"]' ).val();

						    if(idiscount == 1 || idiscount == 3) {
						    	ivalue = ivalue/100;
						    }

						    console.log(ivalue);
						    iduration = $form.find( 'input[name="discount_duration"]' ).val();
						    url = $form.attr( 'action' );

							$.post( url, { item_id: icontent, group_id: igroup, customer_id: ibundle, discount_id: idiscount, value: ivalue, duration: iduration, },
							    function( data ) {
							    	//test if add successfull
							    	if(data == 'Success') {
							        	//close dialog pop up
							        	$( "#add_discount_dialog" ).dialog('close');

							        	//update price table
							        	load_prices('#row_' + icontent);
							    	} else {
							    		//display error
							    		$( "#result_discount" ).empty().append( data );
							    	}
							    }
						    );
						},
						Cancel: function() {
							$( this ).dialog( "close" );
						}
					},
					close: function() {

					}
				});


				$( "#edit_discount_dialog" ).dialog({
					autoOpen: false,
					width: 350,
					modal: true,
					buttons: {
						"Edit": function() {
							var obj = $( "#edit_discount_dialog" ).data('obj');
							var $form = $('#edit_discount_form');
							iduration = $form.find( 'input[name="ediscount_duration"]' ).val();
						    ivalue = $form.find( 'input[name="ediscount_value"]' ).val();

						    if(obj['discount_id'] == 1 || obj['discount_id'] == 3) {
						    	ivalue = ivalue/100;
						    }

							url = $form.attr( 'action' );
							$.post( url, { id: obj['id'], value: ivalue, duration: iduration },
							    function( data ) {
							    	//test if add successfull
							    	if(data == 'Success') {
							        	//close dialog pop up
							        	$( "#edit_discount_dialog" ).dialog('close');

							        	//update price table
							        	load_prices();
							    	} else {
							    		//display error
							    		$( "#eresult_discount" ).empty().append( data );
							    	}
							    }
						    );
						},
						Cancel: function() {
							$( this ).dialog( "close" );
						}
					},
					close: function() {

					}
				});

			

				$( "#dialog-delete-customer-type-confirm" ).dialog({
					autoOpen: false,
			      	resizable: false,
			      	height:170,
			      	modal: true,
			      	buttons: {
			        	"Delete": function() {
			        		var iid = $( "#edit_customer_type_dialog" ).data('id');
					    	//request delete
					    	$.post( '<?php echo base_url() . 'manager/delete_customer_type'; ?>', { id: iid },
							    function( data ) {
							    	
							    	//update price table
						        	load_prices();
							    }
						    );

			          		$( "#edit_customer_type_dialog" ).dialog('close');
			          		$('#dialog-delete-customer-type-confirm').dialog( "close" );

					    	return false;
			        	},
			        	Cancel: function() {
			          		$('#dialog-delete-customer-type-confirm').dialog( "close" );
			        	}
			      	}
			    });


				$( "#dialog-delete-confirm" ).dialog({
					autoOpen: false,
			      	resizable: false,
			      	height:170,
			      	modal: true,
			      	buttons: {
			        	"Delete": function() {
			        		var iid = $( "#dialog-delete-confirm" ).data('id');
					    	//request delete
					    	$.post( '<?php echo base_url() . 'manager/delete_discount'; ?>', { id: iid },
							    function( data ) {
							    	
							    	//update price table
						        	load_prices();
							    }
						    );

			          		$( this ).dialog( "close" );

					    	return false;
			        	},
			        	Cancel: function() {
			          		$( this ).dialog( "close" );
			        	}
			      	}
			    });


			    $( "#dialog-delete-item-confirm" ).dialog({
					autoOpen: false,
			      	resizable: false,
			      	height:170,
			      	modal: true,
			      	buttons: {
			        	"Delete": function() {
			        		var iid = $( "#edit_item_dialog" ).data('id');
					    	//request delete
					    	$.post( '<?php echo base_url() . 'manager/delete_item'; ?>', { id: iid },
							    function( data ) {
							    	//update price table
						        	load_prices();
							    }
						    );

				    		$( "#edit_item_dialog" ).dialog("close");
			          		$( this ).dialog( "close" );

					    	return false;
			        	},
			        	Cancel: function() {
			          		$( this ).dialog( "close" );
			        	}
			      	}
			    });

			    $( "#dialog-delete-discount-group-confirm" ).dialog({
					autoOpen: false,
			      	resizable: false,
			      	height:170,
			      	modal: true,
			      	buttons: {
			        	"Delete": function() {
			        		var iid = $( "#edit_discount_group_dialog" ).data('id');
					    	//request delete
					    	$.post( '<?php echo base_url() . 'manager/delete_discount_group'; ?>', { id: iid },
							    function( data ) {
							    	//update price table
						        	//load_prices();
						        	location.reload();
							    }
						    );

				    		$( "#edit_discount_group_dialog" ).dialog("close");
			          		$( this ).dialog( "close" );

					    	return false;
			        	},
			        	Cancel: function() {
			          		$( this ).dialog( "close" );
			        	}
			      	}
			    });



			    $( "#add_discount_group" ).click(function() {
			        $( "#add_discount_group_dialog" ).dialog( "open" );
			        return false;
			    });
			    
			    $( "#add_customer_type" ).click(function() {
			        $( "#add_customer_type_dialog" ).dialog( "open" );
			        return false;
			    });

			    $( "#edit_customer_type_dialog" ).click(function() {
			        $( "#edit_customer_type_dialog" ).dialog( "open" );
			        return false;
			    });

			    $( "#add_item" ).click(function() {
			        $( "#add_item_dialog" ).dialog( "open" );
			        return false;
			    });

			    $( "#add_discount" ).click(function() {
			        $( "#add_discount_dialog" ).dialog( "open" );
			        return false;
			    });

			    $( ".frm_container" ).on("click", ".delete_discount", function(){
			    	//get discount ID
			    	$( "#dialog-delete-confirm" ).data('id', $(this).attr('id').substr(5));
			    	$( "#dialog-delete-confirm" ).dialog( "open" );
			        return false;
			    });

			    $( ".frm_container" ).on("click", ".edit_item_link", function(){
			    	var item = $(this).attr('id');
			    	var item_id = item.substr(5);
			    	var ctr = 1;
			    	//populate values;
			    	var row = $( "#row_" + item_id );

			    	//get item prices
			    	$(".edit_item_type_price").each(function() {
			    		$(this).val(row.children().eq(ctr).html());
			    		ctr++;
					});
			    	
			    	//get item name
			    	$( "#eitem_name" ).val(row.children().children('a').html());
			    	$( "#edit_item_dialog" ).data('id', row.attr('id').substr(4));
			        $( "#edit_item_dialog" ).dialog( "open" );
			        
			        return false;
			    });
			    
			    $( ".frm_container" ).on("click", ".edit_disc_group", function(){
			    	var item = $(this).attr('id');
			    	var item_id = item.substr(11);
			    	var item_name = $(this).html();

			    	//get item name
			    	$( "#ediscount_group_name" ).val(item_name);
			    	
			    	$( "#edit_discount_group_dialog" ).data('id', item_id);
			        $( "#edit_discount_group_dialog" ).dialog( "open" );
			        
			        return false;
			    });

			    $( ".frm_container" ).on("click", ".edit_customer_type", function(){
			    	var item = $(this).attr('id');
			    	var item_id = item.substr(14);
			    	var item_label = $(this).html();
			    	var item_name = $(this).attr('data');

			    	//get item name
			    	$( "#ecustomer_type_name" ).val(item_name);
			    	$( "#ecustomer_type_label" ).val(item_label);
			    	$( "#edit_customer_type_dialog" ).data('id', item_id);
			        $( "#edit_customer_type_dialog" ).dialog( "open" );
			        
			        return false;
			    });

			    $( ".frm_container" ).on("click", ".edit_discount", function(){

			    	//data getter
			    	var discount_id = $(this).attr('id').substr(7);
			    	$.post( '<?php echo base_url() . 'manager/get_discount'; ?>', { id: discount_id },
					    function( data ) {
					    	var obj = jQuery.parseJSON(data);
						    if(obj['discount_id'] == 1 || obj['discount_id'] == 3) {
						    	ivalue = obj['value']*100;
						    	$('#evalue_unit').html('%');
						    	$('#ediscount_value_text').show();
						    } else if(obj['discount_id'] == 2) {
						    	$('#evalue_unit').html('$');
						    	ivalue = obj['value'];
						    	$('#ediscount_value_text').show();
						    } else if(obj['discount_id'] == 4) {
						    	ivalue = obj['value'];
						    	$('#ediscount_value_text').hide();
						    }

				        	$("#ediscount_value").val(ivalue);
				        	$("#ediscount_duration").val(obj['duration']);

				        	$( "#edit_discount_dialog" ).data('obj', obj);
			        		$( "#edit_discount_dialog" ).dialog( "open" );
					    }
				    );

			        return false;
			    });

				$('#discount_type').change(function() {
			    	if($(this).val() == 1 || $(this).val() == 3) {
			    		$('#discount_value_text').show();
			    		$('#value_unit').html('%');
			    	} else if($(this).val() == 2) {
			    		$('#discount_value_text').show();
			    		$('#value_unit').html('$');
			    	} else if($(this).val() == 4) {
			    		$('#discount_value_text input').val('0');
			    		$('#discount_value_text').hide();
			    	}

			    });

			    function moveScroller() {
				    var move = function() {
				        var st = $(window).scrollTop();
				        var ot = $("#scroller-anchor").offset().top;
				        var s = $("#scroller");
				        if(st > ot) {
				            s.css({
				                position: "fixed",
				                right: "40px",
				                top: "10px"
				            });
				        } else {
				            if(st <= ot) {
				                s.css({
				                    position: "relative",
				                    right: "",
				                    top: ""
				                });
				            }
				        }
				    };
				    $(window).scroll(move);
				    move();
				}
				


				$(function() {
				    moveScroller();
				  });

	        </script>
		</div>