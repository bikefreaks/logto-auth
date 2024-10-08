<?php

// config for bikefreaks/LogtoAuth
return [
    'endpoint' => env('LOG_TO_ENDPOINT'),
    'app_id' => env('LOG_TO_APP_ID'),
    'app_secret' => env('LOG_TO_APP_SECRET'),
    'lee_way' => env('LOG_TO_LEE_WAY', 15),
    'user_id_field' => env('LOG_TO_USER_ID_FIELD', 'logto_id'),
    'save_phone' => env('LOG_TO_SAVE_PHONE', false),
];
