<?php

namespace Asaas\Utils\Enums;

class BillsWebhookEvents
{
    public const BILL_CREATED = 'BILL_CREATED';
    public const BILL_PENDING = 'BILL_PENDING';
    public const BILL_BANK_PROCESSING = 'BILL_BANK_PROCESSING';
    public const BILL_PAID = 'BILL_PAID';
    public const BILL_CANCELLED = 'BILL_CANCELLED';
    public const BILL_FAILED = 'BILL_FAILED';
    public const BILL_REFUNDED = 'BILL_REFUNDED';
}
