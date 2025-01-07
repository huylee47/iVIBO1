<?php

namespace App\Service\CommonServices;

use Illuminate\Http\Request;

class QueryFilterService
{
    protected $safeParams = [];

    protected $operatorMap = [
        'eq' => '=',
        'neq' => '!=',
        'gt' => '>',
        'gte' => '>=',
        'lt' => '<',
        'lte' => '<=',
    ];

    public function transform(Request $request): array
    {
        $eloquentQuery = [];
        foreach ($this->safeParams as $param => $operators) {
            $queryParam = $request->query($param);
            if (!isset($queryParam)) {
                continue;
            }
            foreach ($operators as $operator) {
                if (isset($queryParam[$operator])) {
                    $eloquentQuery[] = [
                        $param,
                        $this->operatorMap[$operator],
                        $queryParam[$operator],
                    ];
                }
            }
        }

        return $eloquentQuery;
    }
}
