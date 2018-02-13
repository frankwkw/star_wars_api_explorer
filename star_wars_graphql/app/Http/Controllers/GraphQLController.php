<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use GraphQL\GraphQL;
use GraphQL\Type\Schema;
use \GraphQL\Error\FormattedError;
use App\GraphQL\Types\SWAPITypes;

class GraphQLController extends Controller
{
    /**
     * Perform a GraphQL query
     *
     * @return Response
     */
    public function query(Request $request) {
        try {
            // Parse incoming query and variables
            if ($request->hasHeader('Content-Type') && strpos($request->header('Content-Type'), 'application/json') !== false) {
                $raw = file_get_contents('php://input') ?: '';
                $data = json_decode($raw, true) ?: [];
            } else {
                $data = $request->all();
            }

            // Retrieve query, defaulting to person list if not provided
            $data += ['query' => null, 'variables' => null];
            if ($data['query'] === null) {
                $data['query'] = '{allPeople{id name}}';
            }

            // GraphQL schema to be passed to query executor
            $schema = new Schema([
                'query' => SWAPITypes::Query()
            ]);

            $result = GraphQL::executeQuery(
                $schema,
                $data['query'],
                null,
                null,
                (array) $data['variables']
            );

            // Indicate error code if any were returned
            if (empty($result->errors) === true) {
                $httpStatus = 200;
            } else {
                $httpStatus = 400;
            }

            $output = $result->toArray(false);

        } catch (\Exception $error) {
            $httpStatus = 500;
            $output['errors'] = [
                FormattedError::createFromException($error, false)
            ];
        }

        return (new Response(json_encode($output), $httpStatus))
            ->header('Content-Type', 'application/json');
    }
}
