<?php

/**
 * Mojar - Laravel CMS for Your Project
 *
 * @package    mojar/cms
 * @author     The Anh Dang
 * @link       https://mojar.com/cms
 * @license    GNU V2
 */

namespace Juzaweb\CMS\Support;

use Juzaweb\CMS\Abstracts\Widget;

class DefaultWidget extends Widget
{
    /**
     * Creating widget Backend
     *
     * @param array $inputData
     * @return \Illuminate\View\View
     */
    public function form($inputData)
    {
        $data = $this->getJsonForm();

        return view(
            'cms::backend.widget.components.widget_form',
            [
                'data' => $data,
                'key' => $inputData['key'],
                'value' => $inputData,
            ]
        );
    }

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

    /**
     * Updating data block
     *
     * @param array $data
     * @return array
     */
    public function update($data)
    {
        return $data;
    }
}
