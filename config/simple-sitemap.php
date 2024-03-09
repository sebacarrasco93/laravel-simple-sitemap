<?php

return [
    /*
    |--------------------------------------------------------------------------
    | Default Frequency
    |--------------------------------------------------------------------------
    |
    | This value is the default frequency for the sitemap,
    | when your model does not have a frequency attribute or value.
    |
    | Supported values: always, hourly, daily, weekly, monthly, yearly, never
    |
    */

    'default_frequency' => 'monthly',

    /*
    |--------------------------------------------------------------------------
    | Default Priority
    |--------------------------------------------------------------------------
    |
    | This value is the default priority for the sitemap,
    | when your model does not have a frequency attribute or value.
    |
    | Suppported values: from 0.0 to 1.0
    |
    */

    'default_priority' => '0.50',

    /*
    |--------------------------------------------------------------------------
    | Last update
    |--------------------------------------------------------------------------
    |
    | This value is the default last update
    | If you want to get considered by Google, you need to specify
    |
    | Suppported values: from 0.0 to 1.0
    |
    */

    'default_last_update' => '0.50',
];
