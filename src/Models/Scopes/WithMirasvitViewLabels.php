<?php

namespace Rapidez\MirasvitLabel\Models\Scopes;

use Illuminate\Database\Eloquent\Scope;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class WithMirasvitViewLabels implements Scope
{
    public function apply(Builder $builder, Model $model)
    {
        $builder->with('mirasvit_labels.viewLabel.placeholder');
    }
}
