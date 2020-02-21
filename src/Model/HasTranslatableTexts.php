<?php


namespace Weble\OATSPhoenixApi\Model;


use Weble\OATSPhoenixApi\Response\ResponseType;

trait HasTranslatableTexts
{
    protected function getTranslatableText(string $key): ?TranslatableText
    {
        $data = $this->get($key);
        if (!$data) {
            return null;
        }

        return new TranslatableText($data);
    }
}
