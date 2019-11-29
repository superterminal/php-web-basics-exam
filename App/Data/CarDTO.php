<?php

namespace App\Data;


class CarDTO
{
    /**
     * @var int
     */
    private $id;

    /**
     * @var string
     */
    private $maker;

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @param int $id
     */
    public function setId(int $id): void
    {
        $this->id = $id;
    }

    /**
     * @return string
     */
    public function getMaker(): string
    {
        return $this->maker;
    }

    /**
     * @param string $maker
     */
    public function setMaker(string $maker): void
    {
        $this->maker = $maker;
    }
}