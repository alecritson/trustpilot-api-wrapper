<?php

namespace LukeRodham\TrustPilot\Sections;

use LukeRodham\TrustPilot\ApiWrapper;
use LukeRodham\TrustPilot\Transformers\ReviewTransformer;

class Reviews
{
    /**
     * @var ApiWrapper
     */
    private $client;

    /**
     * @param ApiWrapper $client
     */
    public function __construct(ApiWrapper $client)
    {
        $this->client = $client;
    }

    /**
     * @param array $queryParams
     *
     * @return ReviewTransformer[]
     */
    public function latest($queryParams = [])
    {
        $url = '/v1/reviews/latest';

        if ($this->client->getBusinessUnitId() !== '') {
            $url = '/v1/business-units/' . $this->client->getBusinessUnitId() . '/reviews';
        }

        $reviews = $this->client->getClient()->request(
            'GET',
            $url,
            array_merge($this->client->getDefaultHeaders(), ['query' => $queryParams])
        );

        $reviews = json_decode($reviews->getBody()->getContents(), true);

        return (new ReviewTransformer())->transformArray($reviews);
    }

    /**
     * @param array $queryParams
     *
     * @return float
     */
    public function getTrustScore($queryParams = [])
    {
        $url = '/v1/business-units/' . $this->client->getBusinessUnitId();

        $ratings = $this->client->getClient()->request(
            'GET',
            $url,
            array_merge($this->client->getDefaultHeaders(), ['query' => $queryParams])
        );

        $data = json_decode($ratings->getBody()->getContents(), true);

        return $data['trustScore'];
    }

    /**
     * @param array $queryParams
     *
     * @return mixed
     */
    public function getStarRating($queryParams = [])
    {
        $url = '/v1/business-units/' . $this->client->getBusinessUnitId();

        $ratings = $this->client->getClient()->request(
            'GET',
            $url,
            array_merge($this->client->getDefaultHeaders(), ['query' => $queryParams])
        );

        $data = json_decode($ratings->getBody()->getContents(), true);

        return $data['stars'];
    }
}