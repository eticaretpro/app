<?php defined('ALTUMCODE') || die() ?>

<div class="d-flex flex-column flex-md-row justify-content-between mb-4">
    <h1 class="h3 mb-3 mb-md-0"><i class="fa fa-fw fa-xs fa-users text-primary-900 mr-2"></i> <?= l('admin_users.header') ?></h1>

    <div class="d-flex position-relative">
        <div class="">
            <a href="<?= url('admin/user-create') ?>" class="btn btn-primary"><i class="fa fa-fw fa-plus-circle"></i> <?= l('admin_user_create.menu') ?></a>
        </div>

        <div class="ml-3">
            <div class="dropdown">
                <button type="button" class="btn btn-gray-300 dropdown-toggle-simple" data-toggle="dropdown" data-boundary="viewport" data-tooltip title="<?= l('global.export') ?>">
                    <i class="fa fa-fw fa-sm fa-download"></i>
                </button>

                <div class="dropdown-menu dropdown-menu-right d-print-none">
                    <a href="<?= url('admin/users?' . $data->filters->get_get() . '&export=csv') ?>" target="_blank" class="dropdown-item">
                        <i class="fa fa-fw fa-sm fa-file-csv mr-1"></i> <?= sprintf(l('global.export_to'), 'CSV') ?>
                    </a>
                    <a href="<?= url('admin/users?' . $data->filters->get_get() . '&export=json') ?>" target="_blank" class="dropdown-item">
                        <i class="fa fa-fw fa-sm fa-file-code mr-1"></i> <?= sprintf(l('global.export_to'), 'JSON') ?>
                    </a>
                    <a href="#" onclick="window.print();return false;" class="dropdown-item">
                        <i class="fa fa-fw fa-sm fa-file-pdf mr-1"></i> <?= sprintf(l('global.export_to'), 'PDF') ?>
                    </a>
                </div>
            </div>
        </div>

        <div class="ml-3">
            <div class="dropdown">
                <button type="button" class="btn <?= count($data->filters->get) ? 'btn-secondary' : 'btn-gray-300' ?> filters-button dropdown-toggle-simple" data-toggle="dropdown" data-boundary="viewport" data-tooltip title="<?= l('global.filters.header') ?>">
                    <i class="fa fa-fw fa-sm fa-filter"></i>
                </button>

                <div class="dropdown-menu dropdown-menu-right filters-dropdown">
                    <div class="dropdown-header d-flex justify-content-between">
                        <span class="h6 m-0"><?= l('global.filters.header') ?></span>

                        <?php if(count($data->filters->get)): ?>
                            <a href="<?= url('admin/users') ?>" class="text-muted"><?= l('global.filters.reset') ?></a>
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
                                <option value="name" <?= $data->filters->search_by == 'name' ? 'selected="selected"' : null ?>><?= l('admin_users.main.name') ?></option>
                                <option value="email" <?= $data->filters->search_by == 'email' ? 'selected="selected"' : null ?>><?= l('admin_users.main.email') ?></option>
                            </select>
                        </div>

                        <div class="form-group px-4">
                            <label for="filters_type" class="small"><?= l('admin_users.main.type') ?></label>
                            <select name="type" id="filters_type" class="form-control form-control-sm">
                                <option value=""><?= l('global.filters.all') ?></option>
                                <option value="0" <?= isset($data->filters->filters['type']) && $data->filters->filters['type'] == '0' ? 'selected="selected"' : null ?>><?= l('admin_users.main.type_user') ?></option>
                                <option value="1" <?= isset($data->filters->filters['type']) && $data->filters->filters['type'] == '1' ? 'selected="selected"' : null ?>><?= l('admin_users.main.type_admin') ?></option>
                            </select>
                        </div>

                        <div class="form-group px-4">
                            <label for="filters_status" class="small"><?= l('admin_users.main.status') ?></label>
                            <select name="status" id="filters_status" class="form-control form-control-sm">
                                <option value=""><?= l('global.filters.all') ?></option>
                                <option value="1" <?= isset($data->filters->filters['status']) && $data->filters->filters['status'] == '1' ? 'selected="selected"' : null ?>><?= l('admin_users.main.status_active') ?></option>
                                <option value="0" <?= isset($data->filters->filters['status']) && $data->filters->filters['status'] == '0' ? 'selected="selected"' : null ?>><?= l('admin_users.main.status_unconfirmed') ?></option>
                                <option value="2" <?= isset($data->filters->filters['status']) && $data->filters->filters['status'] == '2' ? 'selected="selected"' : null ?>><?= l('admin_users.main.status_disabled') ?></option>
                            </select>
                        </div>

                        <div class="form-group px-4">
                            <label for="filters_source" class="small"><?= l('admin_users.main.source') ?></label>
                            <select name="source" id="filters_source" class="form-control form-control-sm">
                                <option value=""><?= l('global.filters.all') ?></option>
                                <?php foreach(['direct', 'admin_create', 'admin_api_create', 'facebook', 'twitter', 'discord', 'google'] as $source): ?>
                                <option value="<?= $source ?>" <?= isset($data->filters->filters['source']) && $data->filters->filters['source'] == $source ? 'selected="selected"' : null ?>><?= l('admin_users.main.source.' . $source) ?></option>
                                <?php endforeach ?>
                            </select>
                        </div>

                        <div class="form-group px-4">
                            <label for="filters_plan_id" class="small"><?= l('admin_users.main.plan_id') ?></label>
                            <select name="plan_id" id="filters_plan_id" class="form-control form-control-sm">
                                <option value=""><?= l('global.filters.all') ?></option>
                                <?php foreach($data->plans as $plan): ?>
                                    <option value="<?= $plan->plan_id ?>" <?= isset($data->filters->filters['plan_id']) && $data->filters->filters['plan_id'] == $plan->plan_id ? 'selected="selected"' : null ?>><?= $plan->name ?></option>
                                <?php endforeach ?>
                            </select>
                        </div>

                        <div class="form-group px-4">
                            <label for="filters_country" class="small"><?= l('admin_users.main.country') ?></label>
                            <select name="country" id="filters_country" class="form-control form-control-sm">
                                <option value=""><?= l('global.filters.all') ?></option>
                                <?php foreach(get_countries_array() as $country => $country_name): ?>
                                    <option value="<?= $country ?>" <?= isset($data->filters->filters['country']) && $data->filters->filters['country'] == $country ? 'selected="selected"' : null ?>><?= $country_name ?></option>
                                <?php endforeach ?>
                            </select>
                        </div>

                        <div class="form-group px-4">
                            <label for="filters_order_by" class="small"><?= l('global.filters.order_by') ?></label>
                            <select name="order_by" id="filters_order_by" class="form-control form-control-sm">
                                <option value="datetime" <?= $data->filters->order_by == 'datetime' ? 'selected="selected"' : null ?>><?= l('admin_users.main.datetime') ?></option>
                                <option value="last_activity" <?= $data->filters->order_by == 'last_activity' ? 'selected="selected"' : null ?>><?= l('admin_users.main.last_activity') ?></option>
                                <option value="name" <?= $data->filters->order_by == 'name' ? 'selected="selected"' : null ?>><?= l('admin_users.main.name') ?></option>
                                <option value="email" <?= $data->filters->order_by == 'email' ? 'selected="selected"' : null ?>><?= l('admin_users.main.email') ?></option>
                                <option value="total_logins" <?= $data->filters->order_by == 'total_logins' ? 'selected="selected"' : null ?>><?= l('admin_users.main.total_logins') ?></option>
                                <option value="plan_expiration_date" <?= $data->filters->order_by == 'plan_expiration_date' ? 'selected="selected"' : null ?>><?= l('admin_users.main.plan_expiration_date') ?></option>
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

        <div class="ml-3">
            <button id="bulk_enable" type="button" class="btn btn-gray-300" data-toggle="tooltip" title="<?= l('global.bulk_actions') ?>"><i class="fa fa-fw fa-sm fa-list"></i></button>

            <div id="bulk_group" class="btn-group d-none" role="group">
                <div class="btn-group" role="group">
                    <button id="bulk_actions" type="button" class="btn btn-secondary dropdown-toggle" data-toggle="dropdown" data-boundary="viewport" aria-haspopup="true" aria-expanded="false">
                        <?= l('global.bulk_actions') ?> <span id="bulk_counter" class="d-none"></span>
                    </button>
                    <div class="dropdown-menu" aria-labelledby="bulk_actions">
                        <a href="#" class="dropdown-item" data-toggle="modal" data-target="#bulk_delete_modal"><?= l('global.delete') ?></a>
                    </div>
                </div>

                <button id="bulk_disable" type="button" class="btn btn-secondary" data-toggle="tooltip" title="<?= l('global.close') ?>"><i class="fa fa-fw fa-times"></i></button>
            </div>
        </div>

    </div>
