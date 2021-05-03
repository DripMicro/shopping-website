<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<div class="row">
	<div class="col-lg-5 col-md-12">
		<div class="box box-primary">
			<!-- /.box-header -->
			<div class="box-header with-border">
				<h3 class="box-title"><?php echo trans('pre_canvas_depth'); ?></h3>
			</div><!-- /.box-header -->

			<div class="box-body">
				<!-- form start -->
				<?php echo form_open('admin_controller/update_canvasdepths_item_post'); ?>
				<input type="hidden" name="id" value="<?php echo $item->id; ?>">

				<div class="row">
					<div class="col">
						<label><?php echo trans("pre_canvas_depth"); ?></label>
						<input name="add_canvasdepths" class="form-control" type="text" value="<?php echo $item->canvasdepths; ?>">
					</div>
				</div>

				<div class="row">
					<div class="col">
						<label><?php echo trans("own_price")."($)"; ?></label>
						<input name="add_price" class="form-control" type="number"  value="<?php echo $item->price; ?>"">
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