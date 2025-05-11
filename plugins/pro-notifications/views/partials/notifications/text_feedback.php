<?php defined('ALTUMCODE') || die() ?>

<?php ob_start() ?>
<div role="dialog" class="altumcode-wrapper altumcode-wrapper-<?= $notification->settings->border_radius ?> <?= $notification->settings->shadow ? 'altumcode-wrapper-shadow' : null ?> <?= ($notification->settings->direction ?? 'ltr') == 'rtl' ? 'altumcode-rtl' : null ?> altumcode-text-feedback-wrapper" style='font-family: <?= $notification->settings->font ?? 'inherit' ?>!important;background-color: <?= $notification->settings->background_color ?>;border-width: <?= $notification->settings->border_width ?>px;border-color: <?= $notification->settings->border_color ?>;<?= $notification->settings->background_pattern_svg ? 'background-image: url("' . $notification->settings->background_pattern_svg . '")' : null ?>;'>
    <div class="altumcode-text-feedback-content">
        <div class="altumcode-text-feedback-header">
            <div class="altumcode-text-feedback-title" style="color: <?= $notification->settings->title_color ?>"><button type="button" class="altumcode-text-feedback-expand" style="color: <?= $notification->settings->title_color ?>">&rarr;</button> <?= $notification->settings->title ?></div>

            <button class="altumcode-close" style="color: <?= $notification->settings->close_button_color ?>;">×</button>
        </div>

        <div class="altumcode-hidden">
            <p class="altumcode-text-feedback-description" style="color: <?= $notification->settings->description_color ?>"><?= $notification->settings->description ?></p>

            <form id="altumcode-text-feedback-form" class="altumcode-text-feedback-form" name="" action="" method="GET" role="form">
                <div class="altumcode-text-feedback-row">
                    <input type="text" class="" name="input" placeholder="<?= $notification->settings->input_placeholder ?>" aria-label="<?= $notification->settings->input_placeholder ?>" required="required" />

                    <button type="submit" name="button" style="color: <?= $notification->settings->button_color ?>; background: <?= $notification->settings->button_background_color ?>"><?= $notification->settings->button_text ?></button>
                </div>
            </form>
        </div>

        
    </div>
</div>
<?php $html = ob_get_clean() ?>


<?php ob_start() ?>
new AltumCodeManager({
    should_show: !localStorage.getItem('notification_<?= $notification->notification_id ?>_converted'),
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
        main_element.querySelector('.altumcode-text-feedback-title').addEventListener('click', event => {
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

        /* Form submission */
        main_element.querySelector('#altumcode-text-feedback-form').addEventListener('submit', event => {

            let input = event.currentTarget.querySelector('[name="input"]').value;
            let notification_id = main_element.getAttribute('data-notification-id');


            if(input.trim() != '') {

                /* Data collection from the form */
                send_tracking_data({
                    notification_id: notification_id,
                    type: 'collector',
                    input
                });

                AltumCodeManager.remove_notification(main_element);

                /* Make sure to let the browser know of the conversion so that it is not shown again */
                localStorage.setItem(`notification_${notification_id}_converted`, true);

                /* Redirect the user to thank you url if needed */
                let thank_you_url = <?= json_encode($notification->settings->thank_you_url) ?>;

                if(thank_you_url.trim() != '') {
                    setTimeout(() => {
                        window.location.href = thank_you_url;
                    }, 350);
                }

            }

            event.preventDefault();
        });

    }
});
<?php $javascript = ob_get_clean(); ?>

<?php return (object) ['html' => $html, 'javascript' => $javascript] ?>
