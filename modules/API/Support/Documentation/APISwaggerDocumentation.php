<?php

/**
 * JUZAWEB CMS - The Best CMS for Laravel Project
 *
 * @package    mojar/cms
 * @author     Mojar Team <admin@mojar.com>
 * @link       https://mojar.com
 * @license    GNU General Public License v2.0
 */

namespace Juzaweb\API\Support\Documentation;

use Juzaweb\API\Support\Swagger\SwaggerDocument;

interface APISwaggerDocumentation
{
    public function handle(SwaggerDocument $document): SwaggerDocument;
}
