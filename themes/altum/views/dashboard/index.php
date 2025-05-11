<?php defined('ALTUMCODE') || die() ?>



<section class="container">

    <?= \Altum\Alerts::output_alerts() ?>

    <div class="mt-5 d-flex justify-content-between">
        <h2 class="h4"><?= l('dashboard.campaigns_header') ?></h2>

        <div class="col-auto p-0 d-flex">
            <div>
                <?php if($this->user->plan_settings->campaigns_limit != -1 && $data->total_campaigns >= $this->user->plan_settings->campaigns_limit): ?>
                    <button type="button" data-toggle="tooltip" title="<?= l('global.info_message.plan_feature_limit') ?>" class="btn btn-primary disabled">
                        <i class="fa fa-fw fa-sm fa-plus"></i> <?= l('campaigns.create') ?>
                    </button>
                <?php else: ?>
                    <button type="button" data-toggle="modal" data-target="#create_campaign_modal" class="btn btn-primary"><i class="fa fa-fw fa-sm fa-plus"></i> <?= l('campaigns.create') ?></button>
                <?php endif ?>
            </div>
        </div>
    </div>


    <div class="mt-4">
            <div class="row">
                <div class="col-12 col-sm-6 col-xl mb-4 position-relative">
                    <div class="card d-flex flex-row h-100 overflow-hidden" style="background: white">
                        <div class="px-3 d-flex flex-column justify-content-center">
                            <i class="fa fa-fw fa-server text-primary-600"></i>
                        </div>

                        <div class="card-body text-truncate">
                            <?= sprintf(l('dashboard.total_campaigns'), '<span class="h6">' . nr($data->total_campaigns) . '</span>') ?>
                        </div>
                    </div>
                </div>

                <div class="col-12 col-sm-6 col-xl mb-4 position-relative">
                    <div class="card d-flex flex-row h-100 overflow-hidden" style="background: white">
                        <div class="px-3 d-flex flex-column justify-content-center">
                            <i class="fa fa-fw fa-bell text-primary-600"></i>
                        </div>

                        <div class="card-body text-truncate">
                            <?= sprintf(l('dashboard.total_notifications'), '<span class="h6">' . nr($data->total_notifications) . '</span>') ?>
                        </div>
                    </div>
                </div>

                <div class="col-12 col-sm-6 col-xl mb-4 position-relative">
                    <div class="card d-flex flex-row h-100 overflow-hidden" data-toggle="tooltip" title="<?= l('global.date.this_month') ?>" style="background: white">
                        <div class="px-3 d-flex flex-column justify-content-center">
                            <i class="fa fa-fw fa-adjust text-primary-600"></i>
                        </div>

                        <?php
                        $progress_percentage = $this->user->plan_settings->notifications_impressions_limit == '0' ? 100 : ($this->user->current_month_notifications_impressions / $this->user->plan_settings->notifications_impressions_limit) * 100;
                        $progress_class = $progress_percentage > 60 ? ($progress_percentage > 85 ? 'text-danger' : 'text-warning') : 'text-success';
                        ?>

                        <div class="card-body text-truncate">
                            <?= sprintf(l('dashboard.total_notifications_impressions'), '<span class="' . $progress_class .'">' . nr($this->user->current_month_notifications_impressions, 0, true) . '</span>', ($this->user->plan_settings->notifications_impressions_limit != -1 ? nr($this->user->plan_settings->notifications_impressions_limit, 0, true) : '∞')) ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    <?php if(count($data->campaigns)): ?>
        <div class="table-responsive table-custom-container mt-3">
            <table class="table table-custom">
                <thead>
                <tr>
                    <th><?= l('campaigns.table.campaign') ?></th>
                    <th class="d-none d-md-table-cell">Oluşturulma Tarihi</th>
                    <th style="display: none;"><?= l('campaigns.table.is_enabled') ?></th>
                    <th></th>
                </tr>
                </thead>
                <tbody>

                <?php foreach($data->campaigns as $row): ?>
                    <?php $row->branding = json_decode($row->branding ?? ''); ?>
                    <tr>
                        <td class="text-nowrap">
                            <div class="d-flex">
                                <img src="https://external-content.duckduckgo.com/ip3/<?= $row->domain ?>.ico" class="campaign-avatar rounded-circle mr-3" alt="" />

                                <div class="d-flex flex-column">
                                    <a href="<?= url('campaign/' . $row->campaign_id) ?>"><?= $row->name ?></a>

                                    <span class="text-muted">
                                        <?= $row->domain ?>
                                    </span>
                                </div>
                            </div>
                        </td>

                        <td class="text-nowrap d-none d-md-table-cell">
                             <span><small><?= sprintf(l('global.datetime_tooltip'), '' . \Altum\Date::get($row->datetime, 2) . '<br /><small>' . \Altum\Date::get($row->datetime, 3) . '</small>') ?></small></span>

                        </td>
                        <td class="text-nowrap" style="display:none;">
                            <div class="d-flex">
                                <div class="custom-control custom-switch" data-toggle="tooltip" title="<?= l('campaigns.table.is_enabled_tooltip') ?>">
                                    <input
                                            type="checkbox"
                                            class="custom-control-input"
                                            id="campaign_is_enabled_<?= $row->campaign_id ?>"
                                            data-row-id="<?= $row->campaign_id ?>"
                                            onchange="ajax_call_helper(event, 'campaigns-ajax', 'is_enabled_toggle')"
                                        <?= $row->is_enabled ? 'checked="checked"' : null ?>
                                    >
                                    <label class="custom-control-label clickable" for="campaign_is_enabled_<?= $row->campaign_id ?>"></label>
                                </div>
                            </div>
                        </td>

                        <td class="text-nowrap min-width-300 text-right">

                                <a href="<?= url('campaign/' . $row->campaign_id) ?>" class="btn btn-outline-secondary border-none mr-1" data-toggle="tooltip" title="" data-original-title="Sitenizdeki tüm araçları buraya tıklayarak inceleyebilirsiniz.">
                                    <svg class="svg-inline--fa fa-pencil-alt fa-w-16 fa-fw fa-sm mr-1" aria-hidden="true" focusable="false" data-prefix="fa" data-icon="pencil-alt" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" data-fa-i2svg=""><<path fill="currentColor" d="M224 512c35.32 0 63.97-28.65 63.97-64H160.03c0 35.35 28.65 64 63.97 64zm215.39-149.71c-19.32-20.76-55.47-51.99-55.47-154.29 0-77.7-54.48-139.9-127.94-155.16V32c0-17.67-14.32-32-31.98-32s-31.98 14.33-31.98 32v20.84C118.56 68.1 64.08 130.3 64.08 208c0 102.3-36.15 133.53-55.47 154.29-6 6.45-8.66 14.16-8.61 21.71.11 16.4 12.98 32 32.1 32h383.8c19.12 0 32-15.6 32.1-32 .05-7.55-2.61-15.27-8.61-21.71z"></path></svg> Araçları Gör
                                </a>
                           
                           

                                <button href="javascript:void(0)" 
                                        data-toggle="modal"
                                        data-target="#campaign_pixel_key"
                                        data-pixel-key="<?= $row->pixel_key ?>"
                                        data-campaign-id="<?= $row->campaign_id ?>" class="btn btn-outline-secondary border-none mr-1" title="" data-original-title="<?= l('global.delete') ?>" aria-describedby="tooltip737308">
                                <svg class="svg-inline--fa fa-pencil-alt fa-w-16 fa-fw"  aria-hidden="true" focusable="false" data-prefix="fa" data-icon="code" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 640 512" data-fa-i2svg=""><path fill="currentColor" d="M278.9 511.5l-61-17.7c-6.4-1.8-10-8.5-8.2-14.9L346.2 8.7c1.8-6.4 8.5-10 14.9-8.2l61 17.7c6.4 1.8 10 8.5 8.2 14.9L293.8 503.3c-1.9 6.4-8.5 10.1-14.9 8.2zm-114-112.2l43.5-46.4c4.6-4.9 4.3-12.7-.8-17.2L117 256l90.6-79.7c5.1-4.5 5.5-12.3.8-17.2l-43.5-46.4c-4.5-4.8-12.1-5.1-17-.5L3.8 247.2c-5.1 4.7-5.1 12.8 0 17.5l144.1 135.1c4.9 4.6 12.5 4.4 17-.5zm327.2.6l144.1-135.1c5.1-4.7 5.1-12.8 0-17.5L492.1 112.1c-4.8-4.5-12.4-4.3-17 .5L431.6 159c-4.6 4.9-4.3 12.7.8 17.2L523 256l-90.6 79.7c-5.1 4.5-5.5 12.3-.8 17.2l43.5 46.4c4.5 4.9 12.1 5.1 17 .6z"></path></svg> Sitene Ekle
                            </button>

                              

                                <a href="javascript:void(0)" style="display: none;" data-toggle="modal" data-target="#update_campaign" data-campaign-id="<?= $row->campaign_id ?>" data-name="<?= $row->name ?>" data-domain="<?= $row->domain ?>" data-include-subdomains="<?= (bool) $row->include_subdomains ?>" class="btn btn-outline-secondary border-none mr-1" data-modal-toggle="tooltip" title="" data-original-title="<?= l('global.edit') ?>">
                                <svg class="svg-inline--fa fa-pencil-alt fa-w-16 fa-fw" aria-hidden="true" focusable="false" data-prefix="fa" data-icon="pencil-alt" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" data-fa-i2svg=""><path fill="currentColor" d="M497.9 142.1l-46.1 46.1c-4.7 4.7-12.3 4.7-17 0l-111-111c-4.7-4.7-4.7-12.3 0-17l46.1-46.1c18.7-18.7 49.1-18.7 67.9 0l60.1 60.1c18.8 18.7 18.8 49.1 0 67.9zM284.2 99.8L21.6 362.4.4 483.9c-2.9 16.4 11.4 30.6 27.8 27.8l121.5-21.3 262.6-262.6c4.7-4.7 4.7-12.3 0-17l-111-111c-4.8-4.7-12.4-4.7-17.1 0zM124.1 339.9c-5.5-5.5-5.5-14.3 0-19.8l154-154c5.5-5.5 14.3-5.5 19.8 0s5.5 14.3 0 19.8l-154 154c-5.5 5.5-14.3 5.5-19.8 0zM88 424h48v36.3l-64.5 11.3-31.1-31.1L51.7 376H88v48z"></path></svg><!-- <i class="fa fa-fw fa-md fa-pencil-alt"></i> -->
                            </a>

                            <button href="javascript:void(0)" style="display: none;" data-toggle="modal" data-target="#campaign_delete_modal" data-campaign-id="<?= $row->campaign_id ?>" data-resource-name="<?= $row->name ?>" class="btn btn-outline-danger mr-1" title="" data-original-title="<?= l('global.delete') ?>" aria-describedby="tooltip737308">
                                <svg class="svg-inline--fa fa-times fa-w-11 fa-fw" aria-hidden="true" focusable="false" data-prefix="fa" data-icon="times" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 352 512" data-fa-i2svg=""><path fill="currentColor" d="M242.72 256l100.07-100.07c12.28-12.28 12.28-32.19 0-44.48l-22.24-22.24c-12.28-12.28-32.19-12.28-44.48 0L176 189.28 75.93 89.21c-12.28-12.28-32.19-12.28-44.48 0L9.21 111.45c-12.28 12.28-12.28 32.19 0 44.48L109.28 256 9.21 356.07c-12.28 12.28-12.28 32.19 0 44.48l22.24 22.24c12.28 12.28 32.2 12.28 44.48 0L176 322.72l100.07 100.07c12.28 12.28 32.2 12.28 44.48 0l22.24-22.24c12.28-12.28 12.28-32.19 0-44.48L242.72 256z"></path></svg><!-- <i class="fa fa-fw fa-md fa-times"></i> -->
                            </button>
                        </td>

                        <td style="display:none;">
                            <div class="d-flex justify-content-end">
                                <div class="dropdown">
                                <button type="button" class="btn btn-link text-secondary dropdown-toggle dropdown-toggle-simple" data-toggle="dropdown" data-boundary="viewport">
                                    <i class="fa fa-fw fa-ellipsis-v"></i>
                                </button>

                                <div class="dropdown-menu dropdown-menu-right">
                                    <a href="<?= url('campaign/' . $row->campaign_id) ?>" class="dropdown-item"><i class="fa fa-fw fa-sm fa-server mr-2"></i> <?= l('global.view') ?></a>
                                    <a href="<?= url('campaign/' . $row->campaign_id . '/statistics') ?>" class="dropdown-item"><i class="fa fa-fw fa-sm fa-chart-bar mr-2"></i> <?= l('campaign.statistics.link') ?></a>
                                    <a href="#" data-toggle="modal" data-target="#update_campaign" data-campaign-id="<?= $row->campaign_id ?>" data-name="<?= $row->name ?>" data-domain="<?= $row->domain ?>" data-include-subdomains="<?= (bool) $row->include_subdomains ?>" class="dropdown-item"><i class="fa fa-fw fa-sm fa-pencil-alt mr-2"></i> <?= l('global.edit') ?></a>

                                    <a
                                        href="#"
                                        data-toggle="modal"
                                        data-target="#campaign_pixel_key"
                                        data-pixel-key="<?= $row->pixel_key ?>"
                                        data-campaign-id="<?= $row->campaign_id ?>"
                                        class="dropdown-item"
                                    ><i class="fa fa-fw fa-sm fa-code mr-2"></i> <?= l('campaign.pixel_key') ?></a>

                                    <?php if($this->user->plan_settings->custom_branding): ?>
                                        <a href="#" data-toggle="modal" data-target="#custom_branding_campaign" data-campaign-id="<?= $row->campaign_id ?>" data-branding-name="<?= $row->branding->name ?? '' ?>" data-branding-url="<?= $row->branding->url ?? '' ?>" class="dropdown-item"><i class="fa fa-fw fa-sm fa-random mr-2"></i> <?= l('campaign.custom_branding') ?></a>
                                    <?php endif ?>
                                    <a href="#" data-toggle="modal" data-target="#campaign_duplicate_modal" data-campaign-id="<?= $row->campaign_id ?>" class="dropdown-item"><i class="fa fa-fw fa-sm fa-copy mr-2"></i> <?= l('global.duplicate') ?></a>

                                    <a href="#" data-toggle="modal" data-target="#campaign_delete_modal" data-campaign-id="<?= $row->campaign_id ?>" data-resource-name="<?= $row->name ?>" class="dropdown-item"><i class="fa fa-fw fa-sm fa-trash-alt mr-2"></i> <?= l('global.delete') ?></a>
                                </div>
                            </div>
                            </div>
                        </td>
                    </tr>
                <?php endforeach ?>

                    <tr >
                        <td class="py-3" colspan="5">
                            <a href="<?= url('campaigns') ?>" class="text-muted">
                                <i class="fa fa-angle-right fa-sm fa-fw mr-1"></i> <?= l('dashboard.view_all') ?>
                            </a>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>

    <?php else: ?>

        <div class="d-flex flex-column align-items-center justify-content-center py-3">
            <img src="<?= ASSETS_FULL_URL . 'images/no_rows.svg' ?>" class="col-10 col-md-7 col-lg-4 mb-3" alt="<?= l('global.no_data') ?>" />
            <h2 class="h4 text-muted"><?= l('global.site_no_data') ?></h2>
            <p class="text-muted"><?= l('campaigns.site_no_data') ?></a></p>
        </div>

    <?php endif ?>


    <?php if(count($data->notifications)): ?>
        <div class="mt-5 d-flex justify-content-between" style="display:none !important;">
            <h2 class="h4"><?= l('dashboard.notifications_header') ?></h2>
        </div>

        <div class="table-responsive table-custom-container mt-3"  style="display:none !important;">
            <table class="table table-custom">
                <thead>
                    <tr>
                        <th><?= l('notifications.table.name') ?></th>
                        <th class="d-none d-md-table-cell"><?= l('notifications.table.display_trigger') ?></th>
                        <th class="d-none d-md-table-cell"><?= l('notifications.table.display_duration') ?></th>
                        <th><?= l('notifications.table.is_enabled') ?></th>
                        <th></th>
                    </tr>
                    </thead>
                <tbody>
                <?php foreach($data->notifications as $row): ?>
                    <?php $row->settings = json_decode($row->settings) ?>

                    <tr>
                        <td class="text-nowrap">
                            <div class="d-flex flex-column">
                                <a href="<?= url('notification/' . $row->notification_id) ?>"><?= $row->name ?></a>

                                <div class="text-muted">
                                    <i class="<?= l('notification.' . mb_strtolower($row->type) . '.icon') ?> fa-sm mr-1"></i> <?= l('notification.' . mb_strtolower($row->type) . '.name') ?>
                                </div>
                            </div>
                        </td>
                        <td class="text-nowrap d-none d-md-table-cell">
                            <div class="text-muted d-flex flex-column">

                                <?php
                                switch($row->settings->display_trigger) {
                                    case 'delay':

                                        echo '<span>' . $row->settings->display_trigger_value . ' <small>' . l('global.date.seconds') . '</small></span>';
                                        echo '<small>' . l('notification.settings.display_trigger_' . $row->settings->display_trigger) . '</small>';

                                        break;

                                    case 'scroll':

                                        echo $row->settings->display_trigger_value . '%';
                                        echo '<small>' . l('notification.settings.display_trigger_' . $row->settings->display_trigger)  . '</small>';

                                        break;

                                    case 'exit_intent':

                                        echo l('notification.settings.display_trigger_' . $row->settings->display_trigger);

                                        break;
                                }
                                ?>

                            </div>
                        </td>
                        <td class="text-nowrap d-none d-md-table-cell">
                            <span><?= $row->settings->display_duration == -1 ? l('notifications.table.display_duration_unlimited') : $row->settings->display_duration . ' <small>' . l('global.date.seconds') . '</small>' ?></span>
                        </td>
                        <td class="text-nowrap">
                            <div class="d-flex">
                                <div class="custom-control custom-switch" data-toggle="tooltip" title="<?= l('notifications.table.is_enabled_tooltip') ?>">
                                    <input
                                            type="checkbox"
                                            class="custom-control-input"
                                            id="notification_is_enabled_<?= $row->notification_id ?>"
                                            data-row-id="<?= $row->notification_id ?>"
                                            onchange="ajax_call_helper(event, 'notifications-ajax', 'is_enabled_toggle')"
                                        <?= $row->is_enabled ? 'checked="checked"' : null ?>
                                    >
                                    <label class="custom-control-label clickable" for="notification_is_enabled_<?= $row->notification_id ?>"></label>
                                </div>
                            </div>
                        </td>
                        <td>
                            <div class="d-flex justify-content-end">
                                <div class="dropdown">
                                    <button type="button" class="btn btn-link text-secondary dropdown-toggle dropdown-toggle-simple" data-toggle="dropdown" data-boundary="viewport">
                                        <i class="fa fa-fw fa-ellipsis-v"></i>
                                    </button>

                                    <div class="dropdown-menu dropdown-menu-right">
                                        <a href="<?= url('notification/' . $row->notification_id) ?>" class="dropdown-item"><i class="fa fa-fw fa-sm fa-pencil-alt mr-2"></i> <?= l('global.edit') ?></a>
                                        <a href="<?= url('notification/' . $row->notification_id . '/statistics') ?>" class="dropdown-item"><i class="fa fa-fw fa-sm fa-chart-bar mr-2"></i> <?= l('notification.statistics.link') ?></a>
                                        <a href="#" data-toggle="modal" data-target="#notification_duplicate_modal" data-notification-id="<?= $row->notification_id ?>" class="dropdown-item"><i class="fa fa-fw fa-sm fa-copy mr-2"></i> <?= l('global.duplicate') ?></a>
                                        <a href="#" data-toggle="modal" data-target="#notification_delete_modal" data-notification-id="<?= $row->notification_id ?>" data-resource-name="<?= $row->name ?>" class="dropdown-item"><i class="fa fa-fw fa-sm fa-trash-alt mr-2"></i> <?= l('global.delete') ?></a>
                                    </div>
                                </div>
                            </div>
                        </td>
                    </tr>
                <?php endforeach ?>
                </tbody>
            </table>
        </div>
    <?php endif ?>
</section>

<?php \Altum\Event::add_content(include_view(THEME_PATH . 'views/campaign/create_campaign_modal.php'), 'modals'); ?>
<?php \Altum\Event::add_content(include_view(THEME_PATH . 'views/campaign/campaign_pixel_key_modal.php'), 'modals'); ?>
<?php \Altum\Event::add_content(include_view(THEME_PATH . 'views/campaign/update_campaign_modal.php'), 'modals'); ?>
<?php \Altum\Event::add_content(include_view(THEME_PATH . 'views/campaign/custom_branding_campaign_modal.php'), 'modals'); ?>
<?php \Altum\Event::add_content(include_view(THEME_PATH . 'views/partials/duplicate_modal.php', ['modal_id' => 'campaign_duplicate_modal', 'resource_id' => 'campaign_id', 'path' => 'campaign/duplicate']), 'modals'); ?>
<?php \Altum\Event::add_content(include_view(THEME_PATH . 'views/partials/duplicate_modal.php', ['modal_id' => 'notification_duplicate_modal', 'resource_id' => 'notification_id', 'path' => 'notification/duplicate']), 'modals'); ?>
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
