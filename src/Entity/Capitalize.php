<?php

namespace App\Entity;

class Capitalize implements Transform
{

    public function transform(string $string): string
    {
        return preg_replace_callback('/(\w)(.?)/', fn($string) => strtoupper($string[1]) . strtolower($string[2]), $string);
    }


}