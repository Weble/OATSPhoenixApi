<?php


namespace Weble\OATSPhoenixApi\Model;

use Illuminate\Support\Collection;
use Weble\OATSPhoenixApi\OATS;
use Weble\OATSPhoenixApi\Response\ResponseType;

class Index extends Resource
{
    use HasType;

    public function __construct($items = [], OATS $oats = null)
    {
        parent::__construct($items, $oats);

        $this->parseParent();
        $this->parseItems();
    }

    protected function parseParent(): void
    {
        if (!$this->get('parent')) {
            return;
        }

        $this->put('parent', collect($this->get('parent', []))->mapWithKeys(function (array $item) {
            $index = new Index($item, $this->oats);
            return [$index->getType() => $index];
        }));
    }

    protected function parseItems(): void
    {
        $items = $this->get('item', []);

        $this->put('items', collect($items)->mapWithKeys(function (array $item) {
            $item = new Item($item, $this->oats);
            $alias = basename($item->getHref());
            return [$alias => $item];
        }));
    }

    public function __call($name, $arguments)
    {
        if (method_exists($this->getItems(), $name)) {
            return $this->getItems()->$name(...$arguments);
        }
    }

    public function getItems(): Collection
    {
        return $this->get('items');
    }

    public function getParent(): ?Collection
    {
        return $this->get('parent');
    }
}
