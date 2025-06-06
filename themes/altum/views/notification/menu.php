<?php defined('ALTUMCODE') || die() ?>

<ul class="mt-5 nav nav-custom">
    <?php if(in_array('settings', $data->notification->settings->enabled_methods)): ?>
        <li class="nav-item">
            <a href="<?= url('notification/' . $data->notification->notification_id . '/settings') ?>" class="nav-link <?= $data->method == 'settings' ? 'active' : null ?>">
                <i class="fa fa-fw fa-sm fa-cogs mr-1"></i> <?= l('notification.settings.link') ?>
            </a>
        </li>
    <?php endif ?>

    <?php if(in_array('statistics', $data->notification->settings->enabled_methods)): ?>
        <li class="nav-item" style="display: none;">
            <a href="<?= url('notification/' . $data->notification->notification_id . '/statistics') ?>" class="nav-link <?= $data->method == 'statistics' ? 'active' : null ?>">
                <i class="fa fa-fw fa-sm fa-chart-bar mr-1"></i> <?= l('notification.statistics.link') ?>
            </a>
        </li>
    <?php endif ?>

    <?php if(in_array('data', $data->notification->settings->enabled_methods)): ?>   
    <li class="nav-item">
        <a href="<?= url('notification/' . $data->notification->notification_id . '/data') ?>" class="nav-link <?= $data->method == 'data' ? 'active' : null ?>">
            <i class="fa fa-fw fa-sm fa-database mr-1"></i> <?= l('notification.data.link') ?>
        </a>
    </li>
     <?php endif ?>

</ul>
