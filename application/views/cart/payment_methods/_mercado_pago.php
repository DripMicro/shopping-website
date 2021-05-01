<?php defined('BASEPATH') or exit('No direct script access allowed');
if (!empty($payment_gateway) && $payment_gateway->name_key == "mercado_pago"):
    $show_payment = true;
    try {
        require_once "application/third_party/mercado-pago/vendor/autoload.php";
        MercadoPago\SDK::setAccessToken($payment_gateway->secret_key);
        $preference = new MercadoPago\Preference();
        $preference->back_urls = array(
            "success" => base_url() . "mercado-pago-payment-post?mds_lang=" . $this->selected_lang->short_form . "&mds_sess_id=" . $mds_payment_token,
            "failure" => base_url() . "mercado-pago-payment-post?mds_lang=" . $this->selected_lang->short_form . "&mds_sess_id=" . $mds_payment_token,
            "pending" => base_url() . "mercado-pago-payment-post?mds_lang=" . $this->selected_lang->short_form . "&mds_sess_id=" . $mds_payment_token
        );
        $preference->auto_return = "approved";
        //sale title
        $title = "";
        if ($mds_payment_type == 'membership') {
            $title = trans("membership_plan_payment");
        } elseif ($mds_payment_type == 'promote') {
            $title = trans("promote_plan");
        } else {
            $product_ids = "";
            $i = 0;
            if (!empty($cart_items)) {
                foreach ($cart_items as $cart_item) {
                    if ($i != 0) {
                        $product_ids .= ", ";
                    }
                    $product_ids .= $cart_item->product_id;
                    $i++;
                }
            }
            $title = "Product (" . $product_ids . ")";
        }
        if (empty($title)) {
            $title = trans("sale");
        }
        $item = new MercadoPago\Item();
        $item->title = $title;
        $item->quantity = 1;
        $item->currency_id = $payment_gateway->base_currency;
        $item->unit_price = $total_amount;
        $preference->items = array($item);
        $preference->save();
    } catch (Exception $ex) {
        $show_payment = false;
    } ?>

    <div class="row">
        <div class="col-12">
            <?php $this->load->view('product/_messages'); ?>
        </div>
    </div>

    <?php if ($show_payment): ?>
    <div id="payment-button-container" class="payment-button-cnt">
        <div class="payment-icons-container">
            <label class="payment-icons">
                <?php $logos = @explode(',', $payment_gateway->logos);
                if (!empty($logos) && item_count($logos) > 0):
                    foreach ($logos as $logo): ?>
                        <img src="<?php echo base_url(); ?>assets/img/payment/<?= html_escape(trim($logo)); ?>.svg" alt="<?= html_escape(trim($logo)); ?>">
                    <?php endforeach;
                endif; ?>
            </label>
        </div>
        <p class="p-complete-payment"><?php echo trans("msg_complete_payment"); ?></p>
        <script src="https://www.mercadopago.com.uy/integrations/v1/web-payment-checkout.js" data-preference-id="<?php echo $preference->id; ?>" data-button-label="<?= trans("pay"); ?>&nbsp;<?= strip_tags(price_decimal($total_amount, $currency)); ?>"></script>
    </div>
<?php else: ?>
    <div class="alert alert-danger" role="alert">
        There was a problem starting Mercado Pago! Please make sure that you added correct API keys and selected the correct currency.
    </div>
<?php endif; ?>

<?php endif; ?>

<style>
    .mercadopago-button {
        padding: 12px 40px !important;
        width: 340px;
        max-width: 100%;
        border-radius: 4px !important;
        color: #fff !important;
        font-weight: 600 !important;
        font-size: 0.875rem !important;
        line-height: 1.5 !important;
    }
</style>
