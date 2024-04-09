<?php

namespace Rapidez\MirasvitLabel\Models\Casts;

use Illuminate\Contracts\Database\Eloquent\CastsAttributes;
use Illuminate\Database\Eloquent\Model;

class CastMirasvitLabelVariables implements CastsAttributes
{

    /**
     * @inheritDoc
     */
    public function get(Model $model, string $key, mixed $value, array $attributes)
    {
        $labels = collect(json_decode($value));

        return $labels;
    }

    /**
     * @inheritDoc
     */
    public function set(Model $model, string $key, mixed $value, array $attributes)
    {
        return $value;
    }
}