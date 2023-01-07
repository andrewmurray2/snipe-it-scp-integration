<?php

namespace Knownhost\SCP;

use GuzzleHttp\Client;
use Knownhost\SCP\API\Admin as AdminAPI;
use Knownhost\SCP\API\Client as ClientAPI;
use RuntimeException;

class SCP
{
    /**
     * Guzzle Client
     *
     * @var Client|null
     */
    protected ?Client $client = null;

    /**
     * @throws RuntimeException
     */
    public function __construct()
    {
        // Ensure that the config values are set before we do anything else.
        $this->ensureConfigValuesAreSet();

        // Validate the config values.
        $this->validateConfigValues();

        // Initialize guzzle client for API calls.
        $this->initializeGuzzleClient();
    }

    /**
     * Initialize the Guzzle client.
     *
     * @return void
     */
    private function initializeGuzzleClient(): void
    {
        // If the client is already initialized, return out.
        if ($this->client instanceof Client) {
            return;
        }

        // Initialize the client.
        $this->client = new Client([
            'base_uri' => config('synergycp.use_ssl') ? 'https://'.config('synergycp.host') : 'http://'.config('synergycp.host'),
            'query' => [
                'key' => config('synergycp.auth.api_key'),
            ],
            'verify' => config('synergycp.ssl_verify'),
        ]);
    }

    /**
     * Check that the config values are set. If not, throw an exception.
     *
     * @return void
     *
     * @throws RuntimeException
     */
    private function ensureConfigValuesAreSet(): void
    {
        $config = config('synergycp');

        if (empty($config['host'])) {
            throw new RuntimeException('SCP_HOST is not set in your .env file.');
        }

        if (empty($config['auth']['api_key'])) {
            throw new RuntimeException('SCP_API_KEY is not set in your .env file.');
        }
    }

    /**
     * Validates the config values.
     *
     * @return void
     *
     * @throws RuntimeException
     */
    private function validateConfigValues(): void
    {
        $config = config('synergycp');

        if (! is_bool($config['use_ssl'])) {
            throw new RuntimeException('SCP_USE_SSL must be a boolean value.');
        }

        if (! is_bool($config['ssl_verify'])) {
            throw new RuntimeException('SCP_SSL_VERIFY must be a boolean value.');
        }

        $scheme = $config['use_ssl'] ? 'https' : 'http';

        // Check that the host is a valid URL.
        // We're expecting something like api.<domain>.<tld>
        if (! filter_var($scheme.'://'.$config['host'], FILTER_VALIDATE_URL)) {
            throw new RuntimeException('SCP_HOST must be a valid URL.');
        }

        // API key should be 50 characters long. Anything else is invalid.
        if (strlen($config['auth']['api_key']) !== 50) {
            throw new RuntimeException('SCP_API_KEY must be 50 characters long.');
        }
    }

    /**
     * Returns the Admin API Class.
     *
     * @return AdminAPI
     */
    public function admin(): AdminAPI
    {
        return new AdminAPI;
    }

    /**
     * Returns the Client API Class.
     *
     * @return ClientAPI
     */
    public function client(): ClientAPI
    {
        return new ClientAPI;
    }

}
