<?php

namespace App\Traits;

use GuzzleHttp\Promise\PromiseInterface;
use Illuminate\Http\Client\Response;
use Illuminate\Support\Facades\Http;

trait ApiConnection
{
    public function __construct()
    {
        // Do some magic
    }

    /**
     * @param $limit
     * @param $page
     * @return PromiseInterface|Response
     */
    private function productApiConnection($limit, $page)
    {
        try {
            return Http::withToken(config('packt.token'))->get(config('packt.end_point'), [
                'limit' => $limit,
                'page' => $page
            ]);
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }

    /**
     * @param $id
     * @return PromiseInterface|Response|string
     */
    private function productDetailApiConnection($id)
    {
        try {
            return Http::withToken(config('packt.token'))->get(config('packt.end_point').$id);
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }
}
