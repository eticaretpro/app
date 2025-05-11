<?php defined('ALTUMCODE') || die() ?>

<div class="container d-print-none">
    <div class="d-flex flex-column flex-lg-row justify-content-between mb-3">
        <div class="mb-3 mb-lg-0">
            <a class="h5" href="<?= url() ?>" data-logo data-light-value="<?= settings()->main->logo_light != '' ? \Altum\Uploads::get_full_url('logo_light') . settings()->main->logo_light : settings()->main->title ?>" data-light-class="<?= settings()->main->logo_light != '' ? 'mb-2 footer-logo' : 'mb-2' ?>" data-dark-value="<?= settings()->main->logo_dark != '' ? \Altum\Uploads::get_full_url('logo_dark') . settings()->main->logo_dark : settings()->main->title ?>" data-dark-class="<?= settings()->main->logo_dark != '' ? 'mb-2 footer-logo' : 'mb-2' ?>">
                <?php if(settings()->main->{'logo_' . \Altum\ThemeStyle::get()} != ''): ?>
                    <img src="<?= \Altum\Uploads::get_full_url('logo_' . \Altum\ThemeStyle::get()) . settings()->main->{'logo_' . \Altum\ThemeStyle::get()} ?>" class="mb-2 footer-logo" alt="<?= l('global.accessibility.logo_alt') ?>" />
                <?php else: ?>
                    <span class="mb-2"><?= settings()->main->title ?></span>
                <?php endif ?>
            </a>
            <div><?= sprintf(l('global.footer.copyright'), date('Y'), settings()->main->title) ?></div>
        </div>

      
    </div>

    <div class="row" style="display: none;">
        <div class="col-12 col-lg mb-3">
            <ul class="list-style-none d-flex flex-column flex-lg-row flex-wrap m-0">
                <?php if(settings()->main->blog_is_enabled): ?>
                    <li class="mb-2 mr-lg-3"><a href="<?= url('blog') ?>"><?= l('blog.menu') ?></a></li>
                <?php endif ?>

                <?php if(settings()->payment->is_enabled): ?>
                    <?php if(\Altum\Plugin::is_active('affiliate') && settings()->affiliate->is_enabled): ?>
                        <li class="mb-2 mr-lg-3"><a href="<?= url('affiliate') ?>"><?= l('affiliate.menu') ?></a></li>
                    <?php endif ?>
                <?php endif ?>

                <?php if(settings()->email_notifications->contact && !empty(settings()->email_notifications->emails)): ?>
                    <li class="mb-2 mr-lg-3"><a href="<?= url('contact') ?>"><?= l('contact.menu') ?></a></li>
                <?php endif ?>

                <?php if(settings()->cookie_consent->is_enabled): ?>
                    <li class="mb-2 mr-lg-3"><a href="#" data-cc="c-settings"><?= l('global.cookie_consent.menu') ?></a></li>
                <?php endif ?>

                
            </ul>
        </div>


        <div class="col-12 col-lg-auto">
            <div class="d-flex flex-wrap">
                <?php foreach(require APP_PATH . 'includes/admin_socials.php' as $key => $value): ?>
                    <?php if(isset(settings()->socials->{$key}) && !empty(settings()->socials->{$key})): ?>
                        <a href="<?= sprintf($value['format'], settings()->socials->{$key}) ?>" class="mr-2 mr-lg-0 ml-lg-2 mb-2" target="_blank" data-toggle="tooltip" title="<?= $value['name'] ?>"><i class="<?= $value['icon'] ?> fa-fw fa-lg"></i></a>
                    <?php endif ?>
                <?php endforeach ?>
            </div>
        </div>
    </div>
</div>

<style>
    .custom-radio-box .custom-radio-box-main-icon img {
    border-radius: 8px;
}
</style>


