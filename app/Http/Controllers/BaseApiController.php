<?php

namespace App\Http\Controllers;

use Illuminate\Http\JsonResponse;
use League\Fractal\Resource\Collection;
use League\Fractal\Pagination\IlluminatePaginatorAdapter;
use League\Fractal\Resource\Item;
use League\Fractal\Resource\ResourceInterface;
use League\Fractal\TransformerAbstract;
use Closure;

class BaseApiController extends Controller
{
    /**
     * Function returns item.
     *
     * @param $item
     * @param TransformerAbstract $transformer
     * @param Closure|null $callback
     *
     * @return JsonResponse
     */
    public function item($item, TransformerAbstract $transformer, Closure $callback = null): JsonResponse
    {
        $resource = new Item($item, $transformer);

        if (!is_null($callback)) {
            call_user_func($callback, $resource);
        }
        return $this->buildResponse($resource);
    }

    /**
     * Function converts JsonResponse.
     *
     * @param ResourceInterface $resource Resources
     *
     * @return JsonResponse
     */
    private function buildResponse(ResourceInterface $resource): JsonResponse
    {
        $data = app('fractal_manager')->createData($resource);
        return $this->returnJsonResponse($data->toArray());
    }

    /**
     * Function to return json response.
     *
     * @param array $data       response data
     * @param int $statusCode status code
     *
     * @return JsonResponse
     */
    public function returnJsonResponse(array $data, int $statusCode = 200): JsonResponse
    {
        return new JsonResponse($data, $statusCode);
    }

    /**
     * Function to send error message in json.
     *
     * @param string $message error message
     * @param int $statusCode status code
     *
     * @return JsonResponse
     */
    public function abortJsonResponse(string $message, int $statusCode): JsonResponse
    {
        return $this->returnJsonResponse(['message' => $message], $statusCode);
    }

    /**
     * Function to get data in paginated.
     *
     * @param $items
     * @param TransformerAbstract $transformer
     * @param Closure|null $callback
     * @return JsonResponse
     */
    public function paginateCollection($items, TransformerAbstract $transformer, Closure $callback = null): JsonResponse
    {
        if (method_exists($items, 'paginate') === true) {
            $paginator = $items->paginate(app('request')->query('perPage', 20));
            $paginator->appends(app('request')->query());
        } else {
            $paginator = $items;
        }
        $resource = new \Illuminate\Support\Collection($paginator, $transformer);
        if (!is_null($callback)) {
            call_user_func($callback, $resource);
        }
        $resource->setPaginator(new IlluminatePaginatorAdapter($paginator));
        return $this->buildResponse($resource);
    }

    /**
     * Function returns collection.
     * @param $items
     * @param TransformerAbstract $transformer
     * @param Closure|null $callback
     * @return JsonResponse
     */
    public function collection($items, TransformerAbstract $transformer, Closure $callback = null): JsonResponse
    {
        $resources = new \Illuminate\Support\Collection($items, $transformer);
        if (!is_null($callback)) {
            call_user_func($callback, $resources);
        }

        return $this->buildResponse($resources);
    }

    public function ApiResponseError($data, $message, $code,$error=array()) {
        $responseArr = ['response_code' => $code, 'success' => false, 'message' => $message,'error'=>$error, 'data' => $data];
        return response($responseArr, $code);
    }

    public function ApiResponseSuccess($data, $message, $code) {
        $responseArr = ['response_code' => $code, 'success'=>true, 'message'=>$message, 'data' => $data ];
        return response($responseArr, $code);
    }
}
