<?php

namespace Rapidez\MirasvitLabel\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Rapidez\Core\Models\Model;
use Rapidez\MirasvitLabel\Models\MirasvitProductLabelPlaceholder;

class MirasvitProductLabelLabelDisplay extends Model
{
    protected $primaryKey = 'display_id';

    protected $table = 'mst_productlabel_label_display';

    protected $appends = [
        'position',
        'labels_direction',
        'labels_limit',
    ];

    protected $hidden = [
        'placeholder',
        'display_id',
        'type',
        'label_id',
        'placeholder_id',
        'template_id',
        'attribute_option_id',
    ];

    public function placeholder(): HasOne
    {
        return $this->hasOne(MirasvitProductLabelPlaceholder::class, 'placeholder_id', 'placeholder_id');
    }

    protected function position(): Attribute
    {
        return Attribute::make(
            get: function () {
                return $this->placeholder->position;
            }
        );
    }

    protected function labelsDirection(): Attribute
    {
        return Attribute::make(
            get: function () {
                return $this->placeholder->labels_direction;
            }
        );
    }

    protected function labelsLimit(): Attribute
    {
        return Attribute::make(
            get: function () {
                return $this->placeholder->labels_limit;
            }
        );
    }
}
