<?php
namespace App\Repositories\Neo4j;

use Laudis\Neo4j\ClientBuilder;
use App\Repositories\SubjectRepositoryInterface;

class SubjectNeo4jRepository implements SubjectRepositoryInterface
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
        $query = 'MATCH (s:Subject) RETURN s SKIP 0 LIMIT 10';
        return $this->client->run($query);
    }

    public function getById($id)
    {
        $query = 'MATCH (s:Subject) WHERE id(s) =' . $id . ' RETURN s';
        return $this->client->run($query, ['id' => $id]);
    }

    public function create(array $data)
    {
        $query = 'CREATE (s:Subject {name: $name, code: $code}) RETURN s';
        return $this->client->run($query, $data);
    }

    public function update($id, array $data)
    {
        $query = 'MATCH (s:Subject) WHERE id(s) =' . $id . ' SET s.name = $name, s.code = $code RETURN s';
        return $this->client->run($query, array_merge(['id' => $id], $data));
    }

    public function delete($id)
    {
        $query = 'MATCH (s:Subject) WHERE id(s) =' . $id . ' DELETE s';
        $result = $this->client->run($query, ['id' => $id]);
        if ($result) {
            return response()->json(['message' => 'Subject deleted successfully'], 200);
        } else {
            return response()->json(['message' => 'Failed to delete subject'], 500);
        }
    }
}