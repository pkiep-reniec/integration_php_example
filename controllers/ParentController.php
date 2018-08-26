<?php

namespace Controllers;

use Arrilot\DotEnv\DotEnv;
use Philo\Blade\Blade;
use Reniec\Idaas\Constants\Constants;
use Reniec\Idaas\ReniecIdaasClient;

/**
 * Created by Miguel Pazo <http://miguelpazo.com>.
 */
class ParentController
{
    protected $blade;

    /**
     * ParentController constructor.
     */
    public function __construct()
    {
        DotEnv::load(__DIR__ . '/../.env.php');

        $views = __DIR__ . '/../resources/views';
        $cache = __DIR__ . '/../resources/cache';

        $this->blade = new Blade($views, $cache);
    }

    protected function getClient()
    {
        $oClient = new ReniecIdaasClient(__DIR__ . '/../config/reniec_idaas.json');
        $state = base64_encode(random_bytes(10));

        $oClient->setRedirectUri(DotEnv::get('BASE_URL') . '/auth-endpoint');
        $oClient->setState($state);

        $oClient->setAcr(Constants::ACR_ONE_FACTOR);

        $oClient->addScope(Constants::SCOPE_PROFILE);
        $oClient->addScope(Constants::SCOPE_EMAIL);
        $oClient->addScope(Constants::SCOPE_PHONE);

        return $oClient;
    }
}