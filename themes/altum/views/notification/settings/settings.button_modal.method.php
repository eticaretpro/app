<?php
defined('ALTUMCODE') || die();

/* Create the content for each tab */
$html = [];

/* Extra Javascript needed */
$javascript = '';
?>

<?php /* Basic Tab */ ?>
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
        <label for="settings_description"><?= l('notification.settings.description') ?></label>
        <input type="text" id="settings_description" name="description" class="form-control" value="<?= $data->notification->settings->description ?>" maxlength="512" />
    </div>

    <div class="form-group">
        <label for="settings_image"><?= l('notification.settings.image') ?></label>
        <?= include_view(THEME_PATH . 'views/partials/file_image_input.php', ['uploads_file_key' => 'notifications', 'file_key' => 'image', 'already_existing_image' => $data->notification->settings->image]) ?>
    <?= \Altum\Alerts::output_field_error('image') ?>
        <small class="form-text text-muted"><?= l('notification.settings.image_help') ?></small>
    </div>

    <div class="form-group">
        <label for="settings_image_alt"><?= l('notification.settings.image_alt') ?></label>
        <input type="text" id="settings_image_alt" name="image_alt" class="form-control" value="<?= $data->notification->settings->image_alt ?>" maxlength="100" />
        <small class="form-text text-muted"><?= l('notification.settings.image_alt_help') ?></small>
    </div>

    <div class="form-group">
        <label for="settings_button_text"><?= l('notification.settings.button_text') ?></label>
        <input type="text" id="settings_button_text" name="button_text" class="form-control" value="<?= $data->notification->settings->button_text ?>" maxlength="128" />
    </div>

    <div class="form-group">
        <label for="settings_button_url"><?= l('notification.settings.button_url') ?></label>
        <input type="url" id="settings_button_url" name="button_url" class="form-control" value="<?= $data->notification->settings->button_url ?>" maxlength="2048" />
    </div>
<?php $html['basic'] = ob_get_clean() ?>


<?php /* Customize Tab */ ?>
<?php ob_start() ?>
    <div class="form-group">
        <label for="settings_title_color"><?= l('notification.settings.title_color') ?></label>
        <input type="hidden" id="settings_title_color" name="title_color" class="form-control" value="<?= $data->notification->settings->title_color ?>" />
        <div id="settings_title_color_pickr"></div>
    </div>

    <div class="form-group">
        <label for="settings_description_color"><?= l('notification.settings.description_color') ?></label>
        <input type="hidden" id="settings_description_color" name="description_color" class="form-control" value="<?= $data->notification->settings->description_color ?>" />
        <div id="settings_description_color_pickr"></div>
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

<div class="form-group">
    <label for="settings_border_radius"><i class="fa fa-fw fa-border-all fa-sm text-muted mr-1"></i> <?= l('notification.settings.border_radius') ?></label>
    <div class="row btn-group-toggle" data-toggle="buttons">
        <div class="col-4">
            <label class="btn btn-gray-200 btn-block <?= ($data->notification->settings->border_radius  ?? null) == 'straight' ? 'active"' : null?>">
                <input type="radio" name="border_radius" value="straight" class="custom-control-input" <?= ($data->notification->settings->border_radius  ?? null) == 'straight' ? 'checked="checked"' : null?> />
                <i class="fa fa-fw fa-square-full fa-sm mr-1"></i> <?= l('notification.settings.border_radius_straight') ?>
            </label>
        </div>
        <div class="col-4">
            <label class="btn btn-gray-200 btn-block <?= ($data->notification->settings->border_radius  ?? null) == 'rounded' ? 'active' : null?>">
                <input type="radio" name="border_radius" value="rounded" class="custom-control-input" <?= ($data->notification->settings->border_radius  ?? null) == 'rounded' ? 'checked="checked"' : null?> />
                <i class="fa fa-fw fa-square fa-sm mr-1"></i> <?= l('notification.settings.border_radius_rounded') ?>
            </label>
        </div>
    </div>
</div>

    <div class="custom-control custom-switch mr-3 mb-3">
        <input
                type="checkbox"
                class="custom-control-input"
                id="settings_shadow"
                name="shadow"
                <?= $data->notification->settings->shadow ? 'checked="checked"' : null ?>
        >

        <label class="custom-control-label clickable" for="settings_shadow"><?= l('notification.settings.shadow') ?></label>

        <div>
            <small class="form-text text-muted"><?= l('notification.settings.shadow_help') ?></small>
        </div>
    </div>
<?php $html['customize'] = ob_get_clean() ?>

<?php ob_start() ?>
    <script>
        /* Notification Preview Handlers */
        $('#settings_title').on('change paste keyup', event => {
            $('#notification_preview .altumcode-button-modal-title').text($(event.currentTarget).val());
        });

        $('#settings_description').on('change paste keyup', event => {
            $('#notification_preview .altumcode-button-modal-description').text($(event.currentTarget).val());
        });

        $('#settings_button_text').on('change paste keyup', event => {
            $('#notification_preview .altumcode-button-modal-button').text($(event.currentTarget).val());
        });

        $('#settings_image').on('change paste keyup', event => {
            $('#notification_preview .altumcode-button-modal-image').attr('src', $(event.currentTarget).val());
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
            $('#notification_preview .altumcode-button-modal-title').css('color', hsva.toHEXA().toString());
        });


        /* Description Color Handler */
        let settings_description_color_pickr = Pickr.create({
            el: '#settings_description_color_pickr',
            default: $('#settings_description_color').val(),
            ...pickr_options
        });

        settings_description_color_pickr.on('change', hsva => {
            $('#settings_description_color').val(hsva.toHEXA().toString());

            /* Notification Preview Handler */
            $('#notification_preview .altumcode-button-modal-description').css('color', hsva.toHEXA().toString());
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
        let settings_button_color_pickr = Pickr.create({
            el: '#settings_button_color_pickr',
            default: $('#settings_button_color').val(),
            ...pickr_options
        });

        settings_button_color_pickr.on('change', hsva => {
            $('#settings_button_color').val(hsva.toHEXA().toString());

            /* Notification Preview Handler */
            $('#notification_preview .altumcode-button-modal-button').css('color', hsva.toHEXA().toString());
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
            $('#notification_preview .altumcode-button-modal-button').css('background', hsva.toHEXA().toString());
        });
    </script>
<?php $javascript = ob_get_clean() ?>

<?php return (object) ['html' => $html, 'javascript' => $javascript] ?>
