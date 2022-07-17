<?php

namespace app\services\documents;

use app\models\forms\AdminLoginForm;
use app\models\User;

class AdminLoginService
{
    public function adminLogin(AdminLoginForm $adminLoginForm)
    {
        $adminInfo = User::findByUsername('admin');

        return !($adminInfo->username !== $adminLoginForm->username || $adminInfo->password !==
            $adminLoginForm->password);
    }
}

