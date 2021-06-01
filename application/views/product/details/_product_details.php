<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>
<div class="row">
    <div class="col-12">
        <?php if ($product->product_type == 'digital'):
            if ($product->is_free_product == 1):
                if ($this->auth_check):?>
                    <div class="row-custom m-t-10">
                        <?php echo form_open('download-free-digital-file-post'); ?>
                        <input type="hidden" name="product_id" value="<?php echo $product->id; ?>">
                        <button class="btn btn-instant-download"><i class="icon-download-solid"></i><?php echo trans("download") ?></button>
                        <?php echo form_close(); ?>
                    </div>
                <?php else: ?>
                    <div class="row-custom m-t-10">
                        <button class="btn btn-instant-download" data-toggle="modal" data-target="#loginModal"><i class="icon-download-solid"></i><?php echo trans("download") ?></button>
                    </div>
                <?php endif; ?>
            <?php else: ?>
                <?php if (!empty($digital_sale)): ?>
                    <div class="row-custom m-t-10">
                        <?php echo form_open('download-purchased-digital-file-post'); ?>
                        <input type="hidden" name="sale_id" value="<?php echo $digital_sale->id; ?>">
                        <button class="btn btn-instant-download"><i class="icon-download-solid"></i><?php echo trans("download") ?></button>
                        <?php echo form_close(); ?>
                    </div>
                <?php else: ?>
                    <label class="label-instant-download"><i class="icon-download-solid"></i><?php echo trans("instant_download"); ?></label>
                <?php endif;
            endif;
        endif; ?>

        <h1 class="product-title"><?= html_escape($title); ?></h1>
        <?php if ($product->status == 0): ?>
            <label class="badge badge-warning badge-product-status"><?php echo trans("pending"); ?></label>
        <?php elseif ($product->visibility == 0): ?>
            <label class="badge badge-danger badge-product-status"><?php echo trans("hidden"); ?></label>
        <?php endif; ?>
        <div class="row-custom meta">
            <div class="product-details-user">
                <?php echo trans("by"); ?>&nbsp;<a href="<?php echo generate_profile_url($product->user_slug); ?>"><?php echo character_limiter(get_shop_name_product($product), 30, '..'); ?></a>
            </div>
            <?php if ($this->general_settings->product_comments == 1): ?>
                <span><i class="icon-comment"></i><?php echo html_escape($comment_count); ?></span>
            <?php endif; ?>
            <?php if ($this->general_settings->reviews == 1): ?>
                <div class="product-details-review">
                    <?php $this->load->view('partials/_review_stars', ['review' => $product->rating]); ?>
                    <span>(<?php echo $review_count; ?>)</span>
                </div>
            <?php endif; ?>
            <span><i class="icon-heart"></i><?php echo get_product_wishlist_count($product->id); ?></span>
            <span><i class="icon-eye"></i><?php echo html_escape($product->pageviews); ?></span>
        </div>
        <div class="row-custom price">
            <div id="product_details_price_container" class="d-inline-block">
                <?php $this->load->view("product/details/_price", ['product' => $product, 'price' => $product->price, 'discount_rate' => $product->discount_rate]); ?>
                <?php if ($product->is_sold == 1): ?>
                    <strong class="lbl-sold"><?= trans("sold"); ?></strong>
                <?php endif; ?>
            </div>
            <?php $show_ask = true;
            if ($product->listing_type == 'ordinary_listing' && empty($product->external_link)):
                $show_ask = false;
            endif;
            if ($show_ask == true):?>
                <?php if ($this->auth_check): ?>
                    <button class="btn btn-contact-seller" data-toggle="modal" data-target="#messageModal"><i class="icon-envelope"></i> <?php echo trans("ask_question") ?></button>
                <?php else: ?>
                    <button class="btn btn-contact-seller" data-toggle="modal" data-target="#loginModal"><i class="icon-envelope"></i> <?php echo trans("ask_question") ?></button>
                <?php endif;
            endif; ?>
        </div>

        <div class="row-custom details">
            <?php if ($product->listing_type != 'ordinary_listing' && $product->product_type != 'digital'): ?>
                <div class="item-details">
                    <div class="left">
                        <label><?php echo trans("status"); ?></label>
                    </div>
                    <div id="text_product_stock_status" class="right">
                        <?php if (check_product_stock($product)): ?>
                            <span class="status-in-stock text-success"><?php echo trans("in_stock") ?></span>
                        <?php else: ?>
                            <span class="status-in-stock text-danger"><?php echo trans("out_of_stock") ?></span>
                        <?php endif; ?>
                    </div>
                </div>
            <?php endif; ?>
            <?php if ($this->product_settings->marketplace_sku == 1 && !empty($product->sku)): ?>
                <div class="item-details">
                    <div class="left">
                        <label><?php echo trans("sku"); ?></label>
                    </div>
                    <div class="right">
                        <span><?php echo html_escape($product->sku); ?></span>
                    </div>
                </div>
            <?php endif; ?>
            <?php if ($product->product_type == 'digital' && !empty($product->files_included)): ?>
                <div class="item-details">
                    <div class="left">
                        <label><?php echo trans("files_included"); ?></label>
                    </div>
                    <div class="right">
                        <span><?php echo html_escape($product->files_included); ?></span>
                    </div>
                </div>
            <?php endif; ?>
            <?php if ($product->listing_type == 'ordinary_listing'): ?>
                <div class="item-details">
                    <div class="left">
                        <label><?php echo trans("uploaded"); ?></label>
                    </div>
                    <div class="right">
                        <span><?php echo time_ago($product->created_at); ?></span>
                    </div>
                </div>
            <?php endif; ?>
        </div>
    </div>
