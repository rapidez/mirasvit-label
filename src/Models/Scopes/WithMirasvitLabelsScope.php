<?php

namespace Rapidez\MirasvitLabel\Models\Scopes;

use Illuminate\Database\Eloquent\Scope;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class WithMirasvitLabelsScope implements Scope
{
    public function apply(Builder $builder, Model $model)
    {
        $builder->selectRaw('JSON_REMOVE(JSON_OBJECTAGG(IFNULL(label_index.label_id, "null_"), JSON_OBJECT(
                "prod_title", prod.title,
                "prod_position", prod_position.code,
                "prod_style", prod.style,
                "cat_title", cat.title,
                "cat_position", cat_position.code,
                "cat_style", cat.style
        )), "$.null__") as mirasvit_label')
            ->leftJoin('mst_productlabel_index as label_index', 'label_index.product_id', '=', $model->getTable() .'.entity_id')
            ->leftJoin('mst_productlabel_label_display as prod', function($join) {
                $join->on('prod.label_id', '=', 'label_index.label_id')
                    ->where('prod.type', '=', 'view');
            })
            ->leftJoin('mst_productlabel_label_display as cat', function($join) {
                $join->on('cat.label_id', '=', 'label_index.label_id')
                    ->where('cat.type', '=', 'list');
            })
            ->leftJoin('mst_productlabel_placeholder as cat_position', 'cat_position.placeholder_id', '=', 'cat.placeholder_id')
            ->leftJoin('mst_productlabel_placeholder as prod_position', 'prod_position.placeholder_id', '=', 'prod.placeholder_id');
    }
}
