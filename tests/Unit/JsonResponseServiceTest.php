<?php

namespace Tests\Unit;

use App\Helpers\JsonResponseService;
use Illuminate\Http\JsonResponse;
use Tests\TestCase;

class JsonResponseServiceTest extends TestCase
{
    private JsonResponseService $jsonResponseService;

    protected function setUp(): void
    {
        parent::setUp();
        $this->jsonResponseService = new JsonResponseService();
    }

    public function test_success_response_with_empty_data()
    {
        $response = $this->jsonResponseService->getSuccessResponse();

        $this->assertInstanceOf(JsonResponse::class, $response);
        $this->assertEquals(200, $response->getStatusCode());
        $this->assertJsonStringEqualsJsonString(
            json_encode(['success' => true]),
            $response->getContent()
        );
    }

    public function test_success_response_with_data()
    {
        $data = ['key' => 'value', 'number' => 42];
        $response = $this->jsonResponseService->getSuccessResponse($data);

        $this->assertInstanceOf(JsonResponse::class, $response);
        $this->assertEquals(200, $response->getStatusCode());
        $this->assertJsonStringEqualsJsonString(
            json_encode(['key' => 'value', 'number' => 42, 'success' => true]),
            $response->getContent()
        );
    }

    public function test_error_response()
    {
        $errorMessage = 'Something went wrong';
        $response = $this->jsonResponseService->getErrorResponse($errorMessage);

        $this->assertInstanceOf(JsonResponse::class, $response);
        $this->assertEquals(200, $response->getStatusCode());
        $this->assertJsonStringEqualsJsonString(
            json_encode(['success' => false, 'message' => $errorMessage]),
            $response->getContent()
        );
    }
}
