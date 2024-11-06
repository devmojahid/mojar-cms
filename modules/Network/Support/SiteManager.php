<?php

/**
 * JUZAWEB CMS - The Best CMS for Laravel Project
 *
 * @package    mojar/cms
 * @author     Mojar Team <admin@mojar.com>
 * @link       https://mojar.com
 * @license    MIT
 */

namespace Mojar\Network\Support;

use Illuminate\Database\ConnectionResolverInterface;
use Illuminate\Support\Arr;
use Mojar\CMS\Models\User;
use Mojar\Network\Contracts\NetworkSiteContract;
use Mojar\Network\Contracts\SiteCreaterContract;
use Mojar\Network\Contracts\SiteManagerContract;
use Mojar\Network\Models\Site;

class SiteManager implements SiteManagerContract
{
    protected ConnectionResolverInterface $db;

    protected SiteCreaterContract $siteCreater;

    public function __construct(
        ConnectionResolverInterface $db,
        SiteCreaterContract $siteCreater
    ) {

        $this->db = $db;

        $this->siteCreater = $siteCreater;
    }

    public function find(string|int|Site $site): ?NetworkSiteContract
    {
        if (is_numeric($site)) {
            $site = Site::find($site);
        }

        if (is_string($site)) {
            $site = Site::where(['domain' => $site])->first();
        }

        if (empty($site)) {
            return null;
        }

        return $this->createSite($site);
    }

    public function create(string $subdomain, array $args = []): NetworkSiteContract
    {
        $site = $this->siteCreater->create($subdomain, $args);

        return $this->createSite($site);
    }

    public function getLoginUrl(string|int|Site $site, ?User $user = null): string
    {
        global $jw_user;
        $user = $user ?: $jw_user;
        return $this->find($site)->getLoginUrl($user);
    }

    public function validateLoginUrl(array $data): null|bool|User
    {
        $token = Arr::get($data, 'token');
        $auth = Arr::get($data, 'auth');
        $user = json_decode(decrypt(urldecode(Arr::get($data, 'user'))));

        if (empty($token) || empty($auth) || empty($user)) {
            return false;
        }

        if (generate_token($auth) != $token) {
            return false;
        }

        return User::find($user->id);
    }

    public function getCreater(): SiteCreaterContract
    {
        return $this->siteCreater;
    }

    private function createSite(Site $site): NetworkSiteContract
    {
        return new NetworkSite($site);
    }
}
