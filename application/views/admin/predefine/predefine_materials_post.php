<div class="row table-filter-container">
    <div class="col-sm-12">
        <?php echo form_open('admin_controller/predefine_setting_add_materials_post'); ?>

        <div class="item-table-filter">
            <label><?php echo trans("materials"); ?></label>
            <input name="add_materials" class="form-control" type="text" required>
        </div>

        <!-- <div class="item-table-filter">
            <label><?php echo trans("own_price")."($)"; ?></label>
            <input name="add_price" class="form-control" type="number" required>
        </div> -->

        <div class="item-table-filter md-top-10" style="width: 65px; min-width: 65px;">
            <label style="display: block">&nbsp;</label>
            <button type="submit" class="btn bg-purple"><?php echo trans("pre_add"); ?></button>
        </div>
        <?php echo form_close(); ?>
    </div>
</div>