</div>
<?php echo form_open(get_product_form_data($product)->add_to_cart_url, ['id' => 'form_add_cart']); ?>
<input type="hidden" name="product_id" value="<?php echo $product->id; ?>">

<div class="row">
    <div class="col-12">
        <div class="row-custom product-variations">
            <div class="row row-product-variation item-variation">
                <?php if (!empty($full_width_product_variations)):
                    // print_r($full_width_product_variations);
                    foreach ($full_width_product_variations as $variation):
                        $this->load->view('product/details/_product_variations', ['variation' => $variation]);
                    endforeach;
                endif;
                if (!empty($half_width_product_variations)):
                    foreach ($half_width_product_variations as $variation):
                        $this->load->view('product/details/_product_variations', ['variation' => $variation]);
                    endforeach;
                endif; ?>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-12"><?php $this->load->view('product/details/_messages'); ?></div>
</div>

<div class="row" id="select_material">
    <div class="col-12">
        <div class="form-group">
            <div class="row">
                <div class="col-sm-3 col-xs-12">
                    <label><?php echo trans('materials').":"; ?></label>
                </div>
                <?php if(!empty($materials)): 
                    $key = 0;
                    foreach($materials as $material):
                        if($material->status == 1):?>
                        <div class="col-sm-3 col-xs-12 col-option">
                            <input type="radio" name="materials" value="<?php echo $material->id?>" id="materials_<?php echo $material->id?>" onchange="selected_material(material_type = '<?php echo $material->materials?>')" class="square-purple sz-20" <?php echo $key == 0?'checked':''; ?>>
                            <label for="materials_<?php echo $material->id?>" class="option-label trans-y"><?php echo $material->materials?></label>
                        </div>
                        <?php $key++; ?>
                    <?php endif ?>
                    <?php endforeach ?>
                <?php  endif ?>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-12">
        <div class="form-group" id="printsize">
            <div class="row">
            <?php if(!empty($printsizes)){?>
                <div class="col-sm-<?php echo $first_material == get_id_by_material_name('Canvas')?'6':'12'; ?> col-xs-12">
                    
                <?php if($first_material == get_id_by_material_name('Metal')){?>
                    <div class="row">
                        <div class="col-sm-12 col-xs-12">
                            <label><?php echo trans("select_size"); ?></label>
                        </div>

                        <?php foreach($printsizes as $key => $printsize){
                            if($printsize->materials == $first_material && $printsize->orientations == $orientation){
                                if($material->status == 1):?>                            
                                    <div class="col-sm-4 col-xs-12 col-option">
                                        <input type="radio" name="select_size_metal" value="<?php echo $printsize->id;?>" id="select_size_<?php echo $printsize->id;?>" data-value="<?php echo $printsize->price;?>" onchange="calculat_price($(this).val(), $(this).attr('data-value'), variation_type = 'printsize')" class="square-purple sz-20" <?php echo $key == 0?'checked':''; ?> required>
                                        <label for="select_size_<?php echo $printsize->id?>" class="option-label trans-y">&nbsp;<?php echo $printsize->size;?></label>
                                    </div>
                                <?php endif ?>
                        <?php }}?>
                    </div>
                <?php }else{?>
                    <div class="row">
                        <div class="col-sm-12 col-xs-12 col-option">
                            <label><?php echo trans('select_size'); ?></label>
                            
                            <select name="select_size" class="form-control" onchange="calculat_price($(this).val(), $(this).find('option:selected').attr('data-value'), variation_type = 'printsize')">
                                <?php foreach($printsizes as $printsize){
                                    if($printsize->materials == $first_material && $printsize->orientations == $orientation){
                                        if($printsize->status == 1):?>
                                            <option value="<?php echo $printsize->id?>" data-value="<?php echo $printsize->price?>"><?php echo $printsize->size;?></option>
                                        <?php endif ?>
                                <?php }}?>
                            </select>
                        </div>
                    </div>
                <?php }?>
                </div>
            <?php }?>

            <?php if($first_material == get_id_by_material_name('Canvas')): ?>
                <div class="col-sm-6 col-xs-12">
                    <div class="row">
                        <div class="col-sm-12 col-xs-12 col-option">
                            <label><?php echo trans('pre_canvas_depth'); ?></label>
                            <select name="canvas_depth" class="form-control" onchange="calculat_price($(this).val(), $(this).find('option:selected').attr('data-value'), variation_type = 'canvasdepth')">
                            <?php if(!empty($canvasdepths)){
                                foreach($canvasdepths as $canvasdepth){ 
                                    if($canvasdepth->status == 1):?>
                                        <option value="<?php echo $canvasdepth->id;?>" data-value="<?php echo $canvasdepth->price?>"><?php echo $canvasdepth->canvasdepths;?></option>
                                    <?php endif ?>
                                <?php }}?>
                            </select>
                        </div>
                    </div>
                </div>
            <?php endif?>

            </div>
        </div>
    </div>
