<?php
namespace Juzaweb\CMS\Support\Html;

use Juzaweb\CMS\Contracts\RepeaterItem as RepeaterItemContract;

class RepeaterItem implements RepeaterItemContract
{
    protected array $fields = [];
    protected array $values = [];

    public function __construct(array $fields, array $values = [])
    {
        $this->fields = $fields;
        $this->values = $values;
    }

    public function getFields(): array
    {
        return $this->fields;
    }

    public function getValues(): array
    {
        return $this->values;
    }

    public function setValues(array $values): void
    {
        $this->values = $values;
    }
}