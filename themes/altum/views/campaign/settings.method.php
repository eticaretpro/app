<?php defined('ALTUMCODE') || die() ?>

<div class="row mt-5">
    <div class="col-12 col-lg mb-3 mb-lg-0">
        <h2 class="h3 m-0"><?= l('campaign.notifications.header') ?></h2>
    </div>

    <div class="col-12 col-lg-auto d-flex">
        <div>
            <?php if($this->user->plan_settings->notifications_limit != -1 && $data->notifications_total >= $this->user->plan_settings->notifications_limit): ?>
                <button type="button" data-toggle="tooltip" title="<?= l('global.info_message.plan_feature_limit') ?>" class="btn btn-primary disabled">
                    <i class="fa fa-fw fa-sm fa-plus"></i> <?= l('notifications.create') ?>
                </button>
            <?php else: ?>
                <a href="<?= url('notification-create/' . $data->campaign->campaign_id) ?>" class="btn btn-primary"><i class="fa fa-fw fa-sm fa-plus"></i> <?= l('notifications.create') ?></a>
            <?php endif ?>
        </div>

        
    </div>
</div>
<style>
    .notification-avatar {
    background: var(--primary-100);
    width: 50px;
    height: 50px;
    min-width: 50px;
    min-height: 50px;
    color: #fa2682;
    display: flex;
    align-items: center;
    justify-content: center;
}</style>

<?php if(count($data->notifications)): ?>
    <div class="table-responsive table-custom-container mt-3">
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
                        <div class="d-flex">
                            <div class="notification-avatar rounded-circle mr-3">
                                 <i class="<?= l('notification.' . mb_strtolower($row->type) . '.icon') ?>"></i>
                            </div>

                            <div class="d-flex flex-column">
                            <a href="<?= url('notification/' . $row->notification_id) ?>"><?= $row->name ?></a>
 <div class="text-muted">
                               <?= l('notification.' . mb_strtolower($row->type) . '.name') ?>
                            </div>
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


                    <td class="text-nowrap min-width-300 text-right">
                           
                           <a href="<?= url('notification/' . $row->notification_id . '/statistics') ?>" class="btn btn-outline-secondary border-none mr-1" data-toggle="tooltip" title="" data-original-title="<?= l('notification.statistics.link') ?>">
                                    <i class="fa fa-fw fa-sm fa-chart-bar fa-w-16 fa-fw"></i>
                                </a>


                                <a href="<?= url('notification/' . $row->notification_id) ?>" class="btn btn-outline-secondary border-none mr-1" data-toggle="tooltip" title="" data-original-title="<?= l('global.edit') ?>">
                                    <svg class="svg-inline--fa fa-pencil-alt fa-w-16 fa-fw fa-sm mr-1" aria-hidden="true" focusable="false" data-prefix="fa" data-icon="pencil-alt" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" data-fa-i2svg=""><path fill="currentColor" d="M497.9 142.1l-46.1 46.1c-4.7 4.7-12.3 4.7-17 0l-111-111c-4.7-4.7-4.7-12.3 0-17l46.1-46.1c18.7-18.7 49.1-18.7 67.9 0l60.1 60.1c18.8 18.7 18.8 49.1 0 67.9zM284.2 99.8L21.6 362.4.4 483.9c-2.9 16.4 11.4 30.6 27.8 27.8l121.5-21.3 262.6-262.6c4.7-4.7 4.7-12.3 0-17l-111-111c-4.8-4.7-12.4-4.7-17.1 0zM124.1 339.9c-5.5-5.5-5.5-14.3 0-19.8l154-154c5.5-5.5 14.3-5.5 19.8 0s5.5 14.3 0 19.8l-154 154c-5.5 5.5-14.3 5.5-19.8 0zM88 424h48v36.3l-64.5 11.3-31.1-31.1L51.7 376H88v48z"></path></svg><!-- <i class="fa fa-fw fa-sm fa-pencil-alt mr-1"></i> -->
                                </a>
                        

                        <a  href="#" data-toggle="modal" data-target="#notification_duplicate_modal" data-notification-id="<?= $row->notification_id ?>" class="btn btn-outline-secondary border-none mr-1"  data-original-title="<?= l('global.edit') ?>">
                                   <i class="fa fa-fw fa-sm fa-copy fa-w-16 fa-fw"></i>
                                </a>

                                

                            <button href="javascript:void(0)" data-toggle="modal" data-target="#notification_delete_modal" data-notification-id="<?= $row->notification_id ?>" data-resource-name="<?= $row->name ?>" class="btn btn-outline-danger mr-1" title="" data-original-title="Sil" aria-describedby="tooltip737308">
                                <svg class="svg-inline--fa fa-times fa-w-11 fa-fw" aria-hidden="true" focusable="false" data-prefix="fa" data-icon="times" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 352 512" data-fa-i2svg=""><path fill="currentColor" d="M242.72 256l100.07-100.07c12.28-12.28 12.28-32.19 0-44.48l-22.24-22.24c-12.28-12.28-32.19-12.28-44.48 0L176 189.28 75.93 89.21c-12.28-12.28-32.19-12.28-44.48 0L9.21 111.45c-12.28 12.28-12.28 32.19 0 44.48L109.28 256 9.21 356.07c-12.28 12.28-12.28 32.19 0 44.48l22.24 22.24c12.28 12.28 32.2 12.28 44.48 0L176 322.72l100.07 100.07c12.28 12.28 32.2 12.28 44.48 0l22.24-22.24c12.28-12.28 12.28-32.19 0-44.48L242.72 256z"></path></svg><!-- <i class="fa fa-fw fa-md fa-times"></i> -->
                            </button>
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
        <p class="text-muted"><?= l('notifications.no_data') ?></a></p>
    </div>
<?php endif ?>
