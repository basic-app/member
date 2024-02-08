<?php
/**
 * @author Basic App Dev Team <dev@basic-app.com>
 * @license MIT
 * @link http://basic-app.com
 */
namespace BasicApp\Member\Libraries;

use BasicApp\User\Models\UserModel;
use BasicApp\Member\UserInterface;
use Exception;
use BasicApp\Auth\AuthService;

abstract class BaseUserService extends AuthService
{

    public $loginUrl = 'user/login';

    public $logoutUrl = 'user/logout';

    public $dashboardUrl = 'user';

    protected $_user;

    public function getLoginUrl()
    {
        return site_url($this->loginUrl);
    }

    public function getLogoutUrl()
    {
        return site_url($this->logoutUrl);
    }

    public function getDashboardUrl()
    {
        return site_url($this->dashboardUrl);
    }

    public function getUser() : ?UserInterface
    {
        if (!$this->_user)
        {
            $userId = $this->user_id();

            if ($userId)
            {
                $userModel = new UserModel;

                $this->_user = $userModel->find($userId);

                if (!$this->_user)
                {
                    $this->logout();
                }                
            }
        }

        return $this->_user;
    }

}