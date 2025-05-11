<?php defined('ALTUMCODE') || die() ?>

<header class="mt-5">
    <div class="container">

        <div class="d-flex justify-content-between">
            <h1 class="h2"><?= l('campaigns.header') ?></h1>

            <div class="col-auto p-0 d-flex">
                <div>
                    <?php if($this->user->plan_settings->campaigns_limit != -1 && $data->campaigns_total >= $this->user->plan_settings->campaigns_limit): ?>
                        <button type="button" data-toggle="tooltip" title="<?= l('global.info_message.plan_feature_limit') ?>" class="btn btn-primary disabled">
                            <i class="fa fa-fw fa-sm fa-plus"></i> <?= l('campaigns.create') ?>
                        </button>
                    <?php else: ?>
                        <button type="button" data-toggle="modal" data-target="#create_campaign_modal" class="btn btn-primary"><i class="fa fa-fw fa-sm fa-plus"></i> <?= l('campaigns.create') ?></button>
                    <?php endif ?>
                </div>

                <div class="ml-3">
                    <div class="dropdown">
                        <button type="button" class="btn <?= count($data->filters->get) ? 'btn-outline-primary' : 'btn-outline-secondary' ?> filters-button dropdown-toggle-simple" data-toggle="dropdown" data-boundary="viewport"><i class="fa fa-fw fa-sm fa-filter"></i></button>

                        <div class="dropdown-menu dropdown-menu-right filters-dropdown">
                            <div class="dropdown-header d-flex justify-content-between">
                                <span class="h6 m-0"><?= l('global.filters.header') ?></span>

                                <?php if(count($data->filters->get)): ?>
                                    <a href="<?= url('campaigns') ?>" class="text-muted"><?= l('global.filters.reset') ?></a>
                                <?php endif ?>
                            </div>

                            <div class="dropdown-divider"></div>

                            <form action="" method="get" role="form">
                                <div class="form-group px-4">
                                    <label for="filters_search" class="small"><?= l('global.filters.search') ?></label>
                                    <input type="search" name="search" id="filters_search" class="form-control form-control-sm" value="<?= $data->filters->search ?>" />
                                </div>

                                <div class="form-group px-4">
                                    <label for="filters_search_by" class="small"><?= l('global.filters.search_by') ?></label>
                                    <select name="search_by" id="filters_search_by" class="form-control form-control-sm">
                                        <option value="name" <?= $data->filters->search_by == 'name' ? 'selected="selected"' : null ?>><?= l('campaigns.input.name') ?></option>
                                        <option value="domain" <?= $data->filters->search_by == 'domain' ? 'selected="selected"' : null ?>><?= l('campaigns.input.domain') ?></option>
                                    </select>
                                </div>

                                <div class="form-group px-4">
                                    <label for="filters_is_enabled" class="small"><?= l('global.filters.status') ?></label>
                                    <select name="is_enabled" id="filters_is_enabled" class="form-control form-control-sm">
                                        <option value=""><?= l('global.filters.all') ?></option>
                                        <option value="1" <?= isset($data->filters->filters['is_enabled']) && $data->filters->filters['is_enabled'] == '1' ? 'selected="selected"' : null ?>><?= l('global.active') ?></option>
                                        <option value="0" <?= isset($data->filters->filters['is_enabled']) && $data->filters->filters['is_enabled'] == '0' ? 'selected="selected"' : null ?>><?= l('global.disabled') ?></option>
                                    </select>
                                </div>

                                <div class="form-group px-4">
                                    <label for="filters_order_by" class="small"><?= l('global.filters.order_by') ?></label>
                                    <select name="order_by" id="filters_order_by" class="form-control form-control-sm">
                                        <option value="datetime" <?= $data->filters->order_by == 'datetime' ? 'selected="selected"' : null ?>><?= l('global.filters.order_by_datetime') ?></option>
                                        <option value="last_datetime" <?= $data->filters->order_by == 'last_datetime' ? 'selected="selected"' : null ?>><?= l('global.filters.order_by_last_datetime') ?></option>
                                        <option value="name" <?= $data->filters->order_by == 'name' ? 'selected="selected"' : null ?>><?= l('campaigns.input.name') ?></option>
                                    </select>
                                </div>

                                <div class="form-group px-4">
                                    <label for="filters_order_type" class="small"><?= l('global.filters.order_type') ?></label>
                                    <select name="order_type" id="filters_order_type" class="form-control form-control-sm">
                                        <option value="ASC" <?= $data->filters->order_type == 'ASC' ? 'selected="selected"' : null ?>><?= l('global.filters.order_type_asc') ?></option>
                                        <option value="DESC" <?= $data->filters->order_type == 'DESC' ? 'selected="selected"' : null ?>><?= l('global.filters.order_type_desc') ?></option>
                                    </select>
                                </div>

                                <div class="form-group px-4">
                                    <label for="filters_results_per_page" class="small"><?= l('global.filters.results_per_page') ?></label>
                                    <select name="results_per_page" id="filters_results_per_page" class="form-control form-control-sm">
                                        <?php foreach($data->filters->allowed_results_per_page as $key): ?>
                                            <option value="<?= $key ?>" <?= $data->filters->results_per_page == $key ? 'selected="selected"' : null ?>><?= $key ?></option>
                                        <?php endforeach ?>
                                    </select>
                                </div>

                                <div class="form-group px-4 mt-4">
                                    <button type="submit" name="submit" class="btn btn-sm btn-primary btn-block"><?= l('global.submit') ?></button>
                                </div>
                            </form>

                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
