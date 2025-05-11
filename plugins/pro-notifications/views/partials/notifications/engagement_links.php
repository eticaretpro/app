<?php defined('ALTUMCODE') || die() ?>

<?php ob_start() ?>
<div role="dialog" class="altumcode-wrapper altumcode-wrapper-<?= $notification->settings->border_radius ?> <?= $notification->settings->shadow ? 'altumcode-wrapper-shadow' : null ?> <?= ($notification->settings->direction ?? 'ltr') == 'rtl' ? 'altumcode-rtl' : null ?> altumcode-engagement-links-wrapper" style='font-family: <?= $notification->settings->font ?? 'inherit' ?>!important;background-color: <?= $notification->settings->background_color ?>;border-width: <?= $notification->settings->border_width ?>px;border-color: <?= $notification->settings->border_color ?>;<?= $notification->settings->background_pattern_svg ? 'background-image: url("' . $notification->settings->background_pattern_svg . '")' : null ?>;'>
    <div class="altumcode-engagement-links-content">
        <div class="altumcode-engagement-links-header">
            <div class="altumcode-engagement-links-title" style="color: <?= $notification->settings->title_color ?>"><?= $notification->settings->title ?></div>

            <button class="altumcode-close" style="color: <?= $notification->settings->close_button_color ?>;">×</button>
        </div>

        <div class="altumcode-hidden">
            <div class="altumcode-engagement-links-categories">
            <?php if($notification->settings->categories): ?>
                <?php foreach($notification->settings->categories as $category): ?>
                    <div class="altumcode-engagement-links-category">
                        <p class="altumcode-engagement-links-category-title" style="color: <?= $notification->settings->categories_title_color ?>;"><?= $category->title ?></p>
                        <p class="altumcode-engagement-links-category-description" style="color: <?= $notification->settings->categories_description_color ?>;"><?= $category->description ?></p>

                        <div class="altumcode-engagement-links-category-links">
                            <?php foreach($category->links as $link): ?>
                            <a href="<?= $link->url ?>" class="altumcode-engagement-links-category-link" style="background: <?= $notification->settings->categories_links_background_color ?>;border-color: <?= $notification->settings->categories_links_border_color ?>;">
                                <?php if(!empty($link->image)): ?>
                                    <img src="<?= $link->image ?>" class="altumcode-engagement-links-category-link-image" alt="<?= $link->title ?>" loading="lazy" />
                                <?php endif ?>

                                <div class="altumcode-engagement-links-category-link-content">
                                    <p class="altumcode-engagement-links-category-link-title" style="color: <?= $notification->settings->categories_links_title_color ?>;"><?= $link->title ?></p>
                                    <p class="altumcode-engagement-links-category-link-description" style="color: <?= $notification->settings->categories_links_description_color ?>;"><?= $link->description ?></p>
                                </div>
                            </a>
                            <?php endforeach ?>
                        </div>
                    </div>
                <?php endforeach ?>
            <?php endif ?>
            </div>
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
