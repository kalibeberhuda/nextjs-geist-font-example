<?php

namespace Config;

use CodeIgniter\Config\BaseConfig;

class Language extends BaseConfig
{
    public $defaultLocale = 'en';
    public $supportedLocales = ['en', 'id'];

    public $languageFiles = [
        'auth' => 'auth',
        'members' => 'members',
        'savings' => 'savings',
        'loans' => 'loans',
        'reports' => 'reports',
        'admin' => 'admin',
    ];
}
