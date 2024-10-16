<?php

declare(strict_types=1);

namespace Infobip\Resources\SMS\Models;

use DateTimeImmutable;
use DateTimeInterface;
use Infobip\Resources\ModelInterface;
use Infobip\Resources\ModelValidationInterface;
use Infobip\Resources\SMS\Collections\DestinationCollection;
use Infobip\Resources\Shared\Models\DeliveryTimeWindow;
use Infobip\Resources\SMS\Enums\NotifyContentType;
use Infobip\Resources\SMS\Enums\TransliterationType;
use Infobip\Validations\Rules;
use Infobip\Validations\Rules\MaxLengthRule;
use Infobip\Validations\Rules\MaxNumberRule;

final class Message implements ModelInterface, ModelValidationInterface
{
    /** @var DestinationCollection */
    private $destinations;

    /** @var string|null */
    private $text;

    /** @var Binary|null */
    private $binary;

    /** @var string|null */
    private $callbackData;

    /** @var DeliveryTimeWindow|null */
    private $deliveryTimeWindow;

    /** @var bool */
    private $flash = false;

    /** @var string|null */
    private $from;

    /** @var bool */
    private $intermediateReport = false;

    /** @var Language|null */
    private $language;

    /** @var NotifyContentType|null */
    private $notifyContentType;

    /** @var string|null */
    private $notifyUrl;

    /** @var Regional|null */
    private $regional;

    /** @var DateTimeImmutable|null */
    private $sendAt;

    /** @var TransliterationType|null */
    private $transliteration;

    /** @var int|null */
    private $validityPeriod;

    public function __construct()
    {
        $this->destinations = new DestinationCollection();
    }

    public function setText(?string $text): self
    {
        $this->text = $text;

        return $this;
    }

    public function setBinary(?Binary $binary): self
    {
        $this->binary = $binary;

        return $this;
    }

    public function setCallbackData(?string $callbackData): self
    {
        $this->callbackData = $callbackData;

        return $this;
    }

    public function setDeliveryTimeWindow(?DeliveryTimeWindow $deliveryTimeWindow): self
    {
        $this->deliveryTimeWindow = $deliveryTimeWindow;

        return $this;
    }

    public function setDestinations(DestinationCollection $destinations): self
    {
        $this->destinations = $destinations;

        return $this;
    }

    public function addDestination(Destination $destination): self
    {
        $this->destinations->add($destination);

        return $this;
    }

    public function setFlash(bool $flash): self
    {
        $this->flash = $flash;

        return $this;
    }

    public function setFrom(?string $from): self
    {
        $this->from = $from;

        return $this;
    }

    public function setIntermediateReport(bool $intermediateReport): self
    {
        $this->intermediateReport = $intermediateReport;

        return $this;
    }

    public function setLanguage(?Language $language): self
    {
        $this->language = $language;

        return $this;
    }

    public function setNotifyContentType(?NotifyContentType $notifyContentType): self
    {
        $this->notifyContentType = $notifyContentType;

        return $this;
    }

    public function setNotifyUrl(?string $notifyUrl): self
    {
        $this->notifyUrl = $notifyUrl;

        return $this;
    }

    public function setRegional(?Regional $regional): self
    {
        $this->regional = $regional;

        return $this;
    }

    public function setSendAt(?DateTimeImmutable $sendAt): self
    {
        $this->sendAt = $sendAt;

        return $this;
    }

    public function setTransliteration(?TransliterationType $transliteration): self
    {
        $this->transliteration = $transliteration;

        return $this;
    }

    public function setValidityPeriod(?int $validityPeriod): self
    {
        $this->validityPeriod = $validityPeriod;

        return $this;
    }

    public function toArray(): array
    {
        return array_filter_recursive([
            'text' => $this->text,
            'binary' => $this->binary,
            'callbackData' => $this->callbackData,
            'deliveryTimeWindow' => $this->deliveryTimeWindow,
            'destinations' => $this->destinations->toArray(),
            'flash' => $this->flash,
            'from' => $this->from,
            'intermediateReport' => $this->intermediateReport,
            'language' => $this->language,
            'notifyContentType' => $this->notifyContentType ? $this->notifyContentType->getValue() : null,
            'notifyUrl' => $this->notifyUrl,
            'regional' => $this->regional,
            'sendAt' => $this->sendAt ? $this->sendAt->format(DateTimeInterface::RFC3339_EXTENDED) : null,
            'transliteration' => $this->transliteration ? $this->transliteration->getValue() : null,
            'validityPeriod' => $this->validityPeriod,
        ]);
    }

    public function rules(): Rules
    {
        return (new Rules())
            ->addRule(new MaxLengthRule('message.callbackData', $this->callbackData, 4000))
            ->addRule(new MaxNumberRule('message.validityPeriod', $this->validityPeriod, 2880))
            ->addCollectionRules($this->destinations);
    }
}
