<?php

namespace Controllers;

use Arrilot\DotEnv\DotEnv;

/**
 * Created by Miguel Pazo <https://miguelpazo.com>.
 */
class IndexController extends ParentController
{
    public function __construct()
    {
        parent::__construct();
    }

    public function run($vars = null)
    {
        $oClient = $this->getClient();

        $_SESSION['state'] = $oClient->getState();

        echo $this->blade->view()
            ->make('index')
            ->with('url', $oClient->getLoginUrl())
            ->render();
    }

    public function logout()
    {
        session_destroy();

        $oClient = $this->getClient();
        $logout = $oClient->getLogoutUri(DotEnv::get('BASE_URL'));

        header('Location: ' . $logout);
        exit();
    }
}