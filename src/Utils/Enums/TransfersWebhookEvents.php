<?php

namespace Asaas\Utils\Enums;

class TransfersWebhookEvents
{
    public const TRANSFER_CREATED = 'TRANSFER_CREATED';
    public const TRANSFER_PENDING = 'TRANSFER_PENDING';
    public const TRANSFER_IN_BANK_PROCESSING = 'TRANSFER_IN_BANK_PROCESSING';
    public const TRANSFER_BLOCKED = 'TRANSFER_BLOCKED';
    public const TRANSFER_DONE = 'TRANSFER_DONE';
    public const TRANSFER_FAILED = 'TRANSFER_FAILED';
    public const TRANSFER_CANCELLED = 'TRANSFER_CANCELLED';
}
