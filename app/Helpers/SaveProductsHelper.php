<?php

namespace App\Helpers;

use App\Models\Product;

class SaveProductsHelper
{
    public function __construct()
    {
        // Do some magic
    }

    public function manipulateData($productData): string
    {
        try {
            $records = [];
            foreach ($productData as $data) {
                $singleRecord = [
                    'product_id' => $data['id'],
                    'isbn13' =>$data['isbn13'],
                    'title' =>$data['title'],
                    'publication_date' =>$data['publication_date'],
                    'authors' => json_encode($data['authors']),
                    'categories' =>json_encode( $data['categories']),
                    'concept' =>$data['concept'],
                    'language' =>$data['language'],
                    'language_version' =>$data['language_version'] ?? '' ,
                    'tool' =>$data['tool'],
                    'vendor' =>$data['vendor']
                ];
                $records[] = $singleRecord;
            }
            Product::insert($records);
            return "Done!";
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }
}
