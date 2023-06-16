<?php

namespace Weble\OATSPhoenixApi\Model;

use Illuminate\Support\Collection;

class Choice extends Model
{
    use HasType;

    public function getOptions(): Collection
    {
        return collect($this->get('option', []));
    }
}
