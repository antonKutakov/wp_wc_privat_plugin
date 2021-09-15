<div class="pp-settings-page-title-wrapper">
    <div class="pp-logo-wrapper">
        <img src="<?php echo WUPG_PATH  . '/assets/images/privat-favicon.ico'?>" alt="">
    </div>
    <div class="pp-title-wrapper">
        <h1><?php esc_html_e('Privat24 Payments settings') ?></h1>
    </div>
</div>
<div class="pp-settings-container">
    <div class="pp-preloader">
        <img src="<?php echo WUPG_PATH  . '/assets/images/ajax-loader.gif'?>" alt="">
    </div>
    <div class="pp-form-wrapper">
        <form method="POST" class="pp-settings-form" id="pp-settings-form">
            <?php wp_nonce_field('pp_settings_action', 'pp_settings')?>
            <div class="pp-form-input-wrapper pp-input-enable">
                <div class="pp-form-text">
                    <p><?php esc_html_e('Enable payment') ?></p>
                </div>
                <div class="pp-form-input">
                    <input type="checkbox" name="enabled" id="enabled" value="1" autocomplete="off" <?php echo  $enabled == 'yes' ? 'checked="checked"' : "" ; ?>>
                </div>
            </div>
            <div class="pp-form-input-wrapper">
                <div class="pp-form-text">
                    <p><?php esc_html_e('Merchant ID') ?></p>
                </div>
                <div class="pp-form-input">
                    <input type="text" name="merchant_id" id="merchant_id" value="<?php echo (isset($merchant_id)) ? $merchant_id : "" ; ?>" autocomplete="off" placeholder="<?php (!empty($merchant_id)) ? esc_html_e($merchant_id, "privatpayments") : esc_html_e("111222", "privatpayments") ; ?>">
                </div>
            </div>
            <div class="pp-form-input-wrapper">
                <div class="pp-form-text">
                    <p><?php esc_html_e('Password') ?></p>
                </div>
                <div class="pp-form-input">
                    <input type="password" name="password" id="password" value="<?php echo (isset($password)) ? $password : ""; ?>" autocomplete="off" placeholder="<?php (!empty($password)) ? esc_html_e($password, "privatpayments") : esc_html_e("Password here", "privatpayments"); ?>">
                </div>
            </div>
            <div class="pp-form-input-wrapper">
                <div class="pp-form-text">
                    <p><?php esc_html_e('Waiting Time') ?></p>
                </div>
                <div class="pp-form-input">
                    <input type="text" name="wait" id="wait" value="<?php echo (isset($wait)) ? $wait : "" ?>" autocomplete="off" placeholder="<?php (!empty($wait)) ? esc_html_e($wait, "privatpayments") : esc_html_e("60", "privatpayments") ?>">
                </div>
            </div>
            <div class="pp-form-input-wrapper">
                <div class="pp-form-text">
                    <p><?php esc_html_e('Card Number') ?></p>
                </div>
                <div class="pp-form-input">
                    <input type="text" name="cardnum" id="cardnum" value="<?php echo (isset($cardnum)) ? $cardnum : "" ?>" autocomplete="off" placeholder="<?php (!empty($cardnum)) ? esc_html_e($cardnum, "privatpayments") : esc_html_e("5555555555554444", "privatpayments") ?>">
                </div>
            </div>
            <div class="pp-form-input-wrapper">
                <div class="pp-form-text">
                    <p><?php esc_html_e('Country') ?></p>
                </div>
                <div class="pp-form-input">
                    <input type="text" name="country" id="country" value="<?php echo (isset($country)) ? $country : "" ?>" autocomplete="off" placeholder="<?php (!empty($country)) ? esc_html_e($country, "privatpayments") : esc_html_e("UA", "privatpayments") ?>">
                </div>
            </div>
            <div class="pp-form-input-wrapper">
                <div class="pp-form-text">
                    <p><?php esc_html_e('Title') ?></p>
                </div>
                <div class="pp-form-input">
                    <input type="text" name="title" id="title" value="<?php echo (isset($title)) ? $title : "" ?>" autocomplete="off" placeholder="<?php (!empty($title)) ? esc_html_e($title, "privatpayments") : esc_html_e("Title...", "privatpayments") ?>">
                </div>
            </div>
            <div class="pp-form-input-wrapper">
                <div class="pp-form-text">
                    <p><?php esc_html_e('Description') ?></p>
                </div>
                <div class="pp-form-input">
                    <input type="text" name="description" id="description" value="<?php echo (isset($description)) ? $description : "" ?>" autocomplete="off" placeholder="<?php (!empty($description)) ? esc_html_e($description, "privatpayments") : esc_html_e("Description...", "privatpayments") ?>">
                </div>
            </div>
            <div class="pp-form-input-wrapper">
                <div class="pp-form-input">
                    <button type="submit"><?php esc_html_e('Save') ?></button>
                </div>
            </div>
        </form>
    </div>
</div>