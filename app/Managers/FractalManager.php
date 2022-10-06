<?php

namespace App\Managers;

use League\Fractal\Manager;
use League\Fractal\Serializer\DataArraySerializer;

/**
 * Class Fractal manager
 */
class FractalManager extends Manager
{
    /**
     * FractalManager constructor.
     */
    public function __construct()
    {
        $this->setSerializer(new DataArraySerializer());
        $includesParam = app('request')->query(
            'includes',
            app('request')->get('includes', '')
        );
        $this->parseIncludes($includesParam);
        parent::__construct();
    }
}
