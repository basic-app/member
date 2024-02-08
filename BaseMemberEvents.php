<?php
/**
 * @author Basic App Dev Team <dev@basic-app.com>
 * @license MIT
 * @link http://basic-app.com
 */
namespace BasicApp\Member;

use BasicApp\Helpers\Url;
use BasicApp\Member\Events\MemberMenuEvent;
use BasicApp\Member\Events\AccountMenuEvent;

abstract class BaseMemberEvents extends \CodeIgniter\Events\Events
{

    const EVENT_MEMBER_MENU = 'ba:member_menu';

    const EVENT_ACCOUNT_MENU = 'ba:account_menu';

    public static function onMemberMenu($callback)
    {
        static::on(static::EVENT_MEMBER_MENU, $callback);
    }

    public static function onAccountMenu($callback)
    {
        static::on(static::EVENT_ACCOUNT_MENU, $callback);
    }    

    public static function memberMenu()
    {
        $event = new MemberMenuEvent;

        $event->items = [];

        static::trigger(static::EVENT_MEMBER_MENU, $event);

        $view = service('renderer');

        $data = $view->getData();

        if (array_key_exists('memberMenu', $data))
        {
            return array_merge_recursive($event->items, $data['memberMenu']);
        }

        return $event->items;
    }

    public static function accountMenu(array $items = [])
    {
        $event = new AccountMenuEvent;

        $event->items = $items;

        $user = service('auth');

        if ($user->getUser())
        {
            $event->items['member'] = [
                'label' => t('member', 'Member'),
                'url' => Url::createUrl('member')
            ];
        }

        static::trigger(static::EVENT_ACCOUNT_MENU, $event);

        $view = service('renderer');

        $data = $view->getData();

        if (array_key_exists('accountMenu', $data))
        {
            return array_merge_recursive($event->items, $data['accountMenu']);
        }

        return $event->items;
    }    

}