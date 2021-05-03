<div class="row table-filter-container">
    <div class="col-sm-12">
        <?php echo form_open('admin_controller/predefine_setting_add_printsizes_post'); ?>

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
            <label><?php echo trans('orientations'); ?></label>
            <select id="orientations" name="orientation" class="form-control">
                <?php
                foreach ($pre_orientations as $item): ?>
                    <option value="<?php echo $item->id; ?>">
                        <?php echo $item->orientations; ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>

        <div class="item-table-filter">
            <label><?php echo trans("pre_print_size"); ?></label>
            <input name="add_printsize" class="form-control" type="text">
        </div>

        <div class="item-table-filter">
            <label><?php echo trans("own_price")."($)"; ?></label>
            <input name="add_price" class="form-control" type="number">
        </div>

        <div class="item-table-filter md-top-10" style="width: 65px; min-width: 65px;">
            <label style="display: block">&nbsp;</label>
            <button type="submit" class="btn bg-purple"><?php echo trans("pre_add"); ?></button>
        </div>
        <?php echo form_close(); ?>
    </div>
</div>