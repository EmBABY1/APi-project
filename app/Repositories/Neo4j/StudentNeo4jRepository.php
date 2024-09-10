<?php
namespace App\Repositories\Neo4j;

use Laudis\Neo4j\ClientBuilder;
use App\Repositories\StudentRepositoryInterface;

class StudentNeo4jRepository implements StudentRepositoryInterface
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
        $query = 'MATCH (s:Student) RETURN s SKIP 0 LIMIT 10';
        return $this->client->run($query);
    }
    public function get_student_subject()
    {
        $query = 'MATCH (stu:Student)-[:REGISTERED_IN]->(sub:Subject) RETURN stu.name, collect(sub.name) AS subjects LIMIT 10;';
        return $this->client->run($query);
    }

    public function create_student_subject(array $data)
    {
        $query = '
           MATCH (stu:Student), (sub:Subject) WHERE stu.name = $stname AND sub.name = $subname CREATE (stu)-[:REGISTERED_IN]->(sub);';

        $result = $this->client->run(
            $query,
            $data
        );

        if ($result) {
            return response()->json([
                'success' => true,
                'message' => 'Student successfully registered in the subject.'
            ], 200);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Failed to register the student in the subject.'
            ], 500);
        }
    }

    public function getById($id)
    {

        $query = 'MATCH (s:Student) WHERE id(s) =' . $id . ' RETURN s';
        return $this->client->run($query, ['id' => $id]);
    }

    public function create(array $data)
    {
        $query = 'CREATE (s:Student {name: $name, age: $age, school_id:$school_id}) RETURN s';
        return $this->client->run($query, $data);
    }

    public function update($id, array $data)
    {
        $query = 'MATCH (s:Student) WHERE id(s) =' . $id . ' SET s.name = $name, s.age = $age ,s.school_id=$school_id RETURN s';
        return $this->client->run($query, array_merge(['id' => $id], $data));
    }

    public function delete($id)
    {
        $query = 'MATCH (s:Student) WHERE id(s) =' . $id . ' DELETE s';
        $result = $this->client->run($query, ['id' => $id]);
        if ($result) {
            return response()->json(['message' => 'Student deleted successfully'], 200);
        } else {
            return response()->json(['message' => 'Failed to delete student'], 500);
        }
    }
}