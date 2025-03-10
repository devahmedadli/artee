<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Moyasar API Key
    |--------------------------------------------------------------------------
    |
    | Don't forget to set this in your .env file, as it will be used to contact
    | Moyasar servers
    |
    |
    */

    'secret_key' => env('MOYASAR_SECRET_KEY'),


    /*
    |--------------------------------------------------------------------------
    | Moyasar Publishable API Key
    |--------------------------------------------------------------------------
    |
    | This key is used for payment forms on the frontend
    |
    |
    |
    */

    'publishable_key' => env('MOYASAR_PUBLISHABLE_KEY'),

];
