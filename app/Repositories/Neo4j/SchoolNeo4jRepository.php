<?php
namespace App\Repositories\Neo4j;

use Laudis\Neo4j\ClientBuilder;
use App\Repositories\SchoolRepositoryInterface;

class SchoolNeo4jRepository implements SchoolRepositoryInterface
{
    protected $client;

    public function __construct()
    {
        $this->client = ClientBuilder::create()
            ->withDriver('bolt', 'bolt://neo4j:password@localhost')
            ->build();
    }

    public function getAll()
    {
        $query = 'MATCH (s:School) RETURN s SKIP 0 LIMIT 10';
        return $this->client->run($query);
    }

    public function getById($id)
    {
        $query = 'MATCH (s:School) WHERE id(s) =' . $id . ' RETURN s';
        return $this->client->run($query, ['id' => $id]);
    }

    public function create(array $data)
    {
        $query = 'CREATE (s:School {name: $name, address: $address}) RETURN s';
        return $this->client->run($query, $data);
    }

    public function update($id, array $data)
    {
        $query = 'MATCH (s:School) WHERE id(s) =' . $id . ' SET s.name = $name, s.address = $address RETURN s';
        return $this->client->run($query, array_merge(['id' => $id], $data));
    }

    public function delete($id)
    {
        $query = 'MATCH (s:School) WHERE id(s) =' . $id . ' DELETE s';
        $result = $this->client->run($query, ['id' => (int) $id]);

        // Check if the query was executed successfully (you can customize this based on your Neo4j client)
        if ($result) {
            return response()->json(['message' => 'School deleted successfully'], 200);
        } else {
            return response()->json(['message' => 'Failed to delete school'], 500);
        }
    }
}