<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<div class="row">
	<div class="col-lg-5 col-md-12">
		<div class="box box-primary">
			<!-- /.box-header -->
			<div class="box-header with-border">
				<h3 class="box-title"><?php echo trans('pre_print_size'); ?></h3>
			</div><!-- /.box-header -->
			
			<div class="box-body">
				<!-- form start -->
				<?php echo form_open('admin_controller/update_printsizes_item_post'); ?>
				<input type="hidden" name="id" value="<?php echo $item->id; ?>">

				<div class="row">
					<div class="col">
						<label><?php echo trans('materials'); ?></label>
						<select id="materials" name="material" class="form-control">
							<?php
							foreach ($materials as $material): ?>
								<option value="<?php echo $material->id; ?>" <?php echo $material->id == $item->materials ?'selected':'';?>>
									<?php echo $material->materials; ?>
								</option>
							<?php endforeach; ?>
						</select>
					</div>
				</div>

				<div class="row">
					<div class="col">
						<label><?php echo trans('orientations'); ?></label>
						<!-- <select id="orientations" name="orientation" class="form-control">
							<?php
							foreach ($orientations as $orientation): ?>
								<option value="<?php echo $orientation->id; ?>" <?php echo $orientation->id == $item->orientations ?'selected':'';?>>
									<?php echo $orientation->orientations; ?>
								</option>
							<?php endforeach; ?>
						</select> -->

						<?php 
							foreach ($custom_fields as $custom_field):
								if (!empty($custom_field)):
									$custom_field_name = parse_serialized_name_array($custom_field->name_array, $this->selected_lang->id);
									?>
									<!-- <div><?php echo $custom_field_name; ?></div> -->
									<?php if ($custom_field->field_type == "radio_button" && $custom_field_name == "Orientation"): ?>
										<select name="orientation" class="form-control custom-select">
											<?php $field_options = $this->field_model->get_field_options($custom_field, $this->selected_lang->id);
											$field_values = $this->field_model->get_product_custom_field_values($custom_field->id, $product_id, $this->selected_lang->id);
											$selected_option_ids = get_array_column_values($field_values, 'selected_option_id');
											if (!empty($field_options)):
												
												foreach ($field_options as $field_option):?>
													<option value="<?= $field_option->id; ?>" <?php echo $field_option->id == $item->orientations ?'selected':'';?>><?= get_custom_field_option_name($field_option); ?></option>
												<?php endforeach;
											endif; ?>
										</select>
									<?php endif; ?>
						<?php
								endif;
							endforeach;
						?>
					</div>
				</div>

				<div class="row">
					<div class="col">
						<label><?php echo trans("pre_print_size"); ?></label>
						<input name="add_printsize" class="form-control" type="text" value="<?php echo $item->size; ?>" required>
					</div>
				</div>

				<div class="row">
					<div class="col">
						<label><?php echo trans("own_price")."($)"; ?></label>
						<input name="add_price" class="form-control" type="number" value="<?php echo $item->price; ?>" required>
					</div>
				</div>
			</div>
			<!-- /.box-body -->
			<div class="box-footer">
				<button type="submit" class="btn btn-primary pull-right"><?php echo trans('save_changes'); ?></button>
			</div>
			<!-- /.box-footer -->
			<?php echo form_close(); ?><!-- form end -->
		</div>
	</div>
</div>
