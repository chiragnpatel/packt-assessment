<?php

namespace App\Helpers;

use App\Models\Product;
use App\Traits\ApiConnection;

class ProductsSyncHelper
{
    use ApiConnection;
    const LIMIT = 1000;
    const PAGE = 1;

    public function __construct()
    {
        // do some magic
    }

    /**
     * @param int $page
     * @return string
     */
    public function getProducts(int $page = self::PAGE): string
    {
        try {
            $limit = self::LIMIT;
            $productsObj = $this->productApiConnection($limit, $page);
            if (count($productsObj['products']) != 0) {
                echo $page;
                echo count($productsObj['products']);
                $sendData = new SaveProductsHelper();
                $sendData->manipulateData($productsObj['products']);
                $page++;
                $this->getProducts($page);
            }
            return 'Done!';
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }

    /**
     * @return string
     */
    public function getProductDetail(): string
    {
        try {
            Product::chunk(500,function ($records){
                foreach ($records as $data) {
                    $productDetail = $this->productDetailApiConnection($data->product_id);
                    $sendDetailData = new SaveProductDetailHelper();
                    $sendDetailData->manipulateDetailData($productDetail->json(),$data);
                }
            });
            return 'Done!';
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }
}
