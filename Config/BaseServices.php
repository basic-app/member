<?php
/**
 * @author Basic App Dev Team
 * @license MIT
 */
namespace BasicApp\Member\Config;

use Exception;
use BasicApp\Member\Libraries\UserService;

abstract class BaseServices extends \CodeIgniter\Config\BaseService
{

    public static function auth($getShared = true)
    {
        if (!$getShared)
        {
            return new UserService();
        }

        return static::getSharedInstance(__FUNCTION__);
    }

}