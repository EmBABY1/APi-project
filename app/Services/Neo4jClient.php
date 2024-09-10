<?php

namespace App\Services;

use Laudis\Neo4j\ClientBuilder;

class Neo4jClient
{
    protected $client;

    public function __construct()
    {
        $this->client = ClientBuilder::create()
            ->withDriver('default', 'bolt://' . config('neo4j.username') . ':' . config('neo4j.password') . '@' . config('neo4j.host') . ':' . config('neo4j.port'))
            ->build();
    }

    public function query($cypher, $parameters = [])
    {
        return $this->client->run($cypher, $parameters);
    }
}