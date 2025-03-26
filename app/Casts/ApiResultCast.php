<?php

namespace App\Casts;

use Illuminate\Contracts\Database\Eloquent\CastsAttributes;
use Illuminate\Database\Eloquent\Model;

use App\Helpers\ApiResult;

class ApiResultCast implements CastsAttributes
{
    public function get($model, string $key, $value, array $attributes)
    {
        if (empty($value)) {
            return ApiResult::pending();
        }
        
        return ApiResult::fromJson($value);
    }

    public function set($model, string $key, $value, array $attributes)
    {
        if ($value instanceof ApiResult) {
            return json_encode($value);
        }
        
        // If a raw value is passed, treat it as a success
        return json_encode(ApiResult::success($value));
    }
}
