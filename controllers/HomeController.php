<?php

namespace Controllers;

use Arrilot\DotEnv\DotEnv;

/**
 * Created by Miguel Pazo <https://miguelpazo.com>.
 */
class HomeController extends ParentController
{
    public function __construct()
    {
        parent::__construct();
    }

    public function run($vars = null)
    {
        $oUser = $_SESSION['oUser'];

        echo $this->blade->view()
            ->make('home')
            ->with('oUser', $oUser)
            ->with('logout', DotEnv::get('BASE_URL') . '/logout')
            ->render();
    }
}