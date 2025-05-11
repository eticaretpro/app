<?php defined('ALTUMCODE') || die() ?>

<header class="mt-5 pb-0">
    <div class="container">

        <nav aria-label="breadcrumb">
            <ol class="custom-breadcrumbs small">
                <li>
                    <a href="<?= url('') ?>"><?= l('campaigns.breadcrumb') ?></a><i class="fa fa-fw fa-angle-right"></i>
                </li>
                <li class="active" aria-current="page"><?= $data->campaign->name ?></li>
            </ol>
        </nav>

        <div class="row">
            <div class="col text-truncate">
                <h1 class="h3 text-truncate"><span class=""><?= $data->campaign->name ?></span></h1>

                <div class="d-flex align-items-center text-muted">
                    <img src="https://external-content.duckduckgo.com/ip3/<?= $data->campaign->domain ?>.ico" class="img-fluid icon-favicon mr-1" />
                    <div class="d-inline-block text-truncate"><a href="http://<?= $data->campaign->domain ?>" target="_blank"><?= $data->campaign->domain ?></a></div>
                </div>
            </div>

            <div class="col-auto">
                <div class="d-flex align-items-center">
                    <div class="custom-control custom-switch mr-3" data-toggle="tooltip" style="display: none;" title="<?= l('campaigns.table.is_enabled_tooltip') ?>">
                        <input
                                type="checkbox"
                                class="custom-control-input"
                                id="campaign_is_enabled_<?= $data->campaign->campaign_id ?>"
                                data-row-id="<?= $data->campaign->campaign_id ?>"
                                onchange="ajax_call_helper(event, 'campaigns-ajax', 'is_enabled_toggle')"
                            <?= $data->campaign->is_enabled ? 'checked="checked"' : null ?>
                        >
                        <label class="custom-control-label clickable" for="campaign_is_enabled_<?= $data->campaign->campaign_id ?>"></label>
                    </div>

                    <div class="col-auto p-0">
<a href="#" data-toggle="modal" data-target="#campaign_pixel_key" data-pixel-key="<?= $data->campaign->pixel_key ?>" class="btn btn-sm btn-outline-secondary rounded-pill highlight-shadow"><svg class="svg-inline--fa fa-code fa-w-20 fa-fw fa-sm mr-1" aria-hidden="true" focusable="false" data-prefix="fa" data-icon="code" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 640 512" data-fa-i2svg=""><path fill="currentColor" d="M278.9 511.5l-61-17.7c-6.4-1.8-10-8.5-8.2-14.9L346.2 8.7c1.8-6.4 8.5-10 14.9-8.2l61 17.7c6.4 1.8 10 8.5 8.2 14.9L293.8 503.3c-1.9 6.4-8.5 10.1-14.9 8.2zm-114-112.2l43.5-46.4c4.6-4.9 4.3-12.7-.8-17.2L117 256l90.6-79.7c5.1-4.5 5.5-12.3.8-17.2l-43.5-46.4c-4.5-4.8-12.1-5.1-17-.5L3.8 247.2c-5.1 4.7-5.1 12.8 0 17.5l144.1 135.1c4.9 4.6 12.5 4.4 17-.5zm327.2.6l144.1-135.1c5.1-4.7 5.1-12.8 0-17.5L492.1 112.1c-4.8-4.5-12.4-4.3-17 .5L431.6 159c-4.6 4.9-4.3 12.7.8 17.2L523 256l-90.6 79.7c-5.1 4.5-5.5 12.3-.8 17.2l43.5 46.4c4.5 4.9 12.1 5.1 17 .6z"></path></svg> Pixel Kodu</a>
</div>

                    <div class="dropdown">
                        <button type="button" class="btn btn-link text-secondary dropdown-toggle dropdown-toggle-simple" data-toggle="dropdown" data-boundary="viewport">
                            <i class="fa fa-fw fa-ellipsis-v"></i>
                        </button>

                        <div class="dropdown-menu dropdown-menu-right">
                            <a href="<?= url('campaign/' . $data->campaign->campaign_id) ?>" class="dropdown-item"><i class="fa fa-fw fa-sm fa-server mr-2"></i> <?= l('global.view') ?></a>
                            <a href="<?= url('campaign/' . $data->campaign->campaign_id . '/statistics') ?>" class="dropdown-item"><i class="fa fa-fw fa-sm fa-chart-bar mr-2"></i> <?= l('campaign.statistics.link') ?></a>

                            <a href="#" data-toggle="modal" data-target="#update_campaign" data-campaign-id="<?= $data->campaign->campaign_id ?>" data-name="<?= $data->campaign->name ?>" data-domain="<?= $data->campaign->domain ?>" data-include-subdomains="<?= (bool) $data->campaign->include_subdomains ?>" class="dropdown-item"><i class="fa fa-fw fa-sm fa-pencil-alt mr-2"></i> <?= l('global.edit') ?></a>

                            <a
                                    href="#"
                                    data-toggle="modal"
                                    data-target="#campaign_pixel_key"
                                    data-pixel-key="<?= $data->campaign->pixel_key ?>"
                                    class="dropdown-item"
                            ><i class="fa fa-fw fa-sm fa-code mr-2"></i> <?= l('campaign.pixel_key') ?></a>

                            <?php if($this->user->plan_settings->custom_branding): ?>
                                <a href="#" data-toggle="modal" data-target="#custom_branding_campaign" data-campaign-id="<?= $data->campaign->campaign_id ?>" data-branding-name="<?= $data->campaign->branding->name ?? '' ?>" data-branding-url="<?= $data->campaign->branding->url ?? '' ?>" class="dropdown-item"><i class="fa fa-fw fa-sm fa-random mr-2"></i> <?= l('campaign.custom_branding') ?></a>
                            <?php endif ?>
                            <a href="#" data-toggle="modal" data-target="#campaign_duplicate_modal" data-campaign-id="<?= $data->campaign->campaign_id ?>" class="dropdown-item"><i class="fa fa-fw fa-sm fa-copy mr-2"></i> <?= l('global.duplicate') ?></a>

                            <a style="display: none;" href="#" data-toggle="modal" data-target="#campaign_delete_modal" data-campaign-id="<?= $data->campaign->campaign_id ?>" data-resource-name="<?= $data->campaign->name ?>" class="dropdown-item"><i class="fa fa-fw fa-sm fa-trash-alt mr-2"></i> <?= l('global.delete') ?></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <ul class="mt-5 nav nav-custom">
            <li class="nav-item">
                <a href="<?= url('campaign/' . $data->campaign->campaign_id) ?>" class="nav-link <?= $data->method == 'settings' ? 'active' : null ?>">
                    <i class="fa fa-fw fa-sm fa-bell mr-1"></i> <?= l('campaign.notifications.link') ?>
                </a>
            </li>

            
            

            <li class="nav-item" style="display:none;">
                <a href="<?= url('campaign/' . $data->campaign->campaign_id . '/statistics') ?>" class="nav-link <?= $data->method == 'statistics' ? 'active' : null ?>">
                    <i class="fa fa-fw fa-sm fa-chart-bar mr-1"></i> <?= l('campaign.statistics.link') ?>
                </a>
            </li>


             <li class="nav-item">
                <a href="<?= url('campaign/' . $data->campaign->campaign_id . '/support') ?>" class="nav-link <?= $data->method == 'support' ? 'active' : null ?>">
                    <i class="fa fa-fw fa-sm fa-cog mr-1"></i> Ayarlar
                </a>
            </li>
           


            
        </ul>
    </div>
