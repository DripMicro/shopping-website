<div class="row">
    <div class="col-md-12">
        <div class="box box-primary">
            <div class="box-header with-border">
                <h3 class="box-title"><?php echo trans('pre_min_max_setting'); ?></h3>
            </div>
            <!-- /.box-header -->

            <div class="box-body">
                <!-- include message block -->
                <div class="row">
                    <div class="col-12">
                        <div class="product-description post-text-responsive">
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