</div>

<div class="row" id="finish_option">
    <div class="col-12">
        <div class="form-group">
            <div class="row">
                <div class="col-sm-4 col-xs-12">
                    <label><?php echo trans('select_finish').":"; ?></label>
                </div>
                <?php if(!empty($finishoptions)){
                    foreach($finishoptions as $key => $finishoption){ 
                        if($finishoption->status == 1):?>
                            <div class="col-sm-2 col-xs-12 col-option">
                                <input type="radio" name="finish_option" value="<?php echo $finishoption->id;?>" data-value="<?php echo $finishoption->price?>" id="finish_option<?php echo $finishoption->id;?>" class="square-purple sz-20" <?php echo $key == 0?'checked':''; ?> onchange="calculat_price($(this).val(), $(this).attr('data-value'), variation_type = 'finishoption')" required>
                                <label for="finish_option<?php echo $finishoption->id;?>" class="option-label trans-y"><?php echo $finishoption->finishoptions;?></label>
                            </div>
                        <?php endif ?>
                <?php }}?>
                
                <div class="col-sm-2 col-xs-12 col-option">
                   
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row" id="show_framestyle">
    <div class="col-12">
        <div class="form-group">
            <div class="row">
                <div class="col-sm-3 col-xs-12" style="padding-top:10px;">
                    <label><?php echo trans('pre_frame_style').":"; ?></label>
                </div>
                <div class="col-9 col-product-variation product-variation-radio" id="select_framestyle">
                    <?php if(!empty($framestyles)){
                        $key = 0;
                        foreach($framestyles as $framestyle){ 
                            if($framestyle->materials == $first_material){ 
                                if($framestyle->status == 1):?>
                                    <div class="custom-control custom-control-variation custom-control-validate-input">
                                        <input type="radio" name="framestyle" value="<?php echo $framestyle->id;?>" id="checkbox_<?php echo $framestyle->id;?>" data-value="<?php echo $framestyle->price?>" class="custom-control-input" <?php echo $key == 0?'checked':''; ?> onchange="calculat_price($(this).val(), $(this).attr('data-value'), variation_type = 'framestyle')" required>
                                        <label for="checkbox_<?php echo $framestyle->id;?>" data-input-name="variation_<?php echo $framestyle->id;?>" class="custom-control-label custom-control-label-image label-variation_<?php echo $framestyle->id;?>">
                                            <img src="<?= base_url(); ?><?php echo $framestyle->image;?>" class="img-variation-option" data-toggle="tooltip" data-placement="top" title="<?php echo $framestyle->framestyles;?>" alt="<?php echo $framestyle->framestyles;?>">
                                        </label>
                                    </div>
                                <?php endif ?>
                       <?php  $key++;}}}?>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row" id="show_error">
    <div class="col-12">
        <h6 style="width:100%;text-align:center;margin-bottom:40px;"><?php echo trans('predefine_not_completed'); ?></h6>
    </div>
