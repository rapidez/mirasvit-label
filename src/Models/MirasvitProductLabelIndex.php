<?php

namespace Rapidez\MirasvitLabel\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Rapidez\Core\Models\Model;

class MirasvitProductLabelIndex extends Model
{
    protected $primaryKey = 'id';

    protected $table = 'mst_productlabel_index';

    protected static function booted(): void
    {
        static::addGlobalScope('default', function (Builder $query) {
            $query->where('store_id', config('rapidez.store'));
        });
    }

    public function displayIds(): Attribute
    {
        return Attribute::make(
            get: function ($value) {
                return explode(',', $value);
            }
        );
    }

    public function customerGroups(): Attribute
    {
        return Attribute::make(
            get: function ($value) {
                return explode(',', $value);
            }
        );
    }

    public function product(): BelongsTo
    {
        return $this->belongsTo(config('rapidez.models.product'), 'entity_id', 'product_id');
    }

    public function viewLabel(): HasOne
    {
        return $this->hasOne(MirasvitProductLabelLabelDisplay::class, 'label_id', 'label_id')->whereIn('type', ['view', 'both']);
    }

    public function listLabel(): HasOne
    {
        return $this->hasOne(MirasvitProductLabelLabelDisplay::class, 'label_id', 'label_id')->whereIn('type', ['list', 'both']);
    }
}
