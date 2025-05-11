<?php defined('ALTUMCODE') || die() ?>

<div class="container">
    <nav aria-label="breadcrumb">
        <ol class="custom-breadcrumbs small">
            <li><a href="<?= url() ?>"><?= l('index.breadcrumb') ?></a> <i class="fa fa-fw fa-angle-right"></i></li>
            
            <li class="active" aria-current="page"><?= $data->page->title ?></li>
        </ol>
    </nav>

    <div class="card">
        <div class="card-body">
            <div class="d-flex flex-column flex-md-row align-items-md-center justify-content-md-between">
                <h1 class="h3 mb-1"><?= $data->page->title ?></h1>

                <div class="d-print-none col-auto p-0 d-flex align-items-center">
                    <button type="button" class="btn btn-sm btn-outline-secondary" onclick="window.print()"><i class="fa fa-fw fa-sm fa-print"></i> <?= l('page.print') ?></button>
                </div>
            </div>

            <p class="small text-muted">

                

                <span><?= sprintf(l('page.total_views'), nr($data->page->total_views)) ?></span>

                <?php $estimated_reading_time = string_estimate_reading_time($data->page->content) ?>
                <?php if($estimated_reading_time->minutes > 0 || $estimated_reading_time->seconds > 0): ?>
                    <span>|
                <?= $estimated_reading_time->minutes ? sprintf(l('page.estimated_reading_time'), $estimated_reading_time->minutes . ' ' . l('global.date.minutes')) : null ?>
                        <?= $estimated_reading_time->minutes == 0 && $estimated_reading_time->seconds ? sprintf(l('page.estimated_reading_time'), $estimated_reading_time->seconds . ' ' . l('global.date.seconds')) : null ?>
            </span>
                <?php endif ?>
            </p>

            <p><?= $data->page->description ?></p>

            <?= nl2br($data->page->content) ?>

        </div>
    </div>
</div>
