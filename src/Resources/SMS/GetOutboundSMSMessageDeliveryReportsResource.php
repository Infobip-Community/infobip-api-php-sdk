<?php

declare(strict_types=1);

namespace Infobip\Resources\SMS;

use Infobip\Resources\ResourceQueryOptionsInterface;

/**
 * @link https://www.infobip.com/docs/api#channels/sms/get-outbound-sms-message-delivery-reports
 */
final class GetOutboundSMSMessageDeliveryReportsResource implements ResourceQueryOptionsInterface
{
    /** @var string|null */
    private $bulkId;

    /** @var string|null */
    private $messageId;

    /** @var int|null */
    private $limit;

    public function setBulkId(?string $bulkId): self
    {
        $this->bulkId = $bulkId;

        return $this;
    }

    public function setMessageId(?string $messageId): self
    {
        $this->messageId = $messageId;

        return $this;
    }

    public function setLimit(?int $limit): self
    {
        $this->limit = $limit;

        return $this;
    }

    public function queryOptions(): array
    {
        return array_filter_recursive([
            'bulkId' => $this->bulkId,
            'messageId' => $this->messageId,
            'limit' => $this->limit
        ]);
    }
}
