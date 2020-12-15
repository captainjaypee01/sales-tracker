						<table class="tablesorter" cellspacing="1" >
							<thead>
								<tr>
									<th>Name</th>
									<?php foreach ($cust_type->result() as $row): ?>
									<th width="20"><a href="#" class="edit_customer_type" data="<?php echo $row->name; ?>" id="customer_type_<?php echo $row->id; ?>" ><?php echo $row->label; ?></a></th>
									<?php endforeach; ?>
									<?php foreach ($discount_groups->result() as $row): ?>
									<th width="180"  <?php if($row->selected === 0) { ?> style="display: none;" <?php } ?> class="disc_group_class_<?php echo $row->id; ?>">
										<?php 
											if($row->selected == 0) { ?>
												<a href="#" class="edit_disc_group" id="disc_group_<?php echo $row->id; ?>" ><?php echo $row->name; ?></a>
											<?php } else { echo $row->name; } ?>
									</th>
									<?php endforeach; ?>
								</tr>
							</thead>
							<tbody>
								<?php foreach ($contents->result() as $row): ?>
								<?php $prices_list = $this->Calculator_model->get_prices($row->id); ?>
								<tr id="row_<?php echo $row->id; ?>">
									<td><a href="#" class="edit_item_link" id="item_<?php echo $row->id; ?>"><?php echo $row->name; ?></a></td>
									<?php foreach ($cust_type->result() as $row_name): ?>
									<td><?php echo isset($prices_list[$row_name->name])?$prices_list[$row_name->name]:'undefined'; ?></td>
									<?php endforeach; ?>
									<?php foreach ($discount_groups->result() as $row_group): ?>
									<td <?php if($row_group->selected === 0) { ?> style="display: none;" <?php } ?> class="disc_group_class_<?php echo $row_group->id; ?>">
										<ul>
										<?php 
											$discount_string = "";

											//display discounts
											$discounts = $this->Calculator_model->get_discounts($row->id, $row_group->id);

											foreach ($discounts->result() as $discount) {
												echo $this->Calculator_model->get_promotion_detail($discount);
											}

										?>
										</ul>
									</td>
									<?php endforeach; ?>
								</tr>
								<?php endforeach;?>
							</tbody>
						</table>
	