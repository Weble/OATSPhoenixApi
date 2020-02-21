<?php


namespace Weble\OATSPhoenixApi\Model;


use Weble\OATSPhoenixApi\Response\ResponseType;

trait HasType
{
    public function getType(): string
    {
        return $this->get('@type', ResponseType::UNKNOWN);
    }
}
