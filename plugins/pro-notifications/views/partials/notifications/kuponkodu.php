<?php defined('ALTUMCODE') || die() ?>


<?php ob_start() ?>
<div role="dialog" class="altumcode-wrapper altumcode-wrapper-<?= $notification->settings->border_radius ?> <?= $notification->settings->shadow ? 'altumcode-wrapper-shadow' : null ?> <?= ($notification->settings->direction ?? 'ltr') == 'rtl' ? 'altumcode-rtl' : null ?> altumcode-coupon-wrapper" style='font-family: <?= $notification->settings->font ?? 'inherit' ?>!important;background-color: <?= $notification->settings->background_color ?>;border-width: <?= $notification->settings->border_width ?>px;border-color: <?= $notification->settings->border_color ?>;<?= $notification->settings->background_pattern_svg ? 'background-image: url("' . $notification->settings->background_pattern_svg . '")' : null ?>; text-align: center !important;

background: url(https://cdn.popupsmart.com/assets/themes/polaris.png), rgba(255, 255, 255, 1);
    background-position: center;
    '>
    <div class="altumcode-coupon-content">
        
        <div>
            <div class="altumcode-coupon-header">
                <p class="altumcode-coupon-title" style="color: <?= $notification->settings->title_color ?>"><?= $notification->settings->title ?></p>

                <button class="altumcode-close" style="color: <?= $notification->settings->close_button_color ?>;">×</button>
            </div>


            <p class="altumcode-coupon-description" style="min-width:300px; color: <?= $notification->settings->description_color ?>"><?= $notification->settings->description ?></p>

            <?php if(!empty($notification->settings->image)): ?><center>
        <img src="<?= (substr($notification->settings->image, 0, 4) === 'http') ? $notification->settings->image : \Altum\Uploads::get_full_url('notifications') . $notification->settings->image ?>" class="altumcode-coupon-image" alt="<?= $notification->settings->image_alt ?>" loading="lazy" />
    </center>
        <?php endif ?>


            <?php if($notification->settings->coupon_code): ?>
            <div class="altumcode-coupon-coupon-code" style="    background: transparent !important;"><?= $notification->settings->coupon_code ?></div>
             <?php endif ?>

            <a href="<?= $notification->settings->button_url ?>" class="altumcode-coupon-button" style="background: <?= $notification->settings->button_background_color ?>;color: <?= $notification->settings->button_color ?>" target="<?= $notification->settings->url_new_tab ? '_blank' : '_self' ?>"><?= $notification->settings->button_text ?></a>

            <div>
                <a href="#" class="altumcode-coupon-footer"><?= $notification->settings->footer_text ?></a>
            </div>

            
        </div>
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
    url: '',
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


        /* On click the footer remove element */
        main_element.querySelector('.altumcode-coupon-footer').addEventListener('click', event => {

            AltumCodeManager.remove_notification(main_element);

            event.preventDefault();

        });

        /* On click event to the button */
        main_element.querySelector('.altumcode-coupon-button').addEventListener('click', event => {

            let notification_id = main_element.getAttribute('data-notification-id');

            send_tracking_data({
                notification_id: notification_id,
                type: 'notification',
                subtype: 'click'
            });

        });



    }



});
<?php $javascript = ob_get_clean(); ?>

<?php return (object) ['html' => $html, 'javascript' => $javascript] ?>
