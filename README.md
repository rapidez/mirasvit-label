# Rapidez mirasvit-label

This package adds Mirasvit label compatibility to Rapidez.

## Requirements
For this module to work you need to have the [Mirasvit labels](https://mirasvit.com/magento-2-extensions/product-labels.html) module installed.

## Installation

```
composer require rapidez/mirasvit-label
```

## Views

You can publish the views with:
```
php artisan vendor:publish --tag=mirasvitlabel-views
```

### Product page
Add `@include('mirasvitlabel::product.label')` where you'd like to display the labels, most likely somewhere around the images: `resources/views/vendor/rapidez/product/overview.blade.php`.

### Category page
Add `@include('mirasvitlabel::category.label')` in: `resources/views/vendor/rapidez/category/partials/listing/item.blade.php`.

## Notes
Not all features of Mirasvit product labels are integrated yet. Missing features are:
* Label directions
* Images
* Product variables

## License

GNU General Public License v3. Please see [License File](LICENSE) for more information.
