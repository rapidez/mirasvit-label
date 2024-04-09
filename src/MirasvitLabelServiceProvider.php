<?php

namespace Rapidez\MirasvitLabel;

use Illuminate\Support\ServiceProvider;
use Rapidez\MirasvitLabel\Models\Casts\CastMirasvitLabelVariables;
use Rapidez\MirasvitLabel\Models\Scopes\WithMirasvitLabelsScope;
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
        Eventy::addFilter('product.scopes', fn ($scopes) => array_merge($scopes ?: [], [WithMirasvitLabelsScope::class]));
        Eventy::addFilter('product.casts', fn ($casts) => array_merge($casts ?: [], ['mirasvit_label' => CastMirasvitLabelVariables::class]));
        Eventy::addFilter('index.product.mapping', fn ($mapping) => array_merge_recursive($mapping ?: [], [
            'properties' => [
                'mirasvit_label' => [
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
        ], 'views');

        return $this;
    }
}
