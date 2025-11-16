<?php

declare(strict_types=1);

namespace App\Utilities;

final class Constants
{
    public static $MIN_VERIFICATION_CODE = 100_000;

    public static $MAX_VERIFICATION_CODE = 999_999;

    public static $NUMBER_OF_TICKETS = 5;

    public static $ALLOWED_NUMBER_OF_ATTACHMENTS = 5;

    public static $MAX_AGENT_TICKETS = 5;
}
