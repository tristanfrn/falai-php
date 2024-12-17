<?php

namespace Tristanfrn\FalAI;

use Tristanfrn\FalAI\Data\GenerationData;
use Tristanfrn\FalAI\Requests\CreateRequest;
use Tristanfrn\FalAI\Requests\CheckStatus;
use Tristanfrn\FalAI\Requests\GetResult;
use Tristanfrn\FalAI\Requests\CancelRequest;

class GenerationsResource extends Resource
{
    protected ?string $webhookUrl = null;

    public function create(string $model, array $input): GenerationData
    {
        $request = new CreateRequest($model, $input, $this->webhookUrl);
        $response = $this->connector->send($request);
        return GenerationData::fromResponse($response);
    }

    public function checkStatus(string $model, string $requestId): GenerationData
    {
        $request = new CheckStatus($model, $requestId);
        $response = $this->connector->send($request);
        return GenerationData::fromResponse($response);
    }

    public function getResult(string $model, string $requestId): GenerationData
    {
        $request = new GetResult($model, $requestId);
        $response = $this->connector->send($request);
        return GenerationData::fromResponse($response);
    }

    public function cancel(string $model, string $requestId): GenerationData
    {
        $request = new CancelRequest($model, $requestId);
        $response = $this->connector->send($request);
        return GenerationData::fromResponse($response);
    }

    public function withWebhook(string $url): self
    {
        $this->webhookUrl = $url;
        return $this;
    }
}