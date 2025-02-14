<?php

namespace Mojahid\Ecommerce\Supports\Manager;

use Mojahid\Ecommerce\Models\Addon;
use Illuminate\Support\Facades\Log;

class AddonManager
{
    protected array $addons = [];

    public function loadAddons()
    {
        // Load from ecom_addons table
        $rows = Addon::all();
        foreach ($rows as $row) {
            $this->addons[$row->slug] = $row;
        }
    }

    public function initAddons()
    {
        foreach ($this->addons as $slug => $addon) {
            if ($addon->enabled) {
                $this->initAddon($addon);
            }
        }
    }

    protected function initAddon($addon)
    {
        // 1) Check license if it's is_premium
        if ($addon->is_premium && !$this->checkLicense($addon)) {
            Log::warning("Add-on {$addon->slug} is premium but has no valid license");
            return;
        }

        // 2) Possibly call a hooking class or a ServiceProvider for that add-on
        //    e.g. "Juzaweb\Ecommerce\Addons\POSAddonServiceProvider"
        //    or something if you have a consistent naming approach

        $providerClass = $this->resolveAddonProvider($addon->slug);
        if (class_exists($providerClass)) {
            // instantiate
            $provider = new $providerClass;
            // for example, if we have a standard "boot" or "handle" method:
            $provider->boot();
        } else {
            Log::error("Addon provider class not found for slug: {$addon->slug}");
        }
    }

    protected function checkLicense($addon): bool
    {
        // e.g. check $addon->license_key or licensed_until
        // or query an external server
        // Return true if valid, false otherwise
        if (empty($addon->license_key)) {
            return false;
        }
        // If $addon->licensed_until < now, also fail
        return true;
    }

    protected function resolveAddonProvider(string $slug): string
    {
        // Some mapping from slug => class
        // Or a standardized naming
        // e.g. "pos-addon" => "Juzaweb\Ecommerce\Addons\PosAddonServiceProvider"
        $slugStudly = str_replace('-', '', ucwords($slug, '-'));
        return "Juzaweb\\Ecommerce\\Addons\\{$slugStudly}\\{$slugStudly}ServiceProvider";
    }
}
