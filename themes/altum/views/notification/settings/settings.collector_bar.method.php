<?php defined('ALTUMCODE') || die() ?>
<?php ob_start() ?>
<div class="form-group">
    <label for="settings_name"><?= l('notification.settings.name') ?></label>
    <input type="text" id="settings_name" name="name" class="form-control" value="<?= $data->notification->name ?>" maxlength="256" required="required" />
</div>

<div class="form-group">
    <label for="settings_title"><?= l('notification.settings.title') ?></label>
    <input type="text" id="settings_title" name="title" class="form-control" value="<?= $data->notification->settings->title ?>" maxlength="256" />
</div>

<div class="form-group">
    <label for="settings_input_placeholder"><?= l('notification.settings.input_placeholder') ?></label>
    <input type="text" id="settings_input_placeholder" name="input_placeholder" class="form-control" value="<?= $data->notification->settings->input_placeholder ?>" maxlength="256" />
</div>

<div class="form-group">
    <label for="settings_button_text"><?= l('notification.settings.button_text') ?></label>
    <input type="text" id="settings_button_text" name="button_text" class="form-control" value="<?= $data->notification->settings->button_text ?>" maxlength="256" />
</div>


<?php $html['basic'] = ob_get_clean() ?>

<?php /* Default Display Tab */ ?>
<?php ob_start() ?>
<div class="form-group">
    <label for="settings_direction"><i class="fa fa-fw fa-map-signs fa-sm text-muted mr-1"></i> <?= l('notification.settings.direction') ?></label>
    <div class="row btn-group-toggle" data-toggle="buttons">
        <div class="col-6">
            <label class="btn btn-gray-200 btn-block <?= ($data->notification->settings->direction  ?? null) == 'ltr' ? 'active"' : null?>">
                <input type="radio" name="direction" value="ltr" class="custom-control-input" <?= ($data->notification->settings->direction  ?? null) == 'ltr' ? 'checked="checked"' : null?> />
                <i class="fa fa-fw fa-long-arrow-alt-right fa-sm mr-1"></i> <?= l('notification.settings.direction_ltr') ?>
            </label>
        </div>
        <div class="col-6">
            <label class="btn btn-gray-200 btn-block <?= ($data->notification->settings->direction  ?? null) == 'rtl' ? 'active' : null?>">
                <input type="radio" name="direction" value="rtl" class="custom-control-input" <?= ($data->notification->settings->direction  ?? null) == 'rtl' ? 'checked="checked"' : null?> />
                <i class="fa fa-fw fa-long-arrow-alt-left fa-sm mr-1"></i> <?= l('notification.settings.direction_rtl') ?>
            </label>
        </div>
    </div>
</div>

<div class="form-group">
    <label for="settings_display_position"><i class="fa fa-fw fa-th fa-sm text-muted mr-1"></i> <?= l('notification.settings.display_position') ?></label>
    <div class="row btn-group-toggle" data-toggle="buttons">
        <div class="col-6">
            <label class="btn btn-gray-200 btn-block <?= $data->notification->settings->display_position == 'top' ? 'active"' : null?>">
                <input type="radio" name="display_position" value="top" class="custom-control-input" <?= $data->notification->settings->display_position == 'top' ? 'checked="checked"' : null?> />
                <?= l('notification.settings.display_position_top') ?>
            </label>
        </div>

        <div class="col-6">
            <label class="btn btn-gray-200 btn-block <?= $data->notification->settings->display_position == 'top_floating' ? 'active"' : null?>">
                <input type="radio" name="display_position" value="top_floating" class="custom-control-input" <?= $data->notification->settings->display_position == 'top_floating' ? 'checked="checked"' : null?> />
                <?= l('notification.settings.display_position_top_floating') ?>
            </label>
        </div>

        <div class="col-6">
            <label class="btn btn-gray-200 btn-block <?= $data->notification->settings->display_position == 'bottom' ? 'active"' : null?>">
                <input type="radio" name="display_position" value="bottom" class="custom-control-input" <?= $data->notification->settings->display_position == 'bottom' ? 'checked="checked"' : null?> />
                <?= l('notification.settings.display_position_bottom') ?>
            </label>
        </div>

        <div class="col-6">
            <label class="btn btn-gray-200 btn-block <?= $data->notification->settings->display_position == 'bottom_floating' ? 'active"' : null?>">
                <input type="radio" name="display_position" value="bottom_floating" class="custom-control-input" <?= $data->notification->settings->display_position == 'bottom_floating' ? 'checked="checked"' : null?> />
                <?= l('notification.settings.display_position_bottom_floating') ?>
            </label>
        </div>
    </div>
</div>

<div class="form-group">
    <label for="settings_display_duration"><i class="fa fa-fw fa-hourglass-start fa-sm text-muted mr-1"></i> <?= l('notification.settings.display_duration') ?></label>
    <div class="input-group">
        <input type="number" min="-1" id="settings_display_duration" name="display_duration" class="form-control" value="<?= $data->notification->settings->display_duration ?>" required="required" />
        <div class="input-group-append">
            <span class="input-group-text"><?= l('global.date.seconds') ?></span>
        </div>
    </div>
    <small class="form-text text-muted"><?= l('notification.settings.display_duration_help') ?></small>
