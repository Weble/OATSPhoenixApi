<?php


namespace Weble\OATSPhoenixApi\Model;


use Weble\OATSPhoenixApi\OATS;

abstract class Resource extends Model
{
    /** @var OATS */
    protected $oats;

    public function __construct($items = [], OATS $oats = null)
    {
        parent::__construct($items);

        $this->oats = $oats;
    }

    public function getHref(): ?string
    {
        return $this->get('@href');
    }
}