</div>

<?= \Altum\Alerts::output_alerts() ?>

<form id="table" action="<?= SITE_URL . 'admin/users/bulk' ?>" method="post" role="form">
    <input type="hidden" name="token" value="<?= \Altum\Csrf::get() ?>" />
    <input type="hidden" name="type" value="" data-bulk-type />

    <div class="table-responsive table-custom-container">
        <table class="table table-custom">
            <thead>
            <tr>
                <th data-bulk-table class="d-none">
                    <div class="custom-control custom-checkbox">
                        <input id="bulk_select_all" type="checkbox" class="custom-control-input" />
                        <label class="custom-control-label" for="bulk_select_all"></label>
                    </div>
                </th>
                <th><?= l('admin_users.table.user') ?></th>
                <th><?= l('admin_users.main.status') ?></th>
                <th><?= l('admin_users.main.plan_id') ?></th>
                <th><?= l('admin_users.table.details') ?></th>
                <th></th>
            </tr>
            </thead>
            <tbody>
            <?php foreach($data->users as $row): ?>
                <?php //ALTUMCODE:DEMO if(DEMO) {$row->email = 'hidden@demo.com'; $row->name = 'hidden on demo';} ?>
                <tr>
                    <td data-bulk-table class="d-none">
                        <div class="custom-control custom-checkbox">
                            <input id="selected_user_id_<?= $row->user_id ?>" type="checkbox" class="custom-control-input" name="selected[]" value="<?= $row->user_id ?>" />
                            <label class="custom-control-label" for="selected_user_id_<?= $row->user_id ?>"></label>
                        </div>
                    </td>
                    <td class="text-nowrap">
                        <div class="d-flex">
                            <a href="<?= url('admin/user-view/' . $row->user_id) ?>">
                                <img src="<?= get_gravatar($row->email) ?>" class="user-avatar rounded-circle mr-3" alt="" />
                            </a>

                            <div class="d-flex flex-column">
                                <div>
                                    <a href="<?= url('admin/user-view/' . $row->user_id) ?>" <?= $row->type == 1 ? 'class="font-weight-bold" data-toggle="tooltip" title="' . l('admin_users.main.type_admin') . '"' : null ?>><?= $row->name ?></a>
                                </div>

                                <span class="text-muted"><?= $row->email ?></span>
                            </div>
                        </div>
                    </td>
                    <td class="text-nowrap">
                        <?php if($row->status == 0): ?>
                        <span class="badge badge-warning"><i class="fa fa-fw fa-sm fa-eye-slash"></i> <?= l('admin_users.main.status_unconfirmed') ?>
                            <?php elseif($row->status == 1): ?>
                        <span class="badge badge-success"><i class="fa fa-fw fa-sm fa-check"></i> <?= l('admin_users.main.status_active') ?>
                            <?php elseif($row->status == 2): ?>
                        <span class="badge badge-light"><i class="fa fa-fw fa-sm fa-times"></i> <?= l('admin_users.main.status_disabled') ?>
                            <?php endif ?>
                    </td>
                    <td class="text-nowrap">
                        <div class="d-flex flex-column">
                            <a href="<?= url('admin/plan-update/' . $row->plan_id) ?>"><?= $data->plans[$row->plan_id]->name ?></a>

                            <?php if($row->plan_id != 'free'): ?>
                                <div>
                                    <small class="text-muted" data-toggle="tooltip" title="<?= l('admin_users.main.plan_expiration_date') ?>"><?= \Altum\Date::get($row->plan_expiration_date, 1) ?></small>
                                </div>
                            <?php endif ?>
                        </div>
                    </td>
                    <td class="text-nowrap">
                        <div class="d-flex align-items-center">
                            <span class="mr-2" data-toggle="tooltip" title="<?= sprintf(l('admin_users.table.datetime'), \Altum\Date::get($row->datetime, 1)) ?>">
                                <i class="fa fa-fw fa-calendar text-muted"></i>
                            </span>

                            <span class="mr-2" data-toggle="tooltip" title="<?= l('admin_users.main.source.' . $row->source) ?>">
                                <i class="fa fa-fw fa-sign-in-alt text-muted"></i>
                            </span>

                            <span class="mr-2" data-toggle="tooltip" title="<?= sprintf(l('admin_users.table.last_activity'), ($row->last_activity ? \Altum\Date::get($row->last_activity, 1) : '-')) ?>">
                                <i class="fa fa-fw fa-history text-muted"></i>
                            </span>

                            <span class="mr-2" data-toggle="tooltip" title="<?= sprintf(l('admin_users.table.total_logins'), nr($row->total_logins)) ?>">
                                <i class="fa fa-fw fa-user-clock text-muted"></i>
                            </span>

                            <?php if($row->country): ?>
                                <img src="<?= ASSETS_FULL_URL . 'images/countries/' . mb_strtolower($row->country) . '.svg' ?>" class="img-fluid icon-favicon mr-2" data-toggle="tooltip" title="<?= get_country_from_country_code($row->country) ?>" />
                            <?php else: ?>
                                <span class="mr-2" data-toggle="tooltip" title="<?= l('admin_users.main.country_unknown') ?>">
                                    <i class="fa fa-fw fa-globe text-muted"></i>
                                </span>
                            <?php endif ?>
                        </div>
                    </td>
                    <td>
                        <div class="d-flex justify-content-end">
                            <?= include_view(THEME_PATH . 'views/admin/users/admin_user_dropdown_button.php', ['id' => $row->user_id, 'resource_name' => $row->name]) ?>
                        </div>
                    </td>
                </tr>
            <?php endforeach ?>
            </tbody>
        </table>
    </div>
</form>

<div class="mt-3"><?= $data->pagination ?></div>

<?php require THEME_PATH . 'views/admin/partials/js_bulk.php' ?>
<?php \Altum\Event::add_content(include_view(THEME_PATH . 'views/admin/users/user_login_modal.php'), 'modals'); ?>
<?php \Altum\Event::add_content(include_view(THEME_PATH . 'views/admin/partials/bulk_delete_modal.php'), 'modals'); ?>
<?php \Altum\Event::add_content(include_view(THEME_PATH . 'views/partials/universal_delete_modal_url.php', [
    'name' => 'user',
    'resource_id' => 'user_id',
    'has_dynamic_resource_name' => true,
    'path' => 'admin/users/delete/'
]), 'modals'); ?>
