<?php

namespace Controllers;

use Arrilot\DotEnv\DotEnv;

/**
 * Created by Miguel Pazo <https://miguelpazo.com>.
 */
class EndpointController extends ParentController
{
    public function __construct()
    {
        parent::__construct();
    }

    public function run($vars = null)
    {
        if (array_key_exists('error', $_GET)) {
            header('Location: ' . DotEnv::get('BASE_URL'));
            exit();
        }

        if (!array_key_exists('code', $_GET)) {
            header('Location: ' . DotEnv::get('BASE_URL'));
            exit();
        }

        if ($_GET['state'] != $_SESSION['state']) {
            header('Location: ' . DotEnv::get('BASE_URL'));
            exit();
        }

        $oClient = $this->getClient();
        $oTokens = $oClient->getTokens($_GET['code']);
        $userInfo = $oClient->getUserinfo($oTokens->access_token);

        $_SESSION['oUser'] = $userInfo;

        header('Location: ' . DotEnv::get('BASE_URL') . '/home');
        exit();
    }
}