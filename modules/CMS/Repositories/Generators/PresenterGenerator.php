<?php

namespace Juzaweb\CMS\Repositories\Generators;

use Juzaweb\CMS\Repositories\Generators\Generator;
use Juzaweb\CMS\Repositories\Generators\TransformerGenerator;

/**
 * Class PresenterGenerator
 *
 * @package Prettus\Repository\Generators
 * @author Anderson Andrade <contato@andersonandra.de>
 */
class PresenterGenerator extends Generator
{
    /**
     * Get stub name.
     *
     * @var string
     */
    protected $stub = 'presenter/presenter';

    /**
     * Get root namespace.
     *
     * @return string
     */
    public function getRootNamespace()
    {
        return parent::getRootNamespace() . parent::getConfigGeneratorClassPath($this->getPathConfigNode());
    }

    /**
     * Get generator path config node.
     *
     * @return string
     */
    public function getPathConfigNode()
    {
        return 'presenters';
    }

    /**
     * Get array replacements.
     *
     * @return array
     */
    public function getReplacements()
    {
        $transformerGenerator = new TransformerGenerator(
            [
                'name' => $this->name,
            ]
        );
        $transformer = $transformerGenerator->getRootNamespace() . '\\' . $transformerGenerator->getName() . 'Transformer';
        $transformer = str_replace(
            [
                "\\",
                '/',
            ],
            '\\',
            $transformer
        );
        echo $transformer;

        return array_merge(
            parent::getReplacements(),
            [
                'transformer' => $transformer,
            ]
        );
    }

    /**
     * Get destination path for generated file.
     *
     * @return string
     */
    public function getPath()
    {
        return $this->getBasePath() . '/' . parent::getConfigGeneratorClassPath(
            $this->getPathConfigNode(),
            true
        ) . '/' . $this->getName() . 'Presenter.php';
    }

    /**
     * Get base path of destination file.
     *
     * @return string
     */
    public function getBasePath()
    {
        return config('repository.generator.basePath', app()->path());
    }
}
