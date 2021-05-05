<div class="row">
    <div class="col-md-12">
        <div class="box box-primary">
            <div class="box-header with-border">
                <h3 class="box-title"><?php echo trans('predefine_setting'); ?></h3>
            </div>
            <!-- /.box-header -->

            <div class="box-body">
                <!-- include message block -->
                <div class="row">
                    <div class="col-12">
                        <div class="product-description post-text-responsive">
                            <ul class="nav nav-tabs nav-tabs-horizontal" role="tablist">
                                <li class="nav-item active">
                                    <a class="nav-link active" id="tab_pre_type" data-toggle="tab" href="#tab_pre_type_content" role="tab" aria-controls="tab_pre_type" aria-selected="true"><?php echo trans("pre_type"); ?></a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="tab_pre_categories" data-toggle="tab" href="#tab_pre_categories_content" role="tab" aria-controls="tab_pre_categories" aria-selected="false"><?php echo trans("pre_categories"); ?></a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="tab_pre_material_option" data-toggle="tab" href="#tab_pre_material_option_content" role="tab" aria-controls="tab_pre_material_option" aria-selected="false"><?= trans("pre_material_options"); ?></a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="tab_pre_orientation" data-toggle="tab" href="#tab_pre_orientation_content" role="tab" aria-controls="tab_pre_orientation" aria-selected="false"><?= trans("orientations"); ?></a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="tab_pre_print_size" data-toggle="tab" href="#tab_pre_print_size_content" role="tab" aria-controls="tab_pre_print_size" aria-selected="false"><?php echo trans("pre_print_size"); ?></a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="tab_pre_finish_option" data-toggle="tab" href="#tab_pre_finish_option_content" role="tab" aria-controls="tab_pre_finish_option" aria-selected="false"><?php echo trans("pre_finish_options"); ?></a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="tab_pre_canvas_depth" data-toggle="tab" href="#tab_pre_canvas_depth_content" role="tab" aria-controls="tab_pre_canvas_depth" aria-selected="false"><?php echo trans("pre_canvas_depth"); ?></a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="tab_pre_frame_style" data-toggle="tab" href="#tab_pre_frame_style_content" role="tab" aria-controls="tab_pre_frame_style" aria-selected="false"><?php echo trans("pre_frame_style"); ?></a>
                                </li>
                                 <li class="nav-item">
                                    <a class="nav-link" id="tab_pre_min_max_setting" data-toggle="tab" href="#tab_pre_min_max_setting_content" role="tab" aria-controls="tab_pre_min_max_setting" aria-selected="false"><?php echo trans("pre_min_max_setting"); ?></a>
                                </li>
                            </ul>

                            <div id="accordion" class="tab-content">
                                <div class="tab-pane fade active in" id="tab_pre_type_content" role="tabpanel">
                                    <div class="card">
                                        <div class="box-body">
                                            <div class="row">
                                                <!-- include message block -->
                                                <div class="col-sm-12">
                                                    <?php $this->load->view('admin/includes/_messages'); ?>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-sm-12">
                                                    <div class="table-responsive">
                                                        <table class="table table-bordered table-striped" role="grid">
                                                            <?php $this->load->view('admin/predefine/predefine_type_post'); ?>
                                                            <thead>
                                                                <tr role="row">
                                                                    <th><?php echo trans('id'); ?></th>
                                                                    <th><?php echo trans('type'); ?></th>
                                                                    <th><?php echo trans('date'); ?></th>
                                                                    <th></th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                            <?php foreach ($pre_types as $item): ?>
                                                                <tr>
                                                                    <td>#<?php echo $item->id; ?></td>
                                                                    <td><?php echo $item->type; ?></td>
                                                                    <td><?php echo $item->date; ?></td>
                                                                    <td style="width:100px;">
                                                                        <div class="dropdown">
                                                                            <button class="btn bg-purple dropdown-toggle btn-select-option"
                                                                                    type="button"
                                                                                    data-toggle="dropdown"><?php echo trans('select_option'); ?>
                                                                                <span class="caret"></span>
                                                                            </button>
                                                                            <ul class="dropdown-menu options-dropdown">
                                                                                <li>
                                                                                    <a href="<?php echo admin_url(); ?>update-pre-type/<?php echo html_escape($item->id); ?>"><i class="fa fa-edit option-icon"></i><?php echo trans('edit'); ?></a>
                                                                                </li>
                                                                                <li>
                                                                                    <a href="javascript:void(0)" onclick="delete_item('admin_controller/delete_type_item_post','<?php echo $item->id; ?>','<?php echo trans("confirm_delete_item"); ?>');"><i class="fa fa-trash option-icon"></i><?php echo trans('delete'); ?></a>
                                                                                </li>
                                                                            </ul>
                                                                        </div>
                                                                    </td>
                                                                </tr>
                                                            <?php endforeach; ?>
                                                            </tbody>
                                                        </table>

                                                        <?php if (empty($pre_types)): ?>
                                                            <p class="text-center">
                                                                <?php echo trans("no_records_found"); ?>
                                                            </p>
                                                        <?php endif; ?>
                                                        <div class="col-sm-12 table-ft">
                                                            <div class="row">
                                                                <div class="pull-right">
                                                                    <?php echo $this->pagination->create_links(); ?>
                                                                </div>
                                                            </div>
                                                        </div>

                                                    </div>
                                                </div>
                                            </div>
                                        </div><!-- /.box-body -->
                                    </div>
                                </div>
                                <div class="tab-pane fade" id="tab_pre_categories_content" role="tabpanel">
                                    <div class="card">
                                        <div class="box-body">
                                            <div class="row">
                                                <!-- include message block -->
                                                <div class="col-sm-12">
                                                    <?php $this->load->view('admin/includes/_messages'); ?>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-sm-12">
                                                    <div class="table-responsive">
                                                        <table class="table table-bordered table-striped" role="grid">
                                                            <?php $this->load->view('admin/predefine/predefine_categories_post'); ?>
                                                            <thead>
                                                                <tr role="row">
                                                                    <th><?php echo trans('id'); ?></th>
                                                                    <th><?php echo trans('categories'); ?></th>
                                                                    <th><?php echo trans('date'); ?></th>
                                                                    <th></th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                            <?php foreach ($pre_categories as $item): ?>
                                                                <tr>
                                                                    <td>#<?php echo $item->id; ?></td>
                                                                    <td><?php echo $item->category; ?></td>
                                                                    <td><?php echo $item->date; ?></td>
                                                                    <td style="width:100px;">
                                                                        <div class="dropdown">
                                                                            <button class="btn bg-purple dropdown-toggle btn-select-option"
                                                                                    type="button"
                                                                                    data-toggle="dropdown"><?php echo trans('select_option'); ?>
                                                                                <span class="caret"></span>
                                                                            </button>
                                                                            <ul class="dropdown-menu options-dropdown">
                                                                                <li>
                                                                                    <a href="<?php echo admin_url(); ?>update-pre-categories/<?php echo html_escape($item->id); ?>"><i class="fa fa-edit option-icon"></i><?php echo trans('edit'); ?></a>
                                                                                </li>
                                                                                <li>
                                                                                    <a href="javascript:void(0)" onclick="delete_item('admin_controller/delete_categories_item_post','<?php echo $item->id; ?>','<?php echo trans("confirm_delete_item"); ?>');"><i class="fa fa-trash option-icon"></i><?php echo trans('delete'); ?></a>
                                                                                </li>
                                                                            </ul>
                                                                        </div>
                                                                    </td>
                                                                </tr>
                                                            <?php endforeach; ?>
                                                            </tbody>
                                                        </table>

                                                        <?php if (empty($pre_categories)): ?>
                                                            <p class="text-center">
                                                                <?php echo trans("no_records_found"); ?>
                                                            </p>
                                                        <?php endif; ?>
                                                        <div class="col-sm-12 table-ft">
                                                            <div class="row">
                                                                <div class="pull-right">
                                                                    <?php echo $this->pagination->create_links(); ?>
                                                                </div>
                                                            </div>
                                                        </div>

                                                    </div>
                                                </div>
                                            </div>
                                        </div><!-- /.box-body -->
                                    </div>
                                </div>

                                <div class="tab-pane fade" id="tab_pre_material_option_content" role="tabpanel">
                                    <div class="card">
                                        <div class="box-body">
                                            <div class="row">
                                                <!-- include message block -->
                                                <div class="col-sm-12">
                                                    <?php $this->load->view('admin/includes/_messages'); ?>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-sm-12">
                                                    <div class="table-responsive">
                                                        <table class="table table-bordered table-striped" role="grid">
                                                            <?php $this->load->view('admin/predefine/predefine_materials_post'); ?>
                                                            <thead>
                                                                <tr role="row">
                                                                    <th><?php echo trans('id'); ?></th>
                                                                    <th><?php echo trans('materials'); ?></th>
                                                                    <th><?php echo trans('price')."($)"; ?></th>
                                                                    <th><?php echo trans('date'); ?></th>
                                                                    <th></th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                            <?php foreach ($pre_materials as $item): ?>
                                                                <tr>
                                                                    <td>#<?php echo $item->id; ?></td>
                                                                    <td><?php echo $item->materials; ?></td>
                                                                    <td><?php echo $item->price; ?></td>
                                                                    <td><?php echo $item->date; ?></td>
                                                                    <td style="width:100px;">
                                                                        <div class="dropdown">
                                                                            <button class="btn bg-purple dropdown-toggle btn-select-option"
                                                                                    type="button"
                                                                                    data-toggle="dropdown"><?php echo trans('select_option'); ?>
                                                                                <span class="caret"></span>
                                                                            </button>
                                                                            <ul class="dropdown-menu options-dropdown">
                                                                                <li>
                                                                                    <a href="<?php echo admin_url(); ?>update-pre-materials/<?php echo html_escape($item->id); ?>"><i class="fa fa-edit option-icon"></i><?php echo trans('edit'); ?></a>
                                                                                </li>
                                                                                <li>
                                                                                    <a href="javascript:void(0)" onclick="delete_item('admin_controller/delete_materials_item_post','<?php echo $item->id; ?>','<?php echo trans("confirm_delete_item"); ?>');"><i class="fa fa-trash option-icon"></i><?php echo trans('delete'); ?></a>
                                                                                </li>
                                                                            </ul>
                                                                        </div>
                                                                    </td>
                                                                </tr>
                                                            <?php endforeach; ?>
                                                            </tbody>
                                                        </table>

                                                        <?php if (empty($pre_materials)): ?>
                                                            <p class="text-center">
                                                                <?php echo trans("no_records_found"); ?>
                                                            </p>
                                                        <?php endif; ?>
                                                        <div class="col-sm-12 table-ft">
                                                            <div class="row">
                                                                <div class="pull-right">
                                                                    <?php echo $this->pagination->create_links(); ?>
                                                                </div>
                                                            </div>
                                                        </div>

                                                    </div>
                                                </div>
                                            </div>
                                        </div><!-- /.box-body -->
                                    </div>
                                </div>
                                <div class="tab-pane fade" id="tab_pre_orientation_content" role="tabpanel">
                                    <div class="card">
                                        <div class="box-body">
                                            <div class="row">
                                                <!-- include message block -->
                                                <div class="col-sm-12">
                                                    <?php $this->load->view('admin/includes/_messages'); ?>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-sm-12">
                                                    <div class="table-responsive">
                                                        <table class="table table-bordered table-striped" role="grid">
                                                            <?php $this->load->view('admin/predefine/predefine_orientations_post'); ?>
                                                            <thead>
                                                                <tr role="row">
                                                                    <th><?php echo trans('id'); ?></th>
                                                                    <th><?php echo trans('orientations'); ?></th>
                                                                    <th><?php echo trans('date'); ?></th>
                                                                    <th></th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                            <?php foreach ($pre_orientations as $item): ?>
                                                                <tr>
                                                                    <td>#<?php echo $item->id; ?></td>
                                                                    <td><?php echo $item->orientations; ?></td>
                                                                    <td><?php echo $item->date; ?></td>
                                                                    <td style="width:100px;">
                                                                        <div class="dropdown">
                                                                            <button class="btn bg-purple dropdown-toggle btn-select-option"
                                                                                    type="button"
                                                                                    data-toggle="dropdown"><?php echo trans('select_option'); ?>
                                                                                <span class="caret"></span>
                                                                            </button>
                                                                            <ul class="dropdown-menu options-dropdown">
                                                                                <li>
                                                                                    <a href="<?php echo admin_url(); ?>update-pre-orientations/<?php echo html_escape($item->id); ?>"><i class="fa fa-edit option-icon"></i><?php echo trans('edit'); ?></a>
                                                                                </li>
                                                                                <li>
                                                                                    <a href="javascript:void(0)" onclick="delete_item('admin_controller/delete_orientations_item_post','<?php echo $item->id; ?>','<?php echo trans("confirm_delete_item"); ?>');"><i class="fa fa-trash option-icon"></i><?php echo trans('delete'); ?></a>
                                                                                </li>
                                                                            </ul>
                                                                        </div>
                                                                    </td>
                                                                </tr>
                                                            <?php endforeach; ?>
                                                            </tbody>
                                                        </table>

                                                        <?php if (empty($pre_orientations)): ?>
                                                            <p class="text-center">
                                                                <?php echo trans("no_records_found"); ?>
                                                            </p>
                                                        <?php endif; ?>
                                                        <div class="col-sm-12 table-ft">
                                                            <div class="row">
                                                                <div class="pull-right">
                                                                    <?php echo $this->pagination->create_links(); ?>
                                                                </div>
                                                            </div>
                                                        </div>

                                                    </div>
                                                </div>
                                            </div>
                                        </div><!-- /.box-body -->
                                    </div>
                                </div>
                                <div class="tab-pane fade" id="tab_pre_print_size_content" role="tabpanel">
                                    <div class="card">
                                        <div class="box-body">
                                            <div class="row">
                                                <!-- include message block -->
                                                <div class="col-sm-12">
                                                    <?php $this->load->view('admin/includes/_messages'); ?>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-sm-12">
                                                    <div class="table-responsive">
                                                        <table class="table table-bordered table-striped" role="grid">
                                                            <?php $this->load->view('admin/predefine/predefine_printsize_post'); ?>
                                                            <thead>
                                                                <tr role="row">
                                                                    <th><?php echo trans('id'); ?></th>
                                                                    <th><?php echo trans('materials'); ?></th>
                                                                    <th><?php echo trans('orientations'); ?></th>
                                                                    <th><?php echo trans('pre_print_size'); ?></th>
                                                                    <th><?php echo trans('price'); ?></th>
                                                                    <th><?php echo trans('date'); ?></th>
                                                                    <th></th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                            <?php foreach ($pre_printsizes as $item): ?>
                                                                <tr>
                                                                    <td>#<?php echo $item->id; ?></td>
                                                                    <td><?php 
                                                                        foreach($pre_materials as $material){
                                                                            if($material->id == $item->materials){
                                                                                echo $material->materials;
                                                                                break;
                                                                            }
                                                                        }
                                                                    ?></td>
                                                                    <td><?php 
                                                                        foreach($pre_orientations as $orientation){
                                                                            if($orientation->id == $item->orientations){
                                                                                echo $orientation->orientations;
                                                                                break;
                                                                            }
                                                                        }
                                                                    ?></td>
                                                                    <td><?php echo $item->size; ?></td>
                                                                    <td><?php echo $item->price; ?></td>
                                                                    <td><?php echo $item->date; ?></td>
                                                                    <td style="width:100px;">
                                                                        <div class="dropdown">
                                                                            <button class="btn bg-purple dropdown-toggle btn-select-option"
                                                                                    type="button"
                                                                                    data-toggle="dropdown"><?php echo trans('select_option'); ?>
                                                                                <span class="caret"></span>
                                                                            </button>
                                                                            <ul class="dropdown-menu options-dropdown">
                                                                                <li>
                                                                                    <a href="<?php echo admin_url(); ?>update-pre-printsizes/<?php echo html_escape($item->id); ?>"><i class="fa fa-edit option-icon"></i><?php echo trans('edit'); ?></a>
                                                                                </li>
                                                                                <li>
                                                                                    <a href="javascript:void(0)" onclick="delete_item('admin_controller/delete_printsizes_item_post','<?php echo $item->id; ?>','<?php echo trans("confirm_delete_item"); ?>');"><i class="fa fa-trash option-icon"></i><?php echo trans('delete'); ?></a>
                                                                                </li>
                                                                            </ul>
                                                                        </div>
                                                                    </td>
                                                                </tr>
                                                            <?php endforeach; ?>
                                                            </tbody>
                                                        </table>

                                                        <?php if (empty($pre_printsizes)): ?>
                                                            <p class="text-center">
                                                                <?php echo trans("no_records_found"); ?>
                                                            </p>
                                                        <?php endif; ?>
                                                        <div class="col-sm-12 table-ft">
                                                            <div class="row">
                                                                <div class="pull-right">
                                                                    <?php echo $this->pagination->create_links(); ?>
                                                                </div>
                                                            </div>
                                                        </div>

                                                    </div>
                                                </div>
                                            </div>
                                        </div><!-- /.box-body -->
                                    </div>
                                </div>

                                <div class="tab-pane fade" id="tab_pre_finish_option_content" role="tabpanel">
                                    <div class="card">
                                        <div class="box-body">
                                            <div class="row">
                                                <!-- include message block -->
                                                <div class="col-sm-12">
                                                    <?php $this->load->view('admin/includes/_messages'); ?>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-sm-12">
                                                    <div class="table-responsive">
                                                        <table class="table table-bordered table-striped" role="grid">
                                                            <?php $this->load->view('admin/predefine/predefine_finishoptions_post'); ?>
                                                            <thead>
                                                                <tr role="row">
                                                                    <th><?php echo trans('id'); ?></th>
                                                                    <th><?php echo trans('pre_finish_options'); ?></th>
                                                                    <th><?php echo trans('price')."($)"; ?></th>
                                                                    <th><?php echo trans('date'); ?></th>
                                                                    <th></th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                            <?php foreach ($pre_finishoptions as $item): ?>
                                                                <tr>
                                                                    <td>#<?php echo $item->id; ?></td>
                                                                    <td><?php echo $item->finishoptions; ?></td>
                                                                    <td><?php echo $item->price; ?></td>
                                                                    <td><?php echo $item->date; ?></td>
                                                                    <td style="width:100px;">
                                                                        <div class="dropdown">
                                                                            <button class="btn bg-purple dropdown-toggle btn-select-option"
                                                                                    type="button"
                                                                                    data-toggle="dropdown"><?php echo trans('select_option'); ?>
                                                                                <span class="caret"></span>
                                                                            </button>
                                                                            <ul class="dropdown-menu options-dropdown">
                                                                                <li>
                                                                                    <a href="<?php echo admin_url(); ?>update-pre-finishoptions/<?php echo html_escape($item->id); ?>"><i class="fa fa-edit option-icon"></i><?php echo trans('edit'); ?></a>
                                                                                </li>
                                                                                <li>
                                                                                    <a href="javascript:void(0)" onclick="delete_item('admin_controller/delete_finishoptions_item_post','<?php echo $item->id; ?>','<?php echo trans("confirm_delete_item"); ?>');"><i class="fa fa-trash option-icon"></i><?php echo trans('delete'); ?></a>
                                                                                </li>
                                                                            </ul>
                                                                        </div>
                                                                    </td>
                                                                </tr>
                                                            <?php endforeach; ?>
                                                            </tbody>
                                                        </table>

                                                        <?php if (empty($pre_finishoptions)): ?>
                                                            <p class="text-center">
                                                                <?php echo trans("no_records_found"); ?>
                                                            </p>
                                                        <?php endif; ?>
                                                        <div class="col-sm-12 table-ft">
                                                            <div class="row">
                                                                <div class="pull-right">
                                                                    <?php echo $this->pagination->create_links(); ?>
                                                                </div>
                                                            </div>
                                                        </div>

                                                    </div>
                                                </div>
                                            </div>
                                        </div><!-- /.box-body -->
                                    </div>
                                </div>


                                <div class="tab-pane fade" id="tab_pre_canvas_depth_content" role="tabpanel">
                                    <div class="card">
                                        <div class="box-body">
                                            <div class="row">
                                                <!-- include message block -->
                                                <div class="col-sm-12">
                                                    <?php $this->load->view('admin/includes/_messages'); ?>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-sm-12">
                                                    <div class="table-responsive">
                                                        <table class="table table-bordered table-striped" role="grid">
                                                            <?php $this->load->view('admin/predefine/predefine_canvasdepths_post'); ?>
                                                            <thead>
                                                                <tr role="row">
                                                                    <th><?php echo trans('id'); ?></th>
                                                                    <th><?php echo trans('pre_canvas_depth'); ?></th>
                                                                    <th><?php echo trans('price')."($)"; ?></th>
                                                                    <th><?php echo trans('date'); ?></th>
                                                                    <th></th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                            <?php foreach ($pre_canvasdepths as $item): ?>
                                                                <tr>
                                                                    <td>#<?php echo $item->id; ?></td>
                                                                    <td><?php echo $item->canvasdepths; ?></td>
                                                                    <td><?php echo $item->price; ?></td>
                                                                    <td><?php echo $item->date; ?></td>
                                                                    <td style="width:100px;">
                                                                        <div class="dropdown">
                                                                            <button class="btn bg-purple dropdown-toggle btn-select-option"
                                                                                    type="button"
                                                                                    data-toggle="dropdown"><?php echo trans('select_option'); ?>
                                                                                <span class="caret"></span>
                                                                            </button>
                                                                            <ul class="dropdown-menu options-dropdown">
                                                                                <li>
                                                                                    <a href="<?php echo admin_url(); ?>update-pre-canvasdepths/<?php echo html_escape($item->id); ?>"><i class="fa fa-edit option-icon"></i><?php echo trans('edit'); ?></a>
                                                                                </li>
                                                                                <li>
                                                                                    <a href="javascript:void(0)" onclick="delete_item('admin_controller/delete_canvasdepths_item_post','<?php echo $item->id; ?>','<?php echo trans("confirm_delete_item"); ?>');"><i class="fa fa-trash option-icon"></i><?php echo trans('delete'); ?></a>
                                                                                </li>
                                                                            </ul>
                                                                        </div>
                                                                    </td>
                                                                </tr>
                                                            <?php endforeach; ?>
                                                            </tbody>
                                                        </table>

                                                        <?php if (empty($pre_canvasdepths)): ?>
                                                            <p class="text-center">
                                                                <?php echo trans("no_records_found"); ?>
                                                            </p>
                                                        <?php endif; ?>
                                                        <div class="col-sm-12 table-ft">
                                                            <div class="row">
                                                                <div class="pull-right">
                                                                    <?php echo $this->pagination->create_links(); ?>
                                                                </div>
                                                            </div>
                                                        </div>

                                                    </div>
                                                </div>
                                            </div>
                                        </div><!-- /.box-body -->
                                    </div>
                                </div>


                                <div class="tab-pane fade" id="tab_pre_frame_style_content" role="tabpanel">
                                    <div class="card">
                                        <div class="box-body">
                                            <div class="row">
                                                <!-- include message block -->
                                                <div class="col-sm-12">
                                                    <?php $this->load->view('admin/includes/_messages'); ?>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-sm-12">
                                                    <div class="table-responsive">
                                                        <table class="table table-bordered table-striped" role="grid">
                                                            <?php $this->load->view('admin/predefine/predefine_framestyles_post'); ?>
                                                            <thead>
                                                                <tr role="row">
                                                                    <th><?php echo trans('id'); ?></th>
                                                                    <th><?php echo trans('image'); ?></th>
                                                                    <th><?php echo trans('materials'); ?></th>
                                                                    <th><?php echo trans('pre_frame_style'); ?></th>
                                                                    <th><?php echo trans('price')."($)"; ?></th>
                                                                    <th><?php echo trans('date'); ?></th>
                                                                    <th></th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                            <?php foreach ($pre_framestyles as $item): ?>
                                                                <tr>
                                                                    <td>#<?php echo $item->id; ?></td>
                                                                    <td>
                                                                        <img src="<?= base_url() . $item->image; ?>" style="max-width: 160px; max-height: 160px;">
                                                                    </td>
                                                                    <td><?php 
                                                                        foreach($pre_materials as $material){
                                                                            if($material->id == $item->materials){
                                                                                echo $material->materials;
                                                                                break;
                                                                            }
                                                                        }
                                                                    ?></td>
                                                                    <td><?php echo $item->framestyles; ?></td>
                                                                    <td><?php echo $item->price; ?></td>
                                                                    <td><?php echo $item->date; ?></td>
                                                                    <td style="width:100px;">
                                                                        <div class="dropdown">
                                                                            <button class="btn bg-purple dropdown-toggle btn-select-option"
                                                                                    type="button"
                                                                                    data-toggle="dropdown"><?php echo trans('select_option'); ?>
                                                                                <span class="caret"></span>
                                                                            </button>
                                                                            <ul class="dropdown-menu options-dropdown">
                                                                                <li>
                                                                                    <a href="<?php echo admin_url(); ?>update-pre-framestyles/<?php echo html_escape($item->id); ?>"><i class="fa fa-edit option-icon"></i><?php echo trans('edit'); ?></a>
                                                                                </li>
                                                                                <li>
                                                                                    <a href="javascript:void(0)" onclick="delete_item('admin_controller/delete_framestyles_item_post','<?php echo $item->id; ?>','<?php echo trans("confirm_delete_item"); ?>');"><i class="fa fa-trash option-icon"></i><?php echo trans('delete'); ?></a>
                                                                                </li>
                                                                            </ul>
                                                                        </div>
                                                                    </td>
                                                                </tr>
                                                            <?php endforeach; ?>
                                                            </tbody>
                                                        </table>

                                                        <?php if (empty($pre_framestyles)): ?>
                                                            <p class="text-center">
                                                                <?php echo trans("no_records_found"); ?>
                                                            </p>
                                                        <?php endif; ?>
                                                        <div class="col-sm-12 table-ft">
                                                            <div class="row">
                                                                <div class="pull-right">
                                                                    <?php echo $this->pagination->create_links(); ?>
                                                                </div>
                                                            </div>
                                                        </div>

                                                    </div>
                                                </div>
                                            </div>
                                        </div><!-- /.box-body -->
                                    </div>
                                </div>

                                <div class="tab-pane fade" id="tab_pre_min_max_setting_content" role="tabpanel">
                                    <div class="card">
                                        <div class="box-body">
                                            <div class="row">
                                                <!-- include message block -->
                                                <div class="col-sm-12">
                                                    <?php $this->load->view('admin/includes/_messages'); ?>
                                                </div>
                                            </div>

                                            <div class="row">
                                                <div class="col-sm-12">
                                                    <?php $this->load->view('admin/predefine/update_minmaxsettings'); ?>
                                                </div>
                                            </div>
                                        </div><!-- /.box-body -->
                                    </div>
                                </div>

                            </div>

                        </div>
                    </div>
                </div>
            </div>
        
        </div>
        <!-- /.box -->
    </div>
</div>

<script>
    $(".nav-template-item").click(function () {
        $(".nav-template-item").removeClass("active");
        $(this).addClass("active");
        var id = $(this).attr("data-nav-id");
        $("#input_navigation").val(id);
    });
</script>
