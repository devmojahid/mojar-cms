<?php

namespace Juzaweb\CMS\Support\Updater;

use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Str;
use Juzaweb\CMS\Abstracts\UpdateManager;
use Juzaweb\CMS\Facades\CacheGroup;
use Juzaweb\CMS\Version;

class ThemeUpdater extends UpdateManager
{
    protected string $name;

    public function getVersionAvailable(): string
    {
        $uri = "themes/{$this->name}/version-available";
        $data = [
            'cms_version' => Version::getVersion(),
            'current_version' => $this->getCurrentVersion(),
        ];

        $response = $this->api->get($uri, $data);

        $this->responseErrors($response);

        return get_version_by_tag($response->data->version);
    }

    public function getCurrentVersion(): string
    {
        $module = app('themes')->find($this->name);
        if (empty($module)) {
            return "0";
        }

        return $module->getVersion();
    }

    public function find($name): static
    {
        $this->name = $name;

        return $this;
    }

    public function afterFinish(): void
    {
        CacheGroup::pull('theme_update_keys');

        if ($this->name == jw_current_theme()) {
            Artisan::call(
                'theme:publish',
                [
                    'theme' => $this->name,
                    'type' => 'assets',
                ]
            );
        }
    }

    protected function fetchData(): object
    {
        $uri = "themes/{$this->name}/update";

        $response = $this->api->get(
            $uri,
            $this->getDefaultApiParams()
        );
        
        // Log the raw API response
        \Log::info("Theme updater API response:", [
            'theme' => $this->name,
            'raw_response' => $response,
        ]);
        
        // Ensure we have a response that will work with the UpdateManager
        $response = $this->ensureCompatibleResponseFormat($response);

        $this->responseErrors($response);

        return $response;
    }
    
    /**
     * Ensure the response has the structure expected by UpdateManager
     * This provides backward compatibility with different API formats
     * 
     * @param object $response The original API response
     * @return object Modified response with the expected structure
     */
    protected function ensureCompatibleResponseFormat(object $response): object
    {
        // If status is false (no update available), add a dummy link to prevent errors
        // The download step should never run in this case, but this prevents the error
        if (isset($response->status) && $response->status === false) {
            \Log::info("No theme update available, adding dummy link to prevent errors");
            
            // Create a compatible response structure
            $compatibleResponse = clone $response;
            
            // Make sure data exists and is an object
            if (!isset($compatibleResponse->data) || !is_object($compatibleResponse->data)) {
                $compatibleResponse->data = new \stdClass();
            }
            
            // Add a dummy link that will never be used
            $compatibleResponse->data->link = 'no-update-available';
            
            \Log::info("Created compatible response for 'no theme update available' case");
            return $compatibleResponse;
        }
        
        // If the response already has the correct structure, return it as is
        if (isset($response->data) && isset($response->data->link)) {
            \Log::info("Theme response already has the correct structure");
            return $response;
        }
        
        // Create a new stdClass object for the compatible response 
        $compatibleResponse = new \stdClass();
        $compatibleResponse->status = isset($response->status) ? $response->status : true;
        
        // Create the data object if it doesn't exist
        if (!isset($response->data)) {
            $compatibleResponse->data = new \stdClass();
        } else {
            $compatibleResponse->data = $response->data;
        }
        
        // Handle nested data structure (if response->data->data exists)
        if (isset($response->data) && isset($response->data->data)) {
            if (isset($response->data->data->link)) {
                // Move the nested values up one level
                $compatibleResponse->data->link = $response->data->data->link;
                $compatibleResponse->data->version = $response->data->data->version ?? null;
                
                \Log::info("Adapted nested theme data structure to compatible format");
            }
        }
        
        // Handle case where data contains link directly
        if (isset($response->data) && isset($response->data->link)) {
            $compatibleResponse->data->link = $response->data->link;
            \Log::info("Theme response already has data->link structure");
        }
        
        // If we still don't have a link, check for a download_url in package data
        if (!isset($compatibleResponse->data->link)) {
            // Look for download_url or url properties that might contain the link
            foreach (['download_url', 'url'] as $possibleField) {
                if (isset($response->data->{$possibleField})) {
                    $compatibleResponse->data->link = $response->data->{$possibleField};
                    \Log::info("Using {$possibleField} as theme link");
                    break;
                }
            }
        }
        
        // Log the compatible response for debugging
        \Log::info("Compatible theme response:", [
            'compatibleResponse' => $compatibleResponse
        ]);
        
        return $compatibleResponse;
    }

    protected function getDefaultApiParams(): array
    {
        $params = [
            'cms_version' => Version::getVersion(),
            'current_version' => $this->getCurrentVersion(),
            'domain' => request()->getHttpHost(),
        ];

        $activationCodes = get_config('theme_activation_codes', []);

        if (isset($activationCodes[Str::snake($this->name)])) {
            $params['use_token'] = $activationCodes[Str::snake($this->name)]['token'] ?? null;
        }

        return $params;
    }

    protected function getCacheKey(): string
    {
        return 'theme_' . $this->name;
    }

    protected function getLocalPath(): string
    {
        return config('mojar.theme.path') . '/' . $this->name;
    }
}
