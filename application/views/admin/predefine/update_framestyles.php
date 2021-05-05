<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<div class="row">
	<div class="col-lg-5 col-md-12">
		<div class="box box-primary">
			<!-- /.box-header -->
			<div class="box-header with-border">
				<h3 class="box-title"><?php echo trans('pre_frame_style'); ?></h3>
			</div><!-- /.box-header -->
			
			<div class="box-body">
				<!-- form start -->
				<?php echo form_open_multipart('admin_controller/update_framestyles_item_post'); ?>
				<input type="hidden" name="id" value="<?php echo $item->id; ?>">

				<div class="row">
					<div class="col">
						<div class="form-group">
							<label class="control-label"><?php echo trans("pre_frame_style"); ?></label><br>
							<img src="<?= base_url() . $item->image; ?>" style="max-width: 320px; max-height: 320px;"><br><br>
							<div class="display-block">
								<a class='btn btn-default btn-sm btn-file-upload'>
									<i class="fa fa-image text-muted"></i>&nbsp;&nbsp;<?php echo trans("select_image"); ?>
									<input type="file" name="file" size="40" accept=".png, .jpg, .jpeg, .gif" onchange="$('#upload-file-info').html($(this).val().replace(/.*[\/\\]/, ''));">
								</a>
								<br>
								<span class='label label-default label-file-upload' id="upload-file-info"></span>
							</div>
						</div>
					</div>
				</div>

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
						<label><?php echo trans("pre_frame_style"); ?></label>
						<input name="add_framestyles" class="form-control" type="text" value="<?php echo $item->framestyles; ?>" required>
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
