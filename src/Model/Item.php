<?php


namespace Weble\OATSPhoenixApi\Model;


class Item extends Resource
{
    use HasText;

    /**
     * @return Equipment|Index|null
     */
    public function browse()
    {
        return $this->oats->get($this->getHref())->getData();
    }

    public function isSelected(): bool
    {
        return (bool)$this->get('@selected');
    }
}
