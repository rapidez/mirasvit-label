<?php

namespace Rapidez\MirasvitLabel;

use Illuminate\Support\ServiceProvider;
use Rapidez\Core\Models\Product;
use Rapidez\MirasvitLabel\Models\MirasvitProductLabelIndex;
use Rapidez\MirasvitLabel\Models\Scopes\WithMirasvitListLabels;
use Rapidez\MirasvitLabel\Models\Scopes\WithMirasvitViewLabels;
 use TorMorten\Eventy\Facades\Eventy;

class MirasvitLabelServiceProvider extends ServiceProvider
{
    public function boot()
    {
        $this->bootEventyFilters()
            ->bootViews();
    }

    protected function bootEventyFilters(): static
    {
        Eventy::addFilter('productpage.scopes', fn ($scopes) => array_merge($scopes ?: [], [WithMirasvitViewLabels::class]));
        Eventy::addFilter('index.product.scopes', fn ($scopes) => array_merge($scopes ?: [], [WithMirasvitListLabels::class]));
        Eventy::addFilter('index.product.data', function ($data, $product) {
            /** @var Product $product */
            $data['mirasvit_labels'] = $product->mirasvit_labels?->map?->listLabel;

            return $data;
        }, arguments: 2);

        Product::resolveRelationUsing('mirasvit_labels', function ($product) {
            /** @var Product $product */
            return $product->hasMany(MirasvitProductLabelIndex::class, 'product_id', 'entity_id');
        });

        Eventy::addFilter('index.product.mapping', fn ($mapping) => array_merge_recursive($mapping ?: [], [
            'properties' => [
                'mirasvit_labels' => [
                    'type' => 'flattened',
                ],
            ],
        ]));

        return $this;
    }

    protected function bootViews(): static
    {
        $this->loadViewsFrom(__DIR__.'/../resources/views', 'mirasvitlabel');

        $this->publishes([
            __DIR__.'/../resources/views' => resource_path('views/vendor/mirasvitlabel'),
        ], 'mirasvitlabel-views');

        return $this;
    }
}
