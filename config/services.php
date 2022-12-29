<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Third Party Services
    |--------------------------------------------------------------------------
    |
    | This file is for storing the credentials for third party services such
    | as Stripe, Mailgun, SparkPost and others. This file provides a sane
    | default location for this type of information, allowing packages
    | to have a conventional place to find your various credentials.
    |
    */

    'mailgun' => [
        'domain' => env('MAILGUN_DOMAIN'),
        'secret' => env('MAILGUN_SECRET'),
    ],

    'ses' => [
        'key' => env('SES_KEY'),
        'secret' => env('SES_SECRET'),
        'region' => 'us-east-1',
    ],

    'sparkpost' => [
        'secret' => env('SPARKPOST_SECRET'),
    ],

    'stripe' => [
        'model' => \App\Application\Model\User::class,
        'key' => env('STRIPE_KEY'),
        'secret' => env('STRIPE_SECRET'),
    ],
    // 'facebook' => [    // Meduo 
    //     'client_id' => 2235820886562929,
    //     'client_secret' => '188082c73440a794b4fe0c379fc5ba2c',
    //     'redirect' => 'https://meduo.soloky.com/social/callback/facebook',
    //     // 'redirect' => 'http://localhost/meduo-laravel/social/callback/facebook'  //Local
    // ],

    'facebook' => [  // IGTS 
        'client_id' => 983505582214482,
        'client_secret' => '5a489151fad3942579e5679e235778f4',
        // 'redirect' => 'https://meduo.soloky.com/social/callback/facebook',
        // 'redirect' => 'http://localhost/meduo-laravel/social/callback/facebook'  //Local
        // 'redirect' => 'https://stage.igtsservice.com/social/callback/facebook'  //Stage
        'redirect' => 'https://igtsservice.com/social/callback/facebook'  //live
    ],


    'twitter' => [
        'client_id' => 'sYtsMeYWahkfRwhNjB8Mf5HTH',
        'client_secret' => 'dOdnn9DA21ma5UBBZnN3BJK5QQv7VfrmDifBIwPZuDCPQN7BvX',
        // 'redirect' => 'https://meduo.soloky.com/social/callback/twitter',
        'redirect' => 'http://localhost:8000/social/callback/twitter'  //Local
        // 'redirect' => 'https://stage.meduo.net/social/callback/twitter'  //Stage
        // 'redirect' => 'https://igtsservice.com/social/callback/twitter'  //live
    ],
    'google' => [
        'client_id' => '265784778176-ronrc5gi8qnu2atk7bun6liho5eoq63m.apps.googleusercontent.com',
        'client_secret' => 'FEEmNpPkgaged2uxVEScK22t',
        // 'redirect' => 'https://meduo.soloky.com/social/callback/google',
        // 'redirect' => 'http://localhost/meduo-laravel/social/callback/google'  //Local
        // 'redirect' => 'https://stage.igtsservice.com/social/callback/google'  //Stage
        'redirect' => 'https://igtsservice.com/social/callback/google'  //live
    ],
    'linkedin' => [
        'client_id' => '78hzk7v8dl4nh4',
        'client_secret' => 'tC6Og4aSkpWPmWDO',
        // 'redirect' => 'https://meduo.soloky.com/social/callback/linkedin',
        // 'redirect' => 'http://localhost/meduo-laravel/social/callback/linkedin',  //Local
        // 'redirect' => 'https://stage.meduo.net/social/callback/linkedin'  //Stage
        'redirect' => 'https://meduo.net/social/callback/linkedin'  //live
    ],

    'recaptcha' => [
        'key' => env('GOOGLE_RECAPTCHA_KEY'),
        'secret' => env('GOOGLE_RECAPTCHA_SECRET'),
    ],
        

];