</header>

<section class="container">
    <?= \Altum\Alerts::output_alerts() ?>

    <?= $this->views['method'] ?>
</section>

<?php \Altum\Event::add_content(include_view(THEME_PATH . 'views/campaign/campaign_pixel_key_modal.php'), 'modals'); ?>
<?php \Altum\Event::add_content(include_view(THEME_PATH . 'views/campaign/update_campaign_modal.php'), 'modals'); ?>
<?php \Altum\Event::add_content(include_view(THEME_PATH . 'views/campaign/custom_branding_campaign_modal.php'), 'modals'); ?>
<?php \Altum\Event::add_content(include_view(THEME_PATH . 'views/partials/duplicate_modal.php', ['modal_id' => 'notification_duplicate_modal', 'resource_id' => 'notification_id', 'path' => 'notification/duplicate']), 'modals'); ?>
<?php \Altum\Event::add_content(include_view(THEME_PATH . 'views/partials/duplicate_modal.php', ['modal_id' => 'campaign_duplicate_modal', 'resource_id' => 'campaign_id', 'path' => 'campaign/duplicate']), 'modals'); ?>
<?php \Altum\Event::add_content(include_view(THEME_PATH . 'views/partials/universal_delete_modal_form.php', [
    'name' => 'campaign',
    'resource_id' => 'campaign_id',
    'has_dynamic_resource_name' => true,
    'path' => 'campaign/delete'
]), 'modals'); ?>
<?php \Altum\Event::add_content(include_view(THEME_PATH . 'views/partials/universal_delete_modal_form.php', [
    'name' => 'notification',
    'resource_id' => 'notification_id',
    'has_dynamic_resource_name' => true,
    'path' => 'notification/delete'
]), 'modals'); ?>

<?php ob_start() ?>
<script>
    <?php if(isset($_GET['pixel_key_modal'])): ?>
    /* Open the pixel key modal */
    $('[data-pixel-key]').trigger('click');
    <?php endif ?>
</script>
<?php \Altum\Event::add_content(ob_get_clean(), 'javascript') ?>
