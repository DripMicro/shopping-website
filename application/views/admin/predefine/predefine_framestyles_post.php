<div class="row table-filter-container">
    <div class="col-sm-12">
        <?php echo form_open_multipart('admin_controller/predefine_setting_add_framestyles_post'); ?>

        <div class="item-table-filter">
            <div class="form-group">
                <label class="control-label"><?php echo trans("image"); ?></label>
                <div class="display-block">
                    <a class='btn btn-default btn-sm btn-file-upload'>
                        <i class="fa fa-image text-muted"></i>&nbsp;&nbsp;<?php echo trans("select_image"); ?>
                        <input type="file" name="file" size="40" accept=".png, .jpg, .jpeg, .gif" onchange="$('#upload-file-info').html($(this).val().replace(/.*[\/\\]/, ''));" required>
                    </a>
                    <br>
                    <span class='label label-default label-file-upload' id="upload-file-info"></span>
                </div>
            </div>
        </div>

        <div class="item-table-filter">
            <label><?php echo trans('materials'); ?></label>
            <select id="materials" name="material" class="form-control">
                <?php
                foreach ($pre_materials as $item): ?>
                    <option value="<?php echo $item->id; ?>">
                        <?php echo $item->materials; ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>

        <div class="item-table-filter">
            <label><?php echo trans("pre_frame_style"); ?></label>
            <input name="add_framestyles" class="form-control" type="text" required>
        </div>

        <div class="item-table-filter">
            <label><?php echo trans("own_price")."($)"; ?></label>
            <input name="add_price" class="form-control" type="number" required>
        </div>

        <div class="item-table-filter md-top-10" style="width: 65px; min-width: 65px;">
            <label style="display: block">&nbsp;</label>
            <button type="submit" class="btn bg-purple"><?php echo trans("pre_add"); ?></button>
        </div>
        <?php echo form_close(); ?>
    </div>
</div>