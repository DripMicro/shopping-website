<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>
<!-- Send Message Modal -->
<?php if ($this->auth_check): ?>
    <!-- form start -->
    <div class="container">
        <h2 class="title tx-center"><?php echo trans("send_message"); ?></h2>
        <form id="form_send_message" novalidate="novalidate">
            <input type="hidden" name="receiver_id" id="message_receiver_id" value="<?php echo $user->id; ?>">
            <input type="hidden" id="message_send_em" value="<?php echo $user->send_email_new_message; ?>">
            
            <div class="row decline-message">
                <div class="col-12">
                    <div id="send-message-result"></div>
                    <div class="form-group">
                        <div class="row">
                            <div class="col-12">
                                <div class="user-contact-modal">
                                    <div class="left">
                                        <a href="<?php echo generate_profile_url($user->slug); ?>"><img src="<?php echo get_user_avatar($user); ?>" alt="<?php echo get_shop_name($user); ?>"></a>
                                    </div>
                                    <div class="right">
                                        <strong><a href="<?php echo generate_profile_url($user->slug); ?>"><?php echo get_shop_name($user); ?></a></strong>
                                        <?php if ($user->role == "admin" || $this->general_settings->hide_vendor_contact_information != 1):
                                            if (!empty($user->phone_number) && $user->show_phone == 1): ?>
                                                <p class="info">
                                                    <i class="fa fa-phone"></i><a href="javascript:void(0)" id="show_phone_number"><?php echo trans("show"); ?></a>
                                                    <a href="tel:<?php echo html_escape($user->phone_number); ?>" id="phone_number" class="display-none"><?php echo html_escape($user->phone_number); ?></a>
                                                </p>
                                            <?php endif; ?>
                                            <?php if (!empty($user->email) && $user->show_email == 1): ?>
                                            <p class="info"><i class="fa fa-envelope"></i><?php echo html_escape($user->email); ?></p>
                                        <?php endif;
                                        endif; ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label"><?php echo trans("product_title"); ?></label>
                        <input type="text" name="subject" id="message_subject" value="<?php echo (!empty($product_title)) ? $product_title : ''; ?>" class="form-control form-input" placeholder="<?php echo trans("subject"); ?>" required>
                    </div>
                    <div class="form-group m-b-sm-0">
                        <label class="control-label"><?php echo trans("decline_reason"); ?></label>
                        <textarea name="message" id="message_text" class="form-control form-textarea" placeholder="<?php echo trans("write_a_message"); ?>" required></textarea>
                    </div>
                </div>
            </div>
            <a href="<?php echo admin_url(); ?>pending-products" class="btn btn-warning pull-left btn-site-prev"><i class="fa fa-chevron-left"></i>&nbsp;<?php echo trans("back"); ?></a>
            <button type="submit" class="btn btn-success pull-left btn-site-prev mr-left-10"><i class="fa fa-paper-plane"></i>&nbsp;<?php echo trans("send"); ?></button> &nbsp;
        </form>
    </div>
    <!-- form end -->
<?php endif; ?>

<?php $this->load->view("partials/_css_js_header"); ?>
<script>

    //send message
    $("#form_send_message").submit(function (event) {
        event.preventDefault();
        var message_subject = $('#message_subject').val();
        var message_text = $('#message_text').val();
        var message_receiver_id = $('#message_receiver_id').val();
        var message_send_em = $('#message_send_em').val();

        if (message_subject.length < 1) {
            $('#message_subject').addClass("is-invalid");
            return false;
        } else {
            $('#message_subject').removeClass("is-invalid");
        }
        if (message_text.length < 1) {
            $('#message_text').addClass("is-invalid");
            return false;
        } else {
            $('#message_text').removeClass("is-invalid");
        }
        var $form = $(this);
        var $inputs = $form.find("input, select, button, textarea");
        var serializedData = $form.serializeArray();
        serializedData.push({name: mds_config.csfr_token_name, value: $.cookie(mds_config.csfr_cookie_name)});
        serializedData.push({name: "sys_lang_id", value: mds_config.sys_lang_id});
        $inputs.prop("disabled", true);
        $.ajax({
            url: mds_config.base_url + "message_controller/add_conversation",
            type: "post",
            data: serializedData,
            success: function (response) {
                $inputs.prop("disabled", false);
                var obj = JSON.parse(response);
                if (obj.result == 1) {
                    document.getElementById("send-message-result").innerHTML = obj.html_content;
                    $("#form_send_message")[0].reset();
                }
                //send email
                if (message_send_em == 1) {
                    send_message_as_email(obj.sender_id, message_receiver_id, message_subject, message_text);
                }
            }
        });
    });

    function send_message_as_email(message_sender_id, message_receiver_id, message_subject, message_text) {
        var data = {
            'email_type': 'new_message',
            'sender_id': message_sender_id,
            "receiver_id": message_receiver_id,
            "message_subject": message_subject,
            "message_text": message_text,
            "sys_lang_id": mds_config.sys_lang_id
        };
        data[mds_config.csfr_token_name] = $.cookie(mds_config.csfr_cookie_name);
        $.ajax({
            type: "POST",
            url: mds_config.base_url + "ajax_controller/send_email",
            data: data,
            success: function (response) {
            }
        });
    }

</script>