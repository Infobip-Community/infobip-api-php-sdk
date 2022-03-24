<?php

declare(strict_types=1);

namespace Tests\Endpoints\SMS;

use Infobip\Enums\StatusCode;
use Infobip\Exceptions\InfobipServerException;
use Infobip\Resources\SMS\GetInboundSMSMessagesResource;
use Infobip\Resources\SMS\GetOutboundSMSMessageDeliveryReportsResource;
use Tests\Endpoints\TestCase;

final class GetInboundSMSMessagesTest extends TestCase
{
    public function testApiCallExpectsSuccess(): void
    {
        // arrange
        $resource = $this->getResource();
        $mockedResponse = $this->loadJsonDataFixture(
            'Endpoints/SMS/get_inbound_sms_messages_success.json'
        );

        $this->setMockedGuzzleHttpClient(
            StatusCode::SUCCESS,
            $mockedResponse
        );

        // act
        $response = $this
            ->getInfobipClient()
            ->SMS()
            ->getInboundSMSMessages($resource);

        // assert
        $this->assertSame($mockedResponse, $response);
    }

    public function testApiCallExpectsServerErrorException(): void
    {
        // arrange
        $resource = $this->getResource();
        $mockedResponse = $this->loadJsonDataFixture('Endpoints/SMS/general_sms_error.json');

        $this->setMockedGuzzleHttpClient(
            StatusCode::SERVER_ERROR,
            $mockedResponse
        );

        // act & assert
        $this->expectException(InfobipServerException::class);
        $this->expectExceptionCode(StatusCode::SERVER_ERROR);
        $this->expectExceptionMessage($mockedResponse['requestError']['serviceException']['text']);

        // act
        $response = $this
            ->getInfobipClient()
            ->SMS()
            ->getInboundSMSMessages($resource);

        // assert
        $this->assertSame($mockedResponse, $response);
    }

    private function getResource(): GetInboundSMSMessagesResource
    {
        return new GetInboundSMSMessagesResource();
    }
}
