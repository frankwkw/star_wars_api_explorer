<?php

use Laravel\Lumen\Testing\DatabaseMigrations;
use Laravel\Lumen\Testing\DatabaseTransactions;

class GraphQLPeopleTest extends TestCase
{
    /**
     * Test GET query to Star Wars API
     *
     * @return void
     */
    public function testGETQueryToSWAPI()
    {
        $this->get('/api/graphql')
            ->seeJsonContains(
                ['id' => '1']
            );

        $this->assertEquals(
            200, $this->response->getStatusCode()
        );
    }

    /**
     * Test POST query with sub-resource enrichment to Star Wars API
     *
     * @return void
     */
    public function testPOSTQueryToSWAPI()
    {
        $this->post('/api/graphql', ['query' => '{person(id: 2){id homeworld{name} films{title}}}'])
            ->seeJsonContains(
                ['id' => '2']
            )
            ->dontSeeJson(
                ['id' => '1']
            );

        $this->assertEquals(
            200, $this->response->getStatusCode()
        );
    }

    /**
     * Test validation of Person type
     *
     * @return void
     */
    public function testPersonTypeValidation()
    {
        $this->post('/api/graphql', ['query' => '{person{clowns}}'])
            ->seeJsonContains(
                ['message' => 'Cannot query field "clowns" on type "Person".']
            );

        $this->assertEquals(
            400, $this->response->getStatusCode()
        );
    }
}
