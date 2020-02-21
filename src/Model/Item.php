<?php


namespace Weble\OATSPhoenixApi\Model;


class Item extends Resource
{
    /**
     * @return Equipment|Index|null
     */
    public function browse()
    {
        return $this->oats->get($this->getHref())->getData();
    }

    public function getText(): ?string
    {
        return $this->get('#text');
    }

    public function isSelected(): bool
    {
        return (bool)$this->get('@selected');
    }
}
