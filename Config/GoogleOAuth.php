<?php

namespace Config;

use CodeIgniter\Config\BaseConfig;

class GoogleOAuth extends BaseConfig
{
    public $clientID = 'YOUR_GOOGLE_CLIENT_ID';
    public $clientSecret = 'YOUR_GOOGLE_CLIENT_SECRET';
    public $redirectUri = 'http://your-domain.com/auth/googleCallback';
    public $scopes = [
        'email',
        'profile',
    ];
}
