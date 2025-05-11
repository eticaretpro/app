<?php defined('ALTUMCODE') || die() ?>

<?php ob_start() ?>

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

        var baslik = document.title;
            var yeniBaslik = "<?= $notification->settings->html ?>";
            window.onblur = function(){
            document.title = yeniBaslik;
            }
            window.onfocus = function()
            {
            document.title = baslik;
            }

        /* On click */
        main_element.querySelector('.altumcode-engagement-links-title').addEventListener('click', event => {
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
