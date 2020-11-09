<?php

namespace App\Entity;

use Monolog\Logger;

class Master
{
    private string $message;

    public function __construct(string $message, Transform $transform, Logger $logger)
    {

        $this->message = $transform->transform($message);
        $logger->info($this->message);
    }

    public function getMessage(): string
    {
        return $this->message;

    }
}