</div>

<div class="row">
    <div class="col-12 product-add-to-cart-container">
        <?php if ($product->is_sold != 1 && $product->listing_type != 'ordinary_listing' && $product->product_type != 'digital'): ?>
            <div class="number-spinner">
                <div class="input-group">
                        <span class="input-group-btn">
                            <button type="button" class="btn btn-default btn-spinner-minus" data-dir="dwn">-</button>
                        </span>
                    <input type="text" class="form-control text-center" name="product_quantity" value="1">
                    <span class="input-group-btn">
                            <button type="button" class="btn btn-default btn-spinner-plus" data-dir="up">+</button>
                        </span>
                </div>
            </div>
        <?php endif; ?>
        <?php $buttton = get_product_form_data($product)->button;
        if ($product->is_sold != 1 && !empty($buttton)):?>
            <div class="button-container">
                <?php echo $buttton; ?>
            </div>
        <?php endif; ?>
        <div class="button-container button-container-wishlist">
            <?php if ($this->product_model->is_product_in_wishlist($product->id) == 1): ?>
                <a href="javascript:void(0)" class="btn-wishlist btn-add-remove-wishlist" data-product-id="<?php echo $product->id; ?>" data-reload="1"><i class="icon-heart"></i><span><?php echo trans("remove_from_wishlist"); ?></span></a>
            <?php else: ?>
                <a href="javascript:void(0)" class="btn-wishlist btn-add-remove-wishlist" data-product-id="<?php echo $product->id; ?>" data-reload="1"><i class="icon-heart-o"></i><span><?php echo trans("add_to_wishlist"); ?></span></a>
            <?php endif; ?>
        </div>
    </div>

    <?php if (!empty($product->demo_url)): ?>
        <div class="col-12 product-add-to-cart-container">
            <div class="button-container">
                <a href="<?php echo $product->demo_url; ?>" target="_blank" class="btn btn-md btn-live-preview"><i class="icon-preview"></i><?php echo trans("live_preview") ?></a>
            </div>
        </div>
    <?php endif; ?>

</div>
<?php echo form_close(); ?>

<!--Include social share-->
<?php $this->load->view("product/details/_product_share"); ?>

