<?php

/**
 * Mojar - The Best CMS for Laravel Project
 *
 * @package    mojar/cms
 * @author     Mojar Team <admin@mojar.com>
 * @link       https://mojar.com
 * @license    GNU General Public License v2.0
 */

namespace Juzaweb\CMS\Traits\Criterias;

use Juzaweb\CMS\Repositories\Criterias\SortCriteria;

trait UseSortableCriteria
{
    public function withSorts(array $sorts): static
    {
        $this->pushCriteria(new SortCriteria($sorts));

        return $this;
    }

    public function getFieldSortable(): array
    {
        return $this->sortableFields ?? [];
    }

    public function getSortableDefaults(): array
    {
        return $this->sortableDefaults ?? [];
    }
}
