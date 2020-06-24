<?php


namespace Weble\OATSPhoenixApi\Model;

use Tightenco\Collect\Support\Collection;

class AppNote extends Model
{
    use HasText;

    public function getId(): ?string
    {
        return $this->get('@id');
    }

    public function getNoteClass(): ?string
    {
        return $this->get('@noteclass');
    }

    public function getNoteIndex(): ?string
    {
        return $this->get('@noteclass');
    }
}
