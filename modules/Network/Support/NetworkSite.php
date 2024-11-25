<?php

/**
 * JUZAWEB CMS - The Best CMS for Laravel Project
 *
 * @package    mojar/cms
 * @author     Mojar Team <admin@mojar.com>
 * @link       https://mojar.com
 * @license    MIT
 */

namespace Juzaweb\Network\Support;

use Illuminate\Support\Str;
use Juzaweb\CMS\Models\User;
use Juzaweb\Network\Contracts\NetworkSiteContract;
use Juzaweb\Network\Models\Site;

class NetworkSite implements NetworkSiteContract
{
    protected Site $site;

    public function __construct(Site $site)
    {
        $this->site = $site;
    }

    public function getLoginUrl(User $user): string
    {
        $random = Str::random(5);
        $loginUrl = $this->getUrl(config('mojar.admin_prefix'));
        $string = "{$loginUrl}/{$random}";
        $token = generate_token($string);
        $user = encrypt(json_encode(['id' => $user->id]));

        $data = [
            'token' => $token,
            'auth' => urldecode($string),
            'user' => urlencode($user)
        ];

        return $loginUrl . '/token-login?' . http_build_query($data);
    }

    public function getUrl(string $path = null): string
    {
        return $this->site->getSiteUrl($path);
    }
}
