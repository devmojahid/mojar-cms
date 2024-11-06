<?php

/**
 * JUZAWEB CMS - Laravel CMS for Your Project
 *
 * @package    mojar/cms
 * @author     The Anh Dang
 * @link       https://mojar.com/cms
 * @license    GNU V2
 */

namespace Mojar\CMS\Support;

use Mojar\CMS\Abstracts\PageBlock;

class DefaultPageBlock extends PageBlock
{
    /**
     * Creating widget front-end
     *
     * @param array $data
     * @return \Illuminate\View\View
     */
    public function show($data)
    {
        return $this->view(
            $this->data['view'],
            compact(
                'data'
            )
        );
    }
}