</div>

<div class="custom-control custom-switch mr-3 mb-3">
    <input
            type="checkbox"
            class="custom-control-input"
            id="display_close_button"
            name="display_close_button"
        <?= $data->notification->settings->display_close_button ? 'checked="checked"' : null ?>
    >
    <label class="custom-control-label clickable" for="display_close_button"><?= l('notification.settings.display_close_button') ?></label>
</div>

<div class="custom-control custom-switch mr-3 mb-3 <?= !$this->user->plan_settings->removable_branding ? 'container-disabled': null ?>">
    <input
            type="checkbox"
            class="custom-control-input"
            id="display_branding"
            name="display_branding"
        <?= $data->notification->settings->display_branding ? 'checked="checked"' : null ?>
    >
    <label class="custom-control-label clickable" for="display_branding"><?= l('notification.settings.display_branding') ?></label>
</div>
<?php $html['display'] = ob_get_clean() ?>

<?php /* Customize Tab */ ?>
<?php ob_start() ?>
<div class="form-group">
    <label for="settings_title_color"><?= l('notification.settings.title_color') ?></label>
    <input type="hidden" id="settings_title_color" name="title_color" class="form-control" value="<?= $data->notification->settings->title_color ?>" />
    <div id="settings_title_color_pickr"></div>
</div>

<div class="form-group">
    <label for="settings_background_color"><?= l('notification.settings.background_color') ?></label>
    <input type="hidden" id="settings_background_color" name="background_color" class="form-control" value="<?= $data->notification->settings->background_color ?>" />
    <div id="settings_background_color_pickr"></div>
</div>

<div class="form-group">
    <label for="settings_background_pattern"><?= l('notification.settings.background_pattern') ?></label>
    <div class="row btn-group-toggle" data-toggle="buttons">
        <div class="col-4">
            <label class="btn btn-gray-200 btn-block <?= $data->notification->settings->background_pattern == '' ? 'active"' : null?>">
                <input type="radio" name="background_pattern" value="" class="custom-control-input" <?= $data->notification->settings->background_pattern == '' ? 'checked="checked"' : null?> />
                <?= l('global.none') ?>
            </label>
        </div>

        <?php foreach(get_notifications_background_patterns() as $key => $value): ?>
            <div class="col-4">
                <label class="btn btn-gray-200 btn-block <?= $data->notification->settings->background_pattern == $key ? 'active' : null?>" style="background-image: url(<?= $value ?>);">
                    <input type="radio" name="background_pattern" value="<?= $key ?>" class="custom-control-input" <?= $data->notification->settings->background_pattern == $key ? 'checked="checked"' : null?> data-value="<?= $value ?>" />
                    <?= l('notification.settings.background_pattern_' . $key) ?>
                </label>
            </div>
        <?php endforeach ?>
    </div>
</div>

<div class="form-group">
    <label for="settings_button_background_color"><?= l('notification.settings.button_background_color') ?></label>
    <input type="hidden" id="settings_button_background_color" name="button_background_color" class="form-control" value="<?= $data->notification->settings->button_background_color ?>" />
    <div id="settings_button_background_color_pickr"></div>
</div>

<div class="form-group">
    <label for="settings_button_color"><?= l('notification.settings.button_color') ?></label>
    <input type="hidden" id="settings_button_color" name="button_color" class="form-control" value="<?= $data->notification->settings->button_color ?>" />
    <div id="settings_button_color_pickr"></div>
</div>

<div class="form-group">
    <label for="settings_close_button_color"><?= l('notification.settings.close_button_color') ?></label>
    <input type="hidden" id="settings_close_button_color" name="close_button_color" class="form-control" value="<?= $data->notification->settings->close_button_color ?>" />
    <div id="settings_close_button_color_pickr"></div>
</div>

<div class="form-group">
    <label for="settings_border_width"><?= l('notification.settings.border_width') ?></label>
    <input type="range" min="0" max="5" id="settings_border_width" name="border_width" class="form-control" value="<?= $data->notification->settings->border_width ?>" />
</div>

<div class="form-group">
    <label for="settings_border_color"><?= l('notification.settings.border_color') ?></label>
    <input type="hidden" id="settings_border_color" name="border_color" class="form-control border-left-0" value="<?= $data->notification->settings->border_color ?>" />
    <div id="settings_border_color_pickr"></div>
</div>
<?php $html['customize'] = ob_get_clean() ?>


<?php /* Data Tab */ ?>
<?php ob_start() ?>
<div class="custom-control custom-switch mr-3 mb-3">
    <input
            type="checkbox"
            class="custom-control-input"
            id="data_send_is_enabled"
            name="data_send_is_enabled"
        <?= $data->notification->settings->data_send_is_enabled ? 'checked="checked"' : null ?>
    >
    <label class="custom-control-label clickable" for="data_send_is_enabled"><?= l('notification.settings.data_send_is_enabled') ?></label>
