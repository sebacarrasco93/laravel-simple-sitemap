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
    | Exceptions
    |--------------------------------------------------------------------------
    |
    | This values are necessary.
    | This is a way to you know what is wrong with your sitemap.
    |
    | For example, you can define your own exceptions and notify.
    |
    */

    'exceptions' => [
        'without_latest_update' => new \Exception('The latest update is required'),
    ],
];
