<?php
/**
 * @author Basic App Dev Team <dev@basic-app.com>
 * @license MIT
 * @link http://basic-app.com
 */
namespace BasicApp\Member;

use BasicApp\Exceptions\ForbiddenException;

abstract class BaseMemberController extends \BasicApp\Site\SiteController
{

    protected $userService = 'auth';

    protected $user;

    public function __construct()
    {
        parent::__construct();

        $this->user = service($this->userService)->getUser();

        if (!$this->user)
        {
            throw new ForbiddenException('Access denied.');
        }
    }

}