</div>

<div id="data_send" class="container-disabled">
    <div class="form-group">
        <label for="settings_data_send_webhook"><?= l('notification.settings.data_send_webhook') ?></label>
        <input type="text" id="settings_data_send_webhook" name="data_send_webhook" class="form-control" value="<?= $data->notification->settings->data_send_webhook ?>" maxlength="2048" placeholder="<?= l('notification.settings.data_send_webhook_placeholder') ?>" aria-label="<?= l('notification.settings.data_send_webhook_placeholder') ?>" />
        <small class="form-text text-muted"><?= l('notification.settings.data_send_webhook_help') ?></small>
    </div>

    <div class="form-group">
        <label for="settings_data_send_email"><?= l('notification.settings.data_send_email') ?></label>
        <input type="text" id="settings_data_send_email" name="data_send_email" class="form-control" value="<?= $data->notification->settings->data_send_email ?>" maxlength="320"  placeholder="<?= l('notification.settings.data_send_email_placeholder') ?>" aria-label="<?= l('notification.settings.data_send_email_placeholder') ?>" />
        <small class="form-text text-muted"><?= l('notification.settings.data_send_email_help') ?></small>
    </div>
</div>
<?php $html['data'] = ob_get_clean() ?>


<?php ob_start() ?>
<script>
    /* Dont show the agreement fields if unchecked */
    let show_agreement_check = () => {
        if($('#settings_show_agreement').is(':checked')) {
            $('#agreement').show();
        } else {
            $('#agreement').hide();
        }
    };
    show_agreement_check();
    $('#settings_show_agreement').on('change', show_agreement_check);

    /* Cancel the submit button form of the email collector */
    $('#altumcode-collector-bar-form').on('submit', event => event.preventDefault());

    /* Notification Preview Handlers */
    $('#settings_title').on('change paste keyup', event => {
        $('#notification_preview .altumcode-collector-bar-title').text($(event.currentTarget).val());
    });

    $('#settings_input_placeholder').on('change paste keyup', event => {
        $('#notification_preview [name="input"]').attr('placeholder', $(event.currentTarget).val());
    });

    $('#settings_submit').on('change paste keyup', event => {
        $('#notification_preview [name="button"]').text($(event.currentTarget).val());
    });

    /* Title Color Handler */
    let settings_title_color_pickr = Pickr.create({
        el: '#settings_title_color_pickr',
        default: $('#settings_title_color').val(),
        ...pickr_options
    });

    settings_title_color_pickr.on('change', hsva => {
        $('#settings_title_color').val(hsva.toHEXA().toString());

        /* Notification Preview Handler */
        $('#notification_preview .altumcode-collector-bar-title').css('color', hsva.toHEXA().toString());
    });


    /* Background Color Handler */
    let settings_background_color_pickr = Pickr.create({
        el: '#settings_background_color_pickr',
        default: $('#settings_background_color').val(),
        ...pickr_options
    });

    settings_background_color_pickr.on('change', hsva => {
        $('#settings_background_color').val(hsva.toHEXA().toString());

        /* Notification Preview Handler */
        $('#notification_preview .altumcode-wrapper').css('background-color', hsva.toHEXA().toString());
    });

    /* Submit Background Color Handler */
    let settings_button_background_color_pickr = Pickr.create({
        el: '#settings_button_background_color_pickr',
        default: $('#settings_button_background_color').val(),
        ...pickr_options
    });

    settings_button_background_color_pickr.on('change', hsva => {
        $('#settings_button_background_color').val(hsva.toHEXA().toString());

        /* Notification Preview Handler */
        $('#notification_preview [name="button"]').css('background', hsva.toHEXA().toString());
    });

    /* Submit Background Color Handler */
    let settings_button_color_pickr = Pickr.create({
        el: '#settings_button_color_pickr',
        default: $('#settings_button_color').val(),
        ...pickr_options
    });

    settings_button_color_pickr.on('change', hsva => {
        $('#settings_button_color').val(hsva.toHEXA().toString());

        /* Notification Preview Handler */
        $('#notification_preview [name="button"]').css('color', hsva.toHEXA().toString());
    });

    /* Data Send Handler */
    let data_send_status_handler = () => {

        if($('#data_send_is_enabled:checked').length > 0) {

            /* Remove disabled container if depending on the status of the trigger checkbox */
            $('#data_send').removeClass('container-disabled');

        } else {

            /* Disable the container visually */
            $('#data_send').addClass('container-disabled');

        }
    };

    /* Trigger it for the first initial load */
    data_send_status_handler();

    /* Trigger on status change live of the checkbox */
    $('#data_send_is_enabled').on('change', data_send_status_handler);

</script>
<?php $javascript = ob_get_clean() ?>

<?php return (object) ['html' => $html, 'javascript' => $javascript] ?>
