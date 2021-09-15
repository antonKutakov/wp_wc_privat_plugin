<div class="pp-settings-page-title-wrapper">
    <div class="pp-logo-wrapper">
        <img src="<?php echo WUPG_PATH  . '/assets/images/privat-favicon.ico'?>" alt="">
    </div>
    <div class="pp-title-wrapper">
        <h1><?php esc_html_e('Privat24 Баланс по счету') ?></h1>
    </div>
</div>
<div class="pp-settings-container">
    <div class="pp-preloader-archive">
        <img src="<?php echo WUPG_PATH  . '/assets/images/ajax-loader.gif'?>" alt="">
    </div>
    <div class="pp-error-handler-archive">
        <div class="pp-error-handler-text-block-archive">
            <p></p>
        </div>
    </div>

    <div class="pp-balance">
        <div class="pp-balance-wrapper">
            <div class="pp-balance-list">
                <div class="pp-balance-header">
                    <div class="pp-balance-header-title">
                        <p><?php esc_html_e('Номер карты') ?></p>
                    </div>
                    <div class="pp-balance-header-title">
                        <p><?php esc_html_e('Обновление баланса') ?></p>
                    </div>
                    <div class="pp-balance-header-title">
                        <p><?php esc_html_e('Счет карты') ?></p>
                    </div>
                    <div class="pp-balance-header-title">
                        <p><?php esc_html_e('Доступные средства') ?></p>
                    </div>
                    <div class="pp-balance-header-title">
                        <p><?php esc_html_e('Баланс') ?></p>
                    </div>
                    <div class="pp-balance-header-title">
                        <p><?php esc_html_e('Валюта') ?></p>
                    </div>
                </div>
                <div class="pp-balance-content-arch">
                </div>
            </div>
        </div>
    </div>
    <div class="pp-form-wrapper">
        <form method="POST" class="pp-balance-form-archive" id="pp-balance-form-archive">
            <?php wp_nonce_field('pp_balance_action', 'pp_balance')?>
            <div class="pp-form-input-wrapper">
                <div class="pp-form-input pp-form-balance-btn">
                    <button type="submit"><?php esc_html_e('Посмотреть архив') ?></button>
                </div>
            </div>
        </form>
    </div>
    <div id="pp-balance-list-archive"></div>
</div>