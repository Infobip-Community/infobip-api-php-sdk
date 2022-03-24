<?php

declare(strict_types=1);

namespace Tests\Endpoints\MMS;

use Infobip\Enums\StatusCode;
use Infobip\Exceptions\InfobipServerException;
use Infobip\Exceptions\InfobipTooManyRequestException;
use Infobip\Exceptions\InfobipUnauthorizedException;
use Infobip\Resources\MMS\GetInboundMMSMessagesResource;
use Tests\Endpoints\TestCase;

final class GetInboundMMSMessagesTest extends TestCase
{
    public function testApiCallExpectsSuccess(): void
    {
        // arrange
        $resource = $this->getResource();
        $mockedResponse = $this->loadJsonDataFixture('Endpoints/MMS/get_inbound_mms_messages_success.json');

        $this->setMockedGuzzleHttpClient(
            StatusCode::SUCCESS,
            $mockedResponse
        );

        // act
        $response = $this
            ->getInfobipClient()
            ->MMS()
            ->getInboundMMSMessages($resource);

        // assert
        $this->assertSame($mockedResponse, $response);
    }

    public function testApiCallExpectsUnauthorizedException(): void
    {
        // arrange
        $resource = $this->getResource();
        $mockedResponse = $this->loadJsonDataFixture('Errors/unauthorized.json');

        $this->setMockedGuzzleHttpClient(
            StatusCode::UNAUTHORIZED,
            $mockedResponse
        );

        // act & assert
        $this->expectException(InfobipUnauthorizedException::class);
        $this->expectExceptionCode(StatusCode::UNAUTHORIZED);
        $this->expectExceptionMessage($mockedResponse['requestError']['serviceException']['text']);

        $this
            ->getInfobipClient()
            ->MMS()
            ->getInboundMMSMessages($resource);
    }

    public function testApiCallExpectsTooManyRequestsException(): void
    {
        // arrange
        $resource = $this->getResource();
        $mockedResponse = $this->loadJsonDataFixture('Errors/too_many_requests.json');

        $this->setMockedGuzzleHttpClient(
            StatusCode::TOO_MANY_REQUESTS,
            $mockedResponse
        );

        // act & assert
        $this->expectException(InfobipTooManyRequestException::class);
        $this->expectExceptionCode(StatusCode::TOO_MANY_REQUESTS);
        $this->expectExceptionMessage($mockedResponse['requestError']['serviceException']['text']);

        $this
            ->getInfobipClient()
            ->MMS()
            ->getInboundMMSMessages($resource);
    }

    public function testApiCallExpectsServerErrorException(): void
    {
        // arrange
        $resource = $this->getResource();
        $mockedResponse = $this->loadJsonDataFixture('Errors/server_error.json');

        $this->setMockedGuzzleHttpClient(
            StatusCode::SERVER_ERROR,
            $mockedResponse
        );

        // act & assert
        $this->expectException(InfobipServerException::class);
        $this->expectExceptionCode(StatusCode::SERVER_ERROR);
        $this->expectExceptionMessage($mockedResponse['requestError']['serviceException']['text']);

        $this
            ->getInfobipClient()
            ->MMS()
            ->getInboundMMSMessages($resource);
    }

    private function getResource(): GetInboundMMSMessagesResource
    {
        return new GetInboundMMSMessagesResource();
    }
}
