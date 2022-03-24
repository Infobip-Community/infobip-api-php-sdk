<?php

declare(strict_types=1);

namespace Infobip\Resources\SMS;

use Infobip\Resources\ResourcePayloadInterface;
use Infobip\Resources\ResourceQueryOptionsInterface;

/**
 * @link https://www.infobip.com/docs/api#channels/sms/reschedule-sms-messages
 */
final class RescheduleSMSMessagesResource implements ResourceQueryOptionsInterface, ResourcePayloadInterface
{
    /** @var string */
    private $bulkId;

    /** @var string */
    private $sendAt;

    public function __construct(string $bulkId, string $sendAt)
    {
        $this->bulkId = $bulkId;
        $this->sendAt = $sendAt;
    }

    public function queryOptions(): array
    {
        return array_filter_recursive([
            'bulkId' => $this->bulkId,
        ]);
    }

    public function payload(): array
    {
        return array_filter_recursive([
            'sendAt' => $this->sendAt,
        ]);
    }
}
