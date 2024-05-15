<?php

namespace RentACar;

class Country {
    protected ?int $id = null;
    protected ?string $name = null;
    protected ?string $code = null;

    public function __construct(?string $name = null, ?string $code = null, ?int $id = null) {
        if ($id !== null) {
            $this->id = $id;
        }

        if ($name !== null) {
            $this->name = $name;
        }

        if ($code !== null) {
            $this->code = $code;
        }
    }
}