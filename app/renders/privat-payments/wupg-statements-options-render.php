<div class="pp-settings-page-title-wrapper">
    <div class="pp-logo-wrapper">
        <img src="<?php echo WUPG_PATH  . '/assets/images/privat-favicon.ico'?>" alt="">
    </div>
    <div class="pp-title-wrapper">
        <h1><?php esc_html_e('Privat24 Выписки по счету мерчанта') ?></h1>
    </div>
</div>
<div class="pp-settings-container">
    <div class="pp-preloader">
        <img src="<?php echo WUPG_PATH  . '/assets/images/ajax-loader.gif'?>" alt="">
    </div>
    <div class="pp-error-handler">
        <div class="pp-error-handler-text-block">
            <p></p>
        </div>
    </div>
    <div class="pp-form-wrapper">
        <form method="POST" class="pp-statements-form" id="pp-statements-form">
            <?php wp_nonce_field('pp_statements_action', 'pp_statements')?>
            <div class="pp-form-input-wrapper">
                <div class="pp-form-text">
                    <p><?php esc_html_e('Дата начала') ?></p>
                </div>
                <div class="pp-form-input">
                    <input type="date" name="sd" id="sd" placeholder="01.01.2019">
                </div>
            </div>
            <div class="pp-form-input-wrapper">
                <div class="pp-form-text">
                    <p><?php esc_html_e('Дата конца') ?></p>
                </div>
                <div class="pp-form-input">
                    <input type="date" name="ed" id="ed" placeholder="01.01.2019">
                </div>
            </div>
            <div class="pp-form-input-wrapper">
                <div class="pp-form-input">
                    <button type="submit"><?php esc_html_e('Отправить') ?></button>
                </div>
            </div>
        </form>
    </div>
    <div class="pp-statements">
        <div class="pp-statements-wrapper">
            <div class="pp-statements-credit-debit-wrapper">
                <div class="pp-statements-account-meta status">
                    <div class="pp-title">
                        <p><?php esc_html_e('Статус') ?></p>
                    </div>
                    <div class="pp-value pp-status">
                    </div>
                </div>
                <div class="pp-statements-account-meta credit">
                    <div class="pp-title">
                        <p><?php esc_html_e('Сумма поступлений') ?></p>
                    </div>
                    <div class="pp-value pp-credit">
                    </div>
                </div>
                <div class="pp-statements-account-meta debet">
                    <div class="pp-title">
                        <p><?php esc_html_e('Сумма Отчислений') ?></p>
                    </div>
                    <div class="pp-value pp-debet">
                    </div>
                </div>
            </div>
            <div class="pp-statements-list">
                <div class="pp-statement-header">
                    <div class="pp-statement-header-title">
                        <p><?php esc_html_e('Номер карты') ?></p>
                    </div>
                    <div class="pp-statement-header-title">
                        <p><?php esc_html_e('Дата транзакции') ?></p>
                    </div>
                    <div class="pp-statement-header-title">
                        <p><?php esc_html_e('Сумма транзакции') ?></p>
                    </div>
                    <div class="pp-statement-header-title">
                        <p><?php esc_html_e('Движение по карте') ?></p>
                    </div>
                    <div class="pp-statement-header-title">
                        <p><?php esc_html_e('Сумма остатка') ?></p>
                    </div>
                    <div class="pp-statement-header-title">
                        <p><?php esc_html_e('Канал проведения операции') ?></p>
                    </div>
                    <div class="pp-statement-header-title">
                        <p><?php esc_html_e('Описание транзакции') ?></p>
                    </div>
                </div>
                <div class="pp-statement-content">
                </div>
            </div>
        </div>
    </div>
    <div id="pp-statements-list"></div>
</div>