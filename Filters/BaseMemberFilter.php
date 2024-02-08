<?php
/**
 * @author Basic App Dev Team <dev@basic-app.com>
 * @license MIT
 * @link http://basic-app.com
 */
namespace BasicApp\Member\Filters;

use Exception;

abstract class BaseMemberFilter extends \BasicApp\Filters\AuthFilter
{

    public $userService = 'auth';
    
}