<script src="<?= base_url(); ?>assets/js/jquery-3.5.1.min.js"></script>
<script>
    let select_size_price = 0;
    let canvas_depth_price = 0;
    let finish_option_price = 0;
    let frame_style_price = 0;
    let add_price = 0;

    let selected_type = ""

    $("#show_error").hide();
    
    let first_material = "<?php echo $first_material;?>"
    const Canvas = "<?php echo get_id_by_material_name('Canvas');?>"
    const FineArt = "<?php echo get_id_by_material_name('Fine Art');?>"
    const Metal = "<?php echo get_id_by_material_name('Metal');?>"

    if(first_material == Canvas) selected_type = "Canvas"
    if(first_material == FineArt) selected_type = "FineArt"
    if(first_material == Metal) selected_type = "Metal"

    let price_element = $(".lbl-price")

    if(selected_type == "Metal") selected_type = Number($("input[name='finish_option']").attr('data-value'))
    else select_size_price = Number($("select[name='select_size']").find('option:selected').attr("data-value"))
    if(selected_type == "Canvas") canvas_depth_price = Number($("select[name='canvas_depth']").find('option:selected').attr("data-value"))
    finish_option_price = Number($("input[name='finish_option']").attr('data-value'))
    frame_style_price = Number($("input[name='framestyle']").attr('data-value'))

    add_price = select_size_price + canvas_depth_price + finish_option_price + frame_style_price
    
    console.log(select_size_price, canvas_depth_price, finish_option_price, frame_style_price, add_price)

    // product_price = Number(price_element.html().trim().replace('<span>$</span>', '').replaceAll(',', ''))
    // price_element.html("$3,956.24")

    

    $(document).ready(function(){
        // console.log("after_price:", product_price)

        product_id = "<?php echo $product->id;?>"
        product_price = "<?php echo $product->price;?>"
        discount_rate = "<?php echo $product->discount_rate;?>"

        ajax_func(product_id, product_price, discount_rate)
        $("#select_material input[type='radio']").click(function(){
            const material_id = $(this).attr('id').replace('materials_','').trim()
            const orient_id = "<?php echo $orientation;?>"

            let data = {
                "orient_id": orient_id,
                "material_id": material_id
            };

            data[csfr_token_name] = $.cookie(csfr_cookie_name);

            $.ajax({
                type: "POST",
                url: "<?= base_url(); ?>home_controller/get_printsize_by_material",
                data: data,
                dataType: "JSON",
                success: function (response) {

                    let codeString = ""
                    let codeStringFrameStyle = ""

                    product_id = "<?php echo $product->id;?>"
                    product_price = "<?php echo $product->price;?>"
                    discount_rate = "<?php echo $product->discount_rate;?>"

                    ajax_func(product_id, product_price, discount_rate)

                    if(material_id == Canvas){

                        let canvasdepth = response.canvasdepth
                        let printsize = response.printsize
                        let framestyle = response.framestyle

                        $("#finish_option").show();
                        $("#show_framestyle").show();
                        
                        if(canvasdepth.length > 0 && printsize.length > 0 && framestyle.length > 0){
                            codeString += "<div class='row'>"

                            codeString += "<div class='col-sm-6 col-xs-12'>"
                            codeString += "<div class='row'>"
                            codeString += "<div class='col-sm-12 col-xs-12 col-option'>"
                            codeString += "<label><?php echo trans('select_size'); ?></label>"
                            codeString += "<select name='select_size' class='form-control'>"
                            for(let r in printsize){
                                if(printsize[r].status == '1'){
                                    codeString += "<option value='"+printsize[r].id+"' data-value='"+printsize[r].price+"'>"+printsize[r].size+"</option>"
                                }
                            }
                            codeString += "</select>"
                            codeString += "</div>"
                            codeString += "</div>"
                            codeString += "</div>"

                            codeString += "<div class='col-sm-6 col-xs-12'>"
                            codeString += "<div class='row'>"
                            codeString += "<div class='col-sm-12 col-xs-12 col-option'>"
                            codeString += "<label><?php echo trans('pre_canvas_depth'); ?></label>"
                            codeString += "<select name='canvas_depth' class='form-control'>"
                            for(let r in canvasdepth){
                                if(canvasdepth[r].status == '1'){
                                    codeString += "<option value='"+canvasdepth[r].id+"' data-value='"+canvasdepth[r].price+"'>"+canvasdepth[r].canvasdepths+"</option>"
                                }
                            }
                            codeString += "</select>"
                            codeString += "</div>"
                            codeString += "</div>"
                            codeString += "</div>"



                            codeString += "</div>"

                            let key = 0
                            for(let f in framestyle){
                                if(framestyle[f].status == '1'){
                                    codeStringFrameStyle += "<div class='custom-control custom-control-variation custom-control-validate-input'>"
                                    if(key == 0){
                                        codeStringFrameStyle += "<input type='radio' name='framestyle' value='"+framestyle[f].id+"' id='checkbox_"+framestyle[f].id+"' data-value='"+framestyle[f].price+"' class='custom-control-input' checked required>"
                                    }else{
                                        codeStringFrameStyle += "<input type='radio' name='framestyle' value='"+framestyle[f].id+"' id='checkbox_"+framestyle[f].id+"' data-value='"+framestyle[f].price+"' class='custom-control-input' required>"
                                    }
                                    codeStringFrameStyle += "<label for='checkbox_"+framestyle[f].id+"' data-input-name='variation_"+framestyle[f].id+"' class='custom-control-label custom-control-label-image label-variation_"+framestyle[f].id+"'>"
                                    codeStringFrameStyle += "<img src='<?= base_url(); ?>"+framestyle[f].image+"' class='img-variation-option' data-toggle='tooltip' data-placement='top' title='"+framestyle[f].framestyles+"' alt='"+framestyle[f].framestyles+"'>"
                                    codeStringFrameStyle += "</label>"
                                    codeStringFrameStyle += "</div>"
                                    key++
                                }
                            }
                        }else{
                            $("#finish_option").hide();
                            $("#show_framestyle").hide();
                            $("#show_error").show();
                        }
                        

                    }else if(material_id == Metal){
                        let printsize = response.printsize
                        let framestyle = response.framestyle

                        $("#show_framestyle").show();
                        $("#finish_option").show();

                        if(printsize.length > 0 && framestyle.length > 0){
                            codeString += "<div class='row'>"
                            codeString += "<div class='col-sm-12 col-xs-12'>"
                            codeString += "<label><?php echo trans('select_size'); ?></label>"
                            codeString += "</div>"

                            let first_size = 0;
                            for(let r in printsize){
                                if(printsize[r].status == '1'){
                                    codeString += "<div class='col-sm-4 col-xs-12 col-option'>"
                                    if(first_size == 0) codeString += "<input type='radio' name='select_size_metal' value='"+printsize[r].id+"' id='select_size_"+printsize[r].id+"' data-value='"+printsize[r].price+"' class='square-purple sz-20' checked required>"
                                    else codeString += "<input type='radio' name='select_size_metal' value='"+printsize[r].id+"' id='select_size_"+printsize[r].id+"' data-value='"+printsize[r].price+"' class='square-purple sz-20' required>"
                                    codeString += "<label for='select_size_"+printsize[r].id+"' class='option-label trans-y'>&nbsp;"+printsize[r].size+"</label>"
                                    codeString += "</div>"
                                    first_size++
                                }
                            }
                            codeString += "</div>"

                            let key = 0
                            for(let f in framestyle){
                                if(framestyle[f].status == '1'){
                                    codeStringFrameStyle += "<div class='custom-control custom-control-variation custom-control-validate-input'>"
                                    if(key == 0){
                                        codeStringFrameStyle += "<input type='radio' name='framestyle' value='"+framestyle[f].id+"' id='checkbox_"+framestyle[f].id+"' data-value='"+framestyle[f].price+"' class='custom-control-input' checked required>"
                                    }else{
                                        codeStringFrameStyle += "<input type='radio' name='framestyle' value='"+framestyle[f].id+"' id='checkbox_"+framestyle[f].id+"' data-value='"+framestyle[f].price+"' class='custom-control-input' required>"
                                    }
                                    codeStringFrameStyle += "<label for='checkbox_"+framestyle[f].id+"' data-input-name='variation_"+framestyle[f].id+"' class='custom-control-label custom-control-label-image label-variation_"+framestyle[f].id+"'>"
                                    codeStringFrameStyle += "<img src='<?= base_url(); ?>"+framestyle[f].image+"' class='img-variation-option' data-toggle='tooltip' data-placement='top' title='"+framestyle[f].framestyles+"' alt='"+framestyle[f].framestyles+"'>"
                                    codeStringFrameStyle += "</label>"
                                    codeStringFrameStyle += "</div>"
                                    key++
                                }
                            }
                        }else{
                            $("#finish_option").hide();
                            $("#show_framestyle").hide();
                            $("#show_error").show();
                        }

                    }else if (material_id == FineArt){
                        let printsize = response.printsize
                        let framestyle = response.framestyle
                        $("#show_framestyle").show();
                        $("#finish_option").show();
                        if(printsize.length > 0 && framestyle.length > 0){
                            codeString += "<div class='row'>"
                            codeString += "<div class='col-sm-12 col-xs-12'>"
                            codeString += "<div class='row'>"
                            codeString += "<div class='col-sm-12 col-xs-12 col-option'>"
                            codeString += "<label><?php echo trans('select_size'); ?></label>"
                            codeString += "<select name='select_size' class='form-control'>"
                            for(let r in printsize){
                                if(printsize[r].status == '1'){
                                    codeString += "<option value='"+printsize[r].id+"' data-value='"+printsize[r].price+"'>"+printsize[r].size+"</option>"
                                }
                            }
                            codeString += "</select>"
                            codeString += "</div>"
                            codeString += "</div>"
                            codeString += "</div>"
                            codeString += "</div>"

                            let key = 0
                            for(let f in framestyle){
                                if(framestyle[f].status == '1'){
                                    codeStringFrameStyle += "<div class='custom-control custom-control-variation custom-control-validate-input'>"
                                    if(key == 0){
                                        codeStringFrameStyle += "<input type='radio' name='framestyle' value='"+framestyle[f].id+"' id='checkbox_"+framestyle[f].id+"' data-value='"+framestyle[f].price+"' class='custom-control-input' checked required>"
                                    }else{
                                        codeStringFrameStyle += "<input type='radio' name='framestyle' value='"+framestyle[f].id+"' id='checkbox_"+framestyle[f].id+"' data-value='"+framestyle[f].price+"' class='custom-control-input' required>"
                                    }
                                    codeStringFrameStyle += "<label for='checkbox_"+framestyle[f].id+"' data-input-name='variation_"+framestyle[f].id+"' class='custom-control-label custom-control-label-image label-variation_"+framestyle[f].id+"'>"
                                    codeStringFrameStyle += "<img src='<?= base_url(); ?>"+framestyle[f].image+"' class='img-variation-option' data-toggle='tooltip' data-placement='top' title='"+framestyle[f].framestyles+"' alt='"+framestyle[f].framestyles+"'>"
                                    codeStringFrameStyle += "</label>"
                                    codeStringFrameStyle += "</div>"
                                    key++
                                }
                            }
                        }else{
                            $("#finish_option").hide();
                            $("#show_framestyle").hide();
                            $("#show_error").show();
                        }
                    }else{
                        $("#finish_option").hide();
                        $("#show_framestyle").hide();
                        $("#show_error").show();
                    }

                    $("#printsize").html(codeString)
                    $("#select_framestyle").html(codeStringFrameStyle)

                    $('[data-toggle="tooltip"]').tooltip();

                    $("select[name='select_size']").change(function(){
                        calculat_price($(this).val(), $(this).find('option:selected').attr('data-value'), variation_type = 'printsize')
                    })
                    $("select[name='canvas_depth']").change(function(){
                        calculat_price($(this).val(), $(this).find('option:selected').attr('data-value'), variation_type = 'canvasdepth')
                    })
                    $("input[name='framestyle']").change(function(){
                        calculat_price($(this).val(), $(this).attr('data-value'), variation_type = 'framestyle')
                    })
                    $("input[name='select_size_metal']").change(function(){
                        calculat_price($(this).val(), $(this).attr('data-value'), variation_type = 'printsize')
                    })

                    
                    if(selected_type == "Metal"){
                        select_size_price = Number($("input[name='select_size_metal']").attr('data-value'))
                    }else{
                        select_size_price = Number($("select[name='select_size']").find('option:selected').attr("data-value"))
                    }
                    if(selected_type == "Canvas"){
                        canvas_depth_price = Number($("select[name='canvas_depth']").find('option:selected').attr("data-value"))
                    }else{
                        canvas_depth_price = 0
                    } 
                    finish_option_price = Number($("input[name='finish_option']").attr('data-value'))
                    frame_style_price = Number($("input[name='framestyle']").attr('data-value'))

                }
            });

            
        })
    })

    function calculat_price(val, price, type){

        product_id = "<?php echo $product->id;?>"
        product_price = "<?php echo $product->price;?>"
        discount_rate = "<?php echo $product->discount_rate;?>"
        console.log("before_price:", product_price, discount_rate, product_id)

        if(type == 'printsize'){
            select_size_price = Number(price)
        }else if(type == 'canvasdepth'){
            canvas_depth_price = Number(price)
        }else if(type == 'finishoption'){
            finish_option_price = Number(price)
        }else if(type == 'framestyle'){
            frame_style_price = Number(price)
        }

        add_price = select_size_price + canvas_depth_price + finish_option_price + frame_style_price
        let calculated_product_price = (((Number(product_price)/100)+add_price)*100)
        // console.log((Number(product_price)/100+add_price)*100)
        console.log("sz:", select_size_price,"cd:", canvas_depth_price,"fo:", finish_option_price,"fs:", frame_style_price,"ap:", add_price, product_price, calculated_product_price)

        ajax_func(product_id, calculated_product_price, discount_rate)
    }

    function ajax_func(product_id, product_price, discount_rate){
        let price_data = {
            "product_id": product_id,
            "price": product_price,
            "discount_rate": discount_rate
        };

        price_data[csfr_token_name] = $.cookie(csfr_cookie_name);
        $.ajax({
            type: "POST",
            url: "<?= base_url(); ?>home_controller/get_formated_price",
            data: price_data,
            dataType: "JSON",
            success: function (response) {
                $("#product_details_price_container").html(response)
                
            }
        })
    }

    function selected_material(type){
        selected_type = type
        $("input[name='finish_option']:first").prop("checked", true)
    }
</script>