<?php

declare(strict_types=1);

namespace Caesar\SecurityMessageBundle\Tests;

use Symfony\Bundle\FrameworkBundle\Client as SymfonyClient;

class Client extends SymfonyClient
{
    /**
     * @return array
     */
    public function getJsonResponse(): ?array
    {
        $json = $this->getResponse()->getContent();

        return json_decode($json, true);
    }

    /**
     * @return int
     */
    public function getResponseCode()
    {
        return parent::getResponse()->getStatusCode();
    }

    /**
     * @param string $url
     * @param array $payload
     * @param string $type
     */
    public function sendJson(string $url, array $payload, string $type = 'POST'): void
    {
        $this->request(
            $type,
            $url,
            [],
            [],
            ['CONTENT_TYPE' => 'application/json'],
            json_encode($payload)
        );
    }

    /**
     * @param string $url
     * @param array $fileCollection
     */
    public function sendFiles(string $url, array $fileCollection): void
    {
        $this->request(
            'POST',
            $url,
            [],
            $fileCollection,
            ['CONTENT_TYPE' => 'application/x-www-form-urlencoded']
        );
    }
}
