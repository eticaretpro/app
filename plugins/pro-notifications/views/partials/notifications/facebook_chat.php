<?php defined('ALTUMCODE') || die() ?>

<?php ob_start() ?>

<div class="altumcode-hidden">
    <div class="altumcode-whatsapp-chat-window">
        <div class="altumcode-whatsapp-chat-window-header" style="background: <?= $notification->settings->header_background_color ?> !important;">
            <img src="<?= $notification->settings->agent_image ?>" class="altumcode-whatsapp-chat-window-header-image" alt="<?= $notification->settings->agent_image_alt ?>" />

            <div class="altumcode-whatsapp-chat-window-header-content">
                <span class="altumcode-whatsapp-chat-window-header-title" style="color: <?= $notification->settings->header_agent_name_color ?> !important;"><?= $notification->settings->agent_name ?></span>
                <span class="altumcode-whatsapp-chat-window-header-description" style="color: <?= $notification->settings->header_agent_description_color ?> !important;"><?= $notification->settings->agent_description ?></span>
            </div>
        </div>

        <div class="altumcode-whatsapp-chat-window-content" style="background: <?= $notification->settings->content_background_color ?> !important;">
            
            <div class="altumcode-whatsapp-chat-window-content-padding">
            	<div class="altumcode-facebook-chat-message-time">07:11</div>
                <div class="altumcode-whatsapp-chat-window-content-reply" style="background: <?= $notification->settings->content_agent_message_background_color ?> !important;">
                    <div class="altumcode-whatsapp-chat-window-content-reply-author" style="color: <?= $notification->settings->content_agent_name_color ?> !important;">
                        <?= $notification->settings->agent_name ?>
                    </div>

                    <div class="altumcode-whatsapp-chat-window-content-reply-text" style="color: <?= $notification->settings->content_agent_message_color ?> !important;">
                        <?= $notification->settings->agent_message ?>
                    </div>
                </div>
            </div>
        </div>

        <div class="altumcode-whatsapp-chat-window-footer" style="background: <?= $notification->settings->footer_background_color ?> !important;">
            <a href="https://m.me/<?= $notification->settings->agent_phone_number ?>" class="altumcode-whatsapp-chat-window-footer-button" target="_blank" style="background: <?= $notification->settings->footer_button_background_color ?> !important; color: <?= $notification->settings->footer_button_color ?> !important;">
                <?= $notification->settings->button_text ?>
            </a>

          
        </div>
    </div>
</div>

<?php
if(!$notification->settings->title && $notification->settings->border_radius == 'rounded') {
    $notification->settings->border_radius = 'round';
}
$float_class = '';
if(string_ends_with('left', $notification->settings->display_position)) {
    $float_class = 'altumcode-float-left';
}
if(string_ends_with('right', $notification->settings->display_position)) {
    $float_class = 'altumcode-float-right';
}
?>

<div role="dialog" class="altumcode-wrapper altumcode-wrapper-<?= $notification->settings->border_radius ?> <?= $notification->settings->shadow ? 'altumcode-wrapper-shadow' : null ?> <?= ($notification->settings->direction ?? 'ltr') == 'rtl' ? 'altumcode-rtl' : null ?> <?= $float_class ?> altumcode-whatsapp-chat-wrapper altumcode-clickable" style='font-family: <?= $notification->settings->font ?? 'inherit' ?>!important;background-color: <?= $notification->settings->background_color ?>;border-width: <?= $notification->settings->border_width ?>px;border-color: <?= $notification->settings->border_color ?>;<?= $notification->settings->background_pattern_svg ? 'background-image: url("' . $notification->settings->background_pattern_svg . '")' : null ?>;'>
    <div class="altumcode-whatsapp-chat-content">
        <img src="<?= ASSETS_FULL_URL . 'images/notifications/facebook-messenger.png' ?>" class="<?= $notification->settings->title ? 'altumcode-whatsapp-chat-image-small' : 'altumcode-whatsapp-chat-image-large' ?>" alt="<?= $notification->settings->title ?>" />

        <?php if($notification->settings->title): ?>
        <div class="altumcode-whatsapp-chat-title" style="color: <?= $notification->settings->title_color ?>"><?= $notification->settings->title ?></div>
        <?php endif ?>
    </div>
</div>
<?php $html = ob_get_clean() ?>


<?php ob_start() ?>
new AltumCodeManager({
    content: <?= json_encode($html) ?>,
    display_mobile: <?= json_encode($notification->settings->display_mobile) ?>,
    display_desktop: <?= json_encode($notification->settings->display_desktop) ?>,
    display_trigger: <?= json_encode($notification->settings->display_trigger) ?>,
    display_trigger_value: <?= json_encode($notification->settings->display_trigger_value) ?>,
    duration: <?= $notification->settings->display_duration === -1 ? -1 : $notification->settings->display_duration * 1000 ?>,
    close: <?= json_encode($notification->settings->display_close_button) ?>,
    display_frequency: <?= json_encode($notification->settings->display_frequency) ?>,
    position: <?= json_encode($notification->settings->display_position) ?>,
    trigger_all_pages: <?= json_encode($notification->settings->trigger_all_pages) ?>,
    triggers: <?= json_encode($notification->settings->triggers) ?>,
    on_animation: <?= json_encode($notification->settings->on_animation) ?>,
    off_animation: <?= json_encode($notification->settings->off_animation) ?>,
    animation: <?= json_encode($notification->settings->animation) ?>,
    animation_interval: <?= (int) $notification->settings->animation_interval ?>,

    notification_id: <?= $notification->notification_id ?>
}).initiate({
    displayed: main_element => {

        /* On click */
        main_element.addEventListener('click', event => {
            let clickable = main_element.querySelector('.altumcode-hidden, .altumcode-shown');

            if(clickable.classList.contains('altumcode-shown')) {
                clickable.classList.remove('altumcode-shown');
                clickable.classList.add('altumcode-hiding');
                setTimeout(() => {
                    clickable.classList.add('altumcode-hidden');
                }, 500);
            } else {
                clickable.classList.remove('altumcode-hidden');
                clickable.classList.add('altumcode-shown');
            }

            AltumCodeManager.reposition();
        });

    }
});
<?php $javascript = ob_get_clean(); ?>

<?php return (object) ['html' => $html, 'javascript' => $javascript] ?>
