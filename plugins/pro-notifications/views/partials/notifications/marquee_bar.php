<?php defined('ALTUMCODE') || die() ?>


<?php ob_start() ?>

<div role="dialog" class="altumcode-wrapper altumcode-wrapper-<?= $notification->settings->border_radius ?> <?= $notification->settings->shadow ? 'altumcode-wrapper-shadow' : null ?> <?= ($notification->settings->direction ?? 'ltr') == 'rtl' ? 'altumcode-rtl' : null ?> " style='font-family: <?= $notification->settings->font ?? 'inherit' ?>!important;background-color: <?= $notification->settings->background_color ?>;border-width: <?= $notification->settings->border_width ?>px;border-color: <?= $notification->settings->border_color ?>;<?= $notification->settings->background_pattern_svg ? 'background-image: url("' . $notification->settings->background_pattern_svg . '")' : null ?>;'>
    <div class="altumcode-coupon-bar-content ">
        <div class="altumcode-coupon-bar-row marquee">
            <p class="altumcode-coupon-bar-title" style="color: <?= $notification->settings->title_color ?>">
                <span><?= $notification->settings->title ?> </span>
                <span><?= $notification->settings->title ?> </span> 
                <span><?= $notification->settings->title ?> </span>
                <span><?= $notification->settings->title ?> </span>
                <span><?= $notification->settings->title ?> </span>
                <span><?= $notification->settings->title ?> </span>
                <span><?= $notification->settings->title ?> </span>
                <span><?= $notification->settings->title ?> </span>
                <span><?= $notification->settings->title ?> </span>
                <span><?= $notification->settings->title ?> </span>
                <span><?= $notification->settings->title ?> </span>
                <span><?= $notification->settings->title ?> </span>
            </p>
        </div>

    </div>
</div>
<style>
    .marquee {
      white-space: nowrap;
      overflow: hidden;
      position: relative;
    }

    .marquee p {
      display: inline-block;
      animation: marquee 70s linear infinite;
    }

     .marquee p span{

        padding: 0 20px !important;

         }

    @keyframes marquee {
      0% {
        transform: translateX(100vh);
      }
      100% {
        transform: translateX(-100%);
      }
    }
  </style>
<?php $html = ob_get_clean() ?>


<?php ob_start() ?>
new AltumCodeManager({
    content: <?= json_encode($html) ?>,
    display_mobile: <?= json_encode($notification->settings->display_mobile) ?>,
    display_desktop: <?= json_encode($notification->settings->display_desktop) ?>,
    display_trigger: <?= json_encode($notification->settings->display_trigger) ?>,
    display_trigger_value: <?= json_encode($notification->settings->display_trigger_value) ?>,
    duration: <?= $notification->settings->display_duration === -1 ? -1 : $notification->settings->display_duration * 1000 ?>,
    url: <?= json_encode($notification->settings->url) ?>,
    url_new_tab: <?= json_encode($notification->settings->url_new_tab) ?>,
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
}).initiate();
<?php $javascript = ob_get_clean(); ?>

<?php return (object) ['html' => $html, 'javascript' => $javascript] ?>
