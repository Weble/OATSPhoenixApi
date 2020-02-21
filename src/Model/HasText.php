<?php


namespace Weble\OATSPhoenixApi\Model;


trait HasText
{
    public function getText(): ?string
    {
        return $this->get('#text');
    }
}