</header>

<section class="container pt-5">

    <?= \Altum\Alerts::output_alerts() ?>

    <?php if(count($data->campaigns)): ?>
        <div class="table-responsive table-custom-container mt-3">
            <table class="table table-custom">
                <thead>
                <tr>
                    <th><?= l('campaigns.table.campaign') ?></th>
                    <th class="d-none d-md-table-cell"></th>
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
                            <span class="mr-2" data-toggle="tooltip" data-html="true" title="<?= sprintf(l('global.datetime_tooltip'), '<br />' . \Altum\Date::get($row->datetime, 2) . '<br /><small>' . \Altum\Date::get($row->datetime, 3) . '</small>') ?>">
                                <i class="fa fa-fw fa-calendar text-muted"></i>
                            </span>

                            <span class="mr-2" data-toggle="tooltip" data-html="true" title="<?= sprintf(l('global.last_datetime_tooltip'), ($row->last_datetime ? '<br />' . \Altum\Date::get($row->last_datetime, 2) . '<br /><small>' . \Altum\Date::get($row->last_datetime, 3) . '</small>' : '-')) ?>">
                                <i class="fa fa-fw fa-history text-muted"></i>
                            </span>
                        </td>
                        

                    <td class="text-nowrap min-width-300 text-right">

                                <a href="<?= url('campaign/' . $row->campaign_id) ?>" class="btn btn-outline-secondary border-none mr-1" data-toggle="tooltip" title="" data-original-title="Araçlar">
                                    <svg class="svg-inline--fa fa-pencil-alt fa-w-16 fa-fw fa-sm mr-1" aria-hidden="true" focusable="false" data-prefix="fa" data-icon="pencil-alt" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" data-fa-i2svg=""><<path fill="currentColor" d="M224 512c35.32 0 63.97-28.65 63.97-64H160.03c0 35.35 28.65 64 63.97 64zm215.39-149.71c-19.32-20.76-55.47-51.99-55.47-154.29 0-77.7-54.48-139.9-127.94-155.16V32c0-17.67-14.32-32-31.98-32s-31.98 14.33-31.98 32v20.84C118.56 68.1 64.08 130.3 64.08 208c0 102.3-36.15 133.53-55.47 154.29-6 6.45-8.66 14.16-8.61 21.71.11 16.4 12.98 32 32.1 32h383.8c19.12 0 32-15.6 32.1-32 .05-7.55-2.61-15.27-8.61-21.71z"></path></svg> Araçlar
                                </a>
                           

                                <button href="javascript:void(0)" 
                                        data-toggle="modal"
                                        data-target="#campaign_pixel_key"
                                        data-pixel-key="<?= $row->pixel_key ?>"
                                        data-campaign-id="<?= $row->campaign_id ?>" class="btn btn-outline-secondary border-none mr-1" title="" data-original-title="<?= l('global.delete') ?>" aria-describedby="tooltip737308">
                                <svg class="svg-inline--fa fa-pencil-alt fa-w-16 fa-fw"  aria-hidden="true" focusable="false" data-prefix="fa" data-icon="code" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 640 512" data-fa-i2svg=""><path fill="currentColor" d="M278.9 511.5l-61-17.7c-6.4-1.8-10-8.5-8.2-14.9L346.2 8.7c1.8-6.4 8.5-10 14.9-8.2l61 17.7c6.4 1.8 10 8.5 8.2 14.9L293.8 503.3c-1.9 6.4-8.5 10.1-14.9 8.2zm-114-112.2l43.5-46.4c4.6-4.9 4.3-12.7-.8-17.2L117 256l90.6-79.7c5.1-4.5 5.5-12.3.8-17.2l-43.5-46.4c-4.5-4.8-12.1-5.1-17-.5L3.8 247.2c-5.1 4.7-5.1 12.8 0 17.5l144.1 135.1c4.9 4.6 12.5 4.4 17-.5zm327.2.6l144.1-135.1c5.1-4.7 5.1-12.8 0-17.5L492.1 112.1c-4.8-4.5-12.4-4.3-17 .5L431.6 159c-4.6 4.9-4.3 12.7.8 17.2L523 256l-90.6 79.7c-5.1 4.5-5.5 12.3-.8 17.2l43.5 46.4c4.5 4.9 12.1 5.1 17 .6z"></path></svg> Pixel Kodu
                            </button>

                              

                                <a href="javascript:void(0)" data-toggle="modal" data-target="#update_campaign" data-campaign-id="<?= $row->campaign_id ?>" data-name="<?= $row->name ?>" data-domain="<?= $row->domain ?>" data-include-subdomains="<?= (bool) $row->include_subdomains ?>" class="btn btn-outline-secondary border-none mr-1" data-modal-toggle="tooltip" title="" data-original-title="<?= l('global.edit') ?>">
                                <svg class="svg-inline--fa fa-pencil-alt fa-w-16 fa-fw" aria-hidden="true" focusable="false" data-prefix="fa" data-icon="pencil-alt" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" data-fa-i2svg=""><path fill="currentColor" d="M497.9 142.1l-46.1 46.1c-4.7 4.7-12.3 4.7-17 0l-111-111c-4.7-4.7-4.7-12.3 0-17l46.1-46.1c18.7-18.7 49.1-18.7 67.9 0l60.1 60.1c18.8 18.7 18.8 49.1 0 67.9zM284.2 99.8L21.6 362.4.4 483.9c-2.9 16.4 11.4 30.6 27.8 27.8l121.5-21.3 262.6-262.6c4.7-4.7 4.7-12.3 0-17l-111-111c-4.8-4.7-12.4-4.7-17.1 0zM124.1 339.9c-5.5-5.5-5.5-14.3 0-19.8l154-154c5.5-5.5 14.3-5.5 19.8 0s5.5 14.3 0 19.8l-154 154c-5.5 5.5-14.3 5.5-19.8 0zM88 424h48v36.3l-64.5 11.3-31.1-31.1L51.7 376H88v48z"></path></svg><!-- <i class="fa fa-fw fa-md fa-pencil-alt"></i> -->
                            </a>

                            <button style="display: none;" href="javascript:void(0)" data-toggle="modal" data-target="#campaign_delete_modal" data-campaign-id="<?= $row->campaign_id ?>" data-resource-name="<?= $row->name ?>" class="btn btn-outline-danger mr-1" title="" data-original-title="<?= l('global.delete') ?>" aria-describedby="tooltip737308">
                                <svg class="svg-inline--fa fa-times fa-w-11 fa-fw" aria-hidden="true" focusable="false" data-prefix="fa" data-icon="times" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 352 512" data-fa-i2svg=""><path fill="currentColor" d="M242.72 256l100.07-100.07c12.28-12.28 12.28-32.19 0-44.48l-22.24-22.24c-12.28-12.28-32.19-12.28-44.48 0L176 189.28 75.93 89.21c-12.28-12.28-32.19-12.28-44.48 0L9.21 111.45c-12.28 12.28-12.28 32.19 0 44.48L109.28 256 9.21 356.07c-12.28 12.28-12.28 32.19 0 44.48l22.24 22.24c12.28 12.28 32.2 12.28 44.48 0L176 322.72l100.07 100.07c12.28 12.28 32.2 12.28 44.48 0l22.24-22.24c12.28-12.28 12.28-32.19 0-44.48L242.72 256z"></path></svg><!-- <i class="fa fa-fw fa-md fa-times"></i> -->
                            </button>
                        </td>

                        <td style="display: none;">
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

                </tbody>
            </table>
        </div>

        <div class="mt-3"><?= $data->pagination ?></div>

    <?php else: ?>

        <div class="d-flex flex-column align-items-center justify-content-center py-3">
            <img src="<?= ASSETS_FULL_URL . 'images/no_rows.svg' ?>" class="col-10 col-md-7 col-lg-4 mb-3" alt="<?= l('global.no_data') ?>" />
            <h2 class="h4 text-muted"><?= l('global.no_data') ?></h2>
            <p class="text-muted"><?= l('campaigns.no_data') ?></a></p>
        </div>

    <?php endif ?>

</section>

<?php \Altum\Event::add_content(include_view(THEME_PATH . 'views/campaign/create_campaign_modal.php'), 'modals'); ?>
<?php \Altum\Event::add_content(include_view(THEME_PATH . 'views/campaign/campaign_pixel_key_modal.php'), 'modals'); ?>
<?php \Altum\Event::add_content(include_view(THEME_PATH . 'views/partials/duplicate_modal.php', ['modal_id' => 'campaign_duplicate_modal', 'resource_id' => 'campaign_id', 'path' => 'campaign/duplicate']), 'modals'); ?>
<?php \Altum\Event::add_content(include_view(THEME_PATH . 'views/campaign/update_campaign_modal.php'), 'modals'); ?>
<?php \Altum\Event::add_content(include_view(THEME_PATH . 'views/campaign/custom_branding_campaign_modal.php'), 'modals'); ?>
<?php \Altum\Event::add_content(include_view(THEME_PATH . 'views/partials/universal_delete_modal_form.php', [
    'name' => 'campaign',
    'resource_id' => 'campaign_id',
    'has_dynamic_resource_name' => true,
    'path' => 'campaign/delete'
]), 'modals'); ?>
