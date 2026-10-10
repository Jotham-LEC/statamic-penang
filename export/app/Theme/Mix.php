<?php

namespace App\Theme;

/**
 * A colour worked out in the browser, as `color-mix(in oklab, …)`, from two
 * the theme chose; colour() gives what the browser will get, for the tests.
 */
final readonly class Mix
{
    public function __construct(
        public Colour $base,
        public Colour $with,
        public float $amount,
    ) {}

    public function colour(): Colour
    {
        return $this->base->mix($this->with, $this->amount);
    }

    public function css(): string
    {
        return sprintf('color-mix(in oklab, %s, %s %s%%)', $this->base->css(), $this->with->css(), round($this->amount * 100, 1));
    }
}
