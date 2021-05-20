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
            <!-- <select id="orientations" name="orientation" class="form-control">
                <?php
                foreach ($pre_orientations as $item): ?>
                    <option value="<?php echo $item->id; ?>">
                        <?php echo $item->orientations; ?>
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
                                        <option value="<?= $field_option->id; ?>"><?= get_custom_field_option_name($field_option); ?></option>
                                    <?php endforeach;
                                endif; ?>
                            </select>
                        <?php endif; ?>
            <?php
                    endif;
                endforeach;
            ?>
        </div>

        <div class="item-table-filter">
            <label><?php echo trans("pre_print_size"); ?></label>
            <input name="add_printsize" class="form-control" type="text" required>
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