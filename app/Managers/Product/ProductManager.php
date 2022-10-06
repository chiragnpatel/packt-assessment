<?php

namespace App\Managers\Product;

use App\Http\Resources\ProductDetailCollection;
use App\Models\Category;
use App\Models\ProductDetail;


class ProductManager
{
    const LIMIT = 9;
    public function doGetBooksByCategory($data)
    {
        try {
            $limit = $data->route('limit') ?? self::LIMIT;
            $categoryID = $data->route('id');
            $isExist = Category::FindOrFail($categoryID);
            if ($isExist) {
                $response = ProductDetail::select('id','isbn13','title','authors','url','publication_date','length','pages')
                ->where('product_type',ProductDetail::BOOK)
                ->where('category',$categoryID)
                    ->limit($limit)
                    ->orderBy('title')
                    ->get();
                return [
                    "data" => ProductDetailCollection::collection($response),
                    "message" => "Category Data fetched Successfully!",
                    "error" => false
                ];
            } else {
                return [
                    "data" => [],
                    "message" => "Please Provide valid category id!",
                    "error" => true
                ];
            }

        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }
}
