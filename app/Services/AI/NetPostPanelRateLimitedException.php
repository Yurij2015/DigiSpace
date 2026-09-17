<?php

namespace App\Services\AI;

use RuntimeException;

class NetPostPanelRateLimitedException extends RuntimeException
{
    public function __construct(public readonly ?int $retryAfterSeconds)
    {
        $message = 'NetPostPanel API rate limited.';

        if ($retryAfterSeconds !== null) {
            $message .= " Retry after {$retryAfterSeconds} seconds.";
        }

        parent::__construct($message);
    }
}
