<?php


namespace Weble\OATSPhoenixApi\Model;


use Weble\OATSPhoenixApi\Response\ResponseType;

trait HasChoices
{
    protected function getChoice(string $key): ?Choice
    {
        $data = $this->get($key);
        if (!$data) {
            return null;
        }

        return new Choice($data);
    }
}
