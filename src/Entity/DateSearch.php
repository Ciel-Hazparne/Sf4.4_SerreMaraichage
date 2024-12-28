<?php

namespace App\Entity;

class DateSearch
{
    /**
     * @var date|null
     */
    private $minDate;

    /**
     * @var date|null
     */
    private $maxDate;

    public function getMinDate(): ?int
    {
        return $this->minDate;
    }

    public function setMinDate(int $minDate): self
    {
        $this->minDate = $minDate;
        return $this;
    }

    public function getMaxDate(): ?int
    {
        return $this->maxDate;
    }

    public function setMaxDate(int $maxDate): self
    {
        $this->maxDate = $maxDate;
        return $this;
    }

}