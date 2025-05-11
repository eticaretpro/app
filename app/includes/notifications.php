<?php
/*
 * @copyright Copyright (c) 2023 AltumCode (https://altumcode.com/)
 *
 * This software is exclusively sold through https://altumcode.com/ by the AltumCode author.
 * Downloading this product from any other sources and running it without a proper license is illegal,
 *  except the official ones linked from https://altumcode.com/.
 */

$pro_notifications = \Altum\Plugin::is_active('pro-notifications') && file_exists(\Altum\Plugin::get('pro-notifications')->path . 'pro_notifications.php') ? include \Altum\Plugin::get('pro-notifications')->path . 'pro_notifications.php' : [];

/* Current available type of notifications and its defaults */
return array_merge(
    [
        


    ],

        $pro_notifications

);
