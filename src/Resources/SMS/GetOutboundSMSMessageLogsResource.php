<?php

declare(strict_types=1);

namespace Infobip\Resources\SMS;

use Infobip\Resources\ResourceQueryOptionsInterface;
use Infobip\Resources\SMS\Enums\GeneralStatusType;

/**
 * @link https://www.infobip.com/docs/api#channels/sms/get-outbound-sms-message-logs
 */
final class GetOutboundSMSMessageLogsResource implements ResourceQueryOptionsInterface
{
    /** @var string|null */
    private $from;

    /** @var string|null */
    private $to;

    /** @var string[]|null */
    private $bulkId;

    /** @var string|null */
    private $messageId;

    /** @var GeneralStatusType|null */
    private $generalStatus;

    /** @var string|null */
    private $sentSince;

    /** @var string|null */
    private $sentUntil;

    /** @var int|null */
    private $limit;

    /** @var string|null */
    private $mcc;

    /** @var string|null */
    private $mnc;

    public function setFrom(?string $from): self
    {
        $this->from = $from;

        return $this;
    }

    public function setTo(?string $to): self
    {
        $this->to = $to;

        return $this;
    }

    public function setBulkId(?array $bulkId): self
    {
        $this->bulkId = $bulkId;

        return $this;
    }

    public function setMessageId(?string $messageId): self
    {
        $this->messageId = $messageId;

        return $this;
    }

    public function setGeneralStatus(?GeneralStatusType $generalStatus): self
    {
        $this->generalStatus = $generalStatus;

        return $this;
    }

    public function setSentSince(?string $sentSince): self
    {
        $this->sentSince = $sentSince;

        return $this;
    }

    public function setSentUntil(?string $sentUntil): self
    {
        $this->sentUntil = $sentUntil;

        return $this;
    }

    public function setLimit(?int $limit): self
    {
        $this->limit = $limit;

        return $this;
    }

    public function setMcc(?string $mcc): self
    {
        $this->mcc = $mcc;

        return $this;
    }

    public function setMnc(?string $mnc): self
    {
        $this->mnc = $mnc;

        return $this;
    }

    public function queryOptions(): array
    {
        return array_filter_recursive([
            'from' => $this->from,
            'to' => $this->to,
            'bulkId' => $this->bulkId,
            'messageId' => $this->messageId,
            'generalStatus' => $this->generalStatus ? $this->generalStatus->getValue() : null,
            'sentSince' => $this->sentSince,
            'sentUntil' => $this->sentUntil,
            'limit' => $this->limit,
            'mcc' => $this->mcc,
            'mnc' => $this->mnc,
        ]);
    }
}
