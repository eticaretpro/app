<?php defined('ALTUMCODE') || die() ?>
<!DOCTYPE html>
<html lang="tr">
    <head>
        <title><?= \Altum\Title::get() ?></title>
        <base href="<?= SITE_URL; ?>">
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <style>
                        @media screen and (max-width: 991.98px){
            
            .navbar-main  {
    display: none !important;
}

 .footer {
    display: none !important;
}
            }
        </style>
        <?php if(\Altum\Meta::$description): ?>
            <meta name="description" content="<?= \Altum\Meta::$description ?>" />
        <?php endif ?>
        <?php if(\Altum\Meta::$keywords): ?>
            <meta name="keywords" content="<?= \Altum\Meta::$keywords ?>" />
        <?php endif ?>

        <?php if(\Altum\Meta::$open_graph['url']): ?>
            <!-- Open Graph / Facebook / Twitter -->
            <?php foreach(\Altum\Meta::$open_graph as $key => $value): ?>
                <?php if($value): ?>
                    <meta property="og:<?= $key ?>" content="<?= $value ?>" />
                    <meta property="twitter:<?= $key ?>" content="<?= $value ?>" />
                <?php endif ?>
            <?php endforeach ?>
        <?php endif ?>

        <?php if(!settings()->main->se_indexing): ?>
            <meta name="robots" content="noindex">
        <?php endif ?>

        <link rel="alternate" href="<?= SITE_URL . \Altum\Router::$original_request ?>" hreflang="x-default" />
        <?php if(count(\Altum\Language::$active_languages) > 1): ?>
            <?php foreach(\Altum\Language::$active_languages as $language_name => $language_code): ?>
                <?php if(settings()->main->default_language != $language_name): ?>
                    <link rel="alternate" href="<?= SITE_URL . $language_code . '/' . \Altum\Router::$original_request ?>" hreflang="<?= $language_code ?>" />
                <?php endif ?>
            <?php endforeach ?>
        <?php endif ?>

        <?php if(!empty(settings()->main->favicon)): ?>
            <link href="<?= UPLOADS_FULL_URL . 'main/' . settings()->main->favicon ?>" rel="shortcut icon" />
        <?php endif ?>

        <link href="<?= ASSETS_FULL_URL . 'css/' . \Altum\ThemeStyle::get_file() . '?v=' . PRODUCT_CODE ?>" id="css_theme_style" rel="stylesheet" media="screen,print">
        <?php foreach(['custom.css'] as $file): ?>
            <link href="<?= ASSETS_FULL_URL . 'css/' . $file . '?v=' . PRODUCT_CODE ?>" rel="stylesheet" media="screen,print">
        <?php endforeach ?>

        <?= \Altum\Event::get_content('head') ?>

        <?php if(!empty(settings()->custom->head_js)): ?>
            <?= settings()->custom->head_js ?>
        <?php endif ?>

        <?php if(!empty(settings()->custom->head_css)): ?>
            <style><?= settings()->custom->head_css ?></style>
        <?php endif ?>
    </head>

    <body class="<?= l('direction') == 'rtl' ? 'rtl' : null ?> <?= \Altum\Router::$controller_settings['body_white'] ? 'bg-white' : null ?> <?= \Altum\ThemeStyle::get() == 'dark' ? 'c_darkmode' : null ?>" data-theme-style="<?= \Altum\ThemeStyle::get() ?>">
        <?php //ALTUMCODE:DEMO if(DEMO) echo include_view(THEME_PATH . 'views/partials/ac_banner.php', ['demo_url' => 'https://66socialproof.com/demo/', 'product_name' => PRODUCT_NAME, 'product_url' => PRODUCT_URL]) ?>

        <?php require THEME_PATH . 'views/partials/admin_impersonate_user.php' ?>
        <?php require THEME_PATH . 'views/partials/team_delegate_access.php' ?>
        <?php require THEME_PATH . 'views/partials/announcements.php' ?>
        <?php require THEME_PATH . 'views/partials/cookie_consent.php' ?>

        <?= $this->views['menu'] ?>

        <?php require THEME_PATH . 'views/partials/ads_header.php' ?>

        <main>
            <?= $this->views['content'] ?>
        </main>


        <footer class="footer <?= \Altum\Router::$controller_key == 'index' ? 'm-0' : null ?>">
            <?= $this->views['footer'] ?>
        </footer>

        <?= \Altum\Event::get_content('modals') ?>

        <?php require THEME_PATH . 'views/partials/js_global_variables.php' ?>

        <?php foreach(['libraries/jquery.min.js', 'libraries/popper.min.js', 'libraries/bootstrap.min.js', 'custom.js', 'libraries/fontawesome.min.js', 'libraries/fontawesome-solid.min.js', 'libraries/fontawesome-brands.modified.js'] as $file): ?>
            <script src="<?= ASSETS_FULL_URL ?>js/<?= $file ?>?v=<?= PRODUCT_CODE ?>"></script>
        <?php endforeach ?>

        <?= \Altum\Event::get_content('javascript') ?>

        
        <script src="https://cdn.ckeditor.com/ckeditor5/41.2.1/classic/ckeditor.js"></script>
<script>


    ClassicEditor
        .create( document.querySelector( '#editor_html' ) )
        .catch( error => {
            console.error( error );
        } );

        ClassicEditor
        .create( document.querySelector( '#editor_css' ) )
        .catch( error => {
            console.error( error );
        } );

        ClassicEditor
        .create( document.querySelector( '#editor_js' ) )
        .catch( error => {
            console.error( error );
        } );
</script>
    </body>
</html>
