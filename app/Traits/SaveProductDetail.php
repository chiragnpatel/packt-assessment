<?php

namespace App\Traits;

trait SaveProductDetail
{
    public function manipulateDetailData($productDetail,$product)
    {
        try {
            dd($product->id);
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }
}
