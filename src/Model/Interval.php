<?php


namespace Weble\OATSPhoenixApi\Model;

use Illuminate\Support\Collection;

class Interval extends Model
{
    use HasIds, HasText, HasUnit, HasDisplayName;

    public function __toString()
    {
        return $this->getText() . ' ' . $this->getDisplayName();
    }
}
