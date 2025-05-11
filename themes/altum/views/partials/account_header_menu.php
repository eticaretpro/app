<?php defined('ALTUMCODE') || die() ?>



<?php ob_start() ?>
<script>
    document.querySelector('select[name="account_header_menu"]').addEventListener('change', event => {
        window.location = document.querySelector('select[name="account_header_menu"]').value;
    })
</script>
<?php \Altum\Event::add_content(ob_get_clean(), 'javascript') ?>


