<?php

namespace App\Http\Controllers\Product;

use App\Http\Controllers\Controller;
use App\Managers\Product\ProductManager;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    protected $manager;

    public function __construct()
    {
        $this->manager = new ProductManager();
    }

    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function index(Request $request): JsonResponse
    {
        try {
            $response = $this->manager->doGetBooksByCategory($request);
            if ($response['error']){
                return response()->json([
                    "data" => $response['data'],
                    "message" => $response['message']
                ], 404 );
            } else {
                return response()->json([
                    "data" => $response['data'],
                    "message" => $response['message']
                ], 200 );
            }
        } catch (\Exception $e) {
            return response()->json($e->getMessage(), 500);
        }
    }
}
