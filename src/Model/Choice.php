<?php

namespace Weble\OATSPhoenixApi\Model;

use Tightenco\Collect\Support\Collection;

class Choice extends Model
{
    use HasType;

    public function getOptions(): Collection
    {
        return collect($this->get('option', []));
    }
}
