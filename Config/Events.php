<?php
/**
 * @author Basic App Dev Team <dev@basic-app.com>
 * @license MIT
 * @link http://basic-app.com
 */
use BasicApp\System\SystemEvents;
use BasicApp\Member\Filters\MemberFilter;
use BasicApp\Site\SiteEvents;
use BasicApp\Member\MemberEvents;
use CodeIgniter\Events\Events;

Events::on('pre_system', function()
{
    $config = config(\Config\Filters::class);

    $config->aliases['memberIsLoggedIn'] = MemberFilter::class;

    $config->filters['memberIsLoggedIn'] = ['before' => ['/member/', '/member/*']];
});

if (class_exists(SiteEvents::class))
{
    SiteEvents::onMainLayout(function($event)
    {
        $event->params['userMenu'] = MemberEvents::memberMenu();

        $event->params['accountMenu'] = MemberEvents::accountMenu();
    });
}