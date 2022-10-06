<?php

namespace App\Helpers;

use App\Models\ProductCategory;
use App\Models\ProductDetail;
use Carbon\Carbon;

class SaveProductDetailHelper
{
    public function __construct()
    {
        // Do some magic
    }

    public function manipulateDetailData($detailData, $product)
    {
        try {
            $productType = config('product_types');
            $categories = config('categories');
            if (!is_null($product) && isset($detailData['id'])) {
                ProductDetail::updateOrCreate(
                    [
                        'isbn13' => $detailData['id']
                    ],
                    [
                        'product_id' => $product->id,
                        'isbn10' => $detailData['isbn10'],
                        'isbns' => json_encode($detailData['isbns']),
                        'title' => $detailData['title'],
                        'product_type' => $productType[$detailData['product_type']],
                        'tagline' => $detailData['tagline'],
                        'pages' => $detailData['pages'],
                        'publication_date' => Carbon::parse($detailData['publication_date'])->format('Y-m-d H:i:s'),
                        'length' => $detailData['length'],
                        'learn' => $detailData['learn'],
                        'features' => $detailData['features'],
                        'description' => $detailData['description'],
                        'authors' => json_encode($detailData['authors']),
                        'url' => $detailData['url'],
                        'category' => $categories[$detailData['category']] ?? 1,
                        'concept' => json_encode($detailData['concept']),
                        'expertise' => $detailData['expertise'] ?? '',
                        'languages' => json_encode($detailData['languages']),
                        'tools' => json_encode($detailData['tools']),
                        'jobroles' => json_encode($detailData['jobroles']),
                        'vendors' => json_encode($detailData['vendors']),
                        'images' => json_encode($detailData['images'])
                    ]
                );
                ProductCategory::updateOrCreate(
                    [
                        "product_id" => $product->id,
                        "category_id" => $categories[$detailData['category']] ?? 1
                    ],
                    [
                        "product_id" => $product->id,
                        "category_id" => $categories[$detailData['category']] ?? 1
                    ]
                );
                $product->product_type = $productType[$detailData['product_type']];
                $product->save();
            }
        } catch (\Exception $e) {
            dd($e->getMessage());
        }
    }
}
