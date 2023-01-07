<?php

namespace Knownhost\SCP\API;

use GuzzleHttp\Exception\GuzzleException;
use Illuminate\Support\Collection;
use JsonException;

class Admin extends \Knownhost\SCP\SCP
{
    /**
     * Returns all the admin users.
     *
     * @see https://synergycp.com/#admins
     *
     * @throws GuzzleException
     * @throws JsonException
     */
    public function getAll(): Collection
    {
        $response = $this->client->get('admin');

        return new Collection(json_decode($response->getBody()->getContents(), false, 512, JSON_THROW_ON_ERROR));
    }

    /**
     * Returns the admin user with the given ID.
     *
     * @see https://synergycp.com/#admins
     *
     * @param int $id
     *
     * @return Collection
     *
     * @throws GuzzleException
     * @throws JsonException
     */
    public function get(int $id): Collection
    {
        $response = $this->client->get("admin/{$id}");

        return new Collection(json_decode($response->getBody()->getContents(), false, 512, JSON_THROW_ON_ERROR));
    }

    /**
     * Creates a new admin user.
     *
     * @see https://synergycp.com/#admins
     *
     * @param string $email
     * @param string $password
     * @param string|null $username
     * @param bool $receive_copies
     *
     * @return Collection
     *
     * @throws GuzzleException
     * @throws JsonException
     */
    public function create(string $email, string $password, ?string $username = null, bool $receive_copies = false): Collection
    {
        $params = [
            'email' => $email,
            'password' => $password,
            'receive_copies' => $receive_copies,
        ];

        if (!empty($username)) {
            $params['username'] = $username;
        }

        $response = $this->client->post('/admin', [
            'json' => $params,
        ]);

        return new Collection(json_decode($response->getBody()->getContents(), false, 512, JSON_THROW_ON_ERROR));
    }

    /**
     * Updates the admin user with the given ID.
     *
     * @see https://synergycp.com/#admins
     *
     * @param int $id
     * @param string|null $email
     * @param string|null $password
     * @param bool|null $receive_copies
     *
     * @return Collection
     *
     * @throws GuzzleException
     * @throws JsonException
     */
    public function update(int $id, ?string $email, ?string $password, ?bool $receive_copies): Collection
    {
        $params = [];

        if (!empty($email)) {
            $params['email'] = $email;
        }

        if (!empty($password)) {
            $params['password'] = $password;
        }

        if ($receive_copies !== null) {
            $params['receive_copies'] = $receive_copies;
        }

        // If there are no params, throw an exception.
        if (empty($params)) {
            throw new \InvalidArgumentException('You must provide at least one parameter to update.');
        }

        $response = $this->client->patch("/admin/{$id}", [
            'json' => $params,
        ]);

        return new Collection(json_decode($response->getBody()->getContents(), false, 512, JSON_THROW_ON_ERROR));
    }

    /**
     * Deletes the admin user with the given ID.
     *
     * @see https://synergycp.com/#admins
     *
     * @param int $id
     *
     * @return Collection
     *
     * @throws GuzzleException
     * @throws JsonException
     */
    public function delete(int $id): Collection
    {
        $response = $this->client->delete("/admin/{$id}");

        return new Collection(json_decode($response->getBody()->getContents(), false, 512, JSON_THROW_ON_ERROR));
    }

    /**
     * Returns the admin user with the given ID permissions.
     *
     * @see https://synergycp.com/#admins
     *
     * @param int $id
     *
     * @return Collection
     *
     * @throws GuzzleException
     * @throws JsonException
     */
    public function getPermissions(int $id): Collection
    {
        $response = $this->client->get("/admin/{$id}/permission");

        return new Collection(json_decode($response->getBody()->getContents(), false, 512, JSON_THROW_ON_ERROR));
    }

    /**
     * Updates the admin user with the given ID permissions.
     *
     * @see https://synergycp.com/#admins
     *
     * @param int $id
     * @param array $permissions
     *
     * @return Collection
     *
     * @throws GuzzleException
     * @throws JsonException
     */
    public function updatePermissions(int $id, array $permissions): Collection
    {
        $response = $this->client->patch("/admin/{$id}/permission", [
            'json' => $permissions,
        ]);

        return new Collection(json_decode($response->getBody()->getContents(), false, 512, JSON_THROW_ON_ERROR));
    }
}
