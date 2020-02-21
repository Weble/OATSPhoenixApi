<?php


namespace Weble\OATSPhoenixApi\Model;


class TranslatableText extends Model
{
    public function getOriginal(): ?string
    {
        return $this->get('@original');
    }

    public function getText(): string
    {
        return $this->get('#text', '');
    }

    public function __toString()
    {
        return $this->getText();
    }
}
