<?php

namespace App\Services;
use App\Contracts\InjectionServiceInterface;
class InjectionService
{
    public function inject(InjectionServiceInterface $injector, array $data)
    {
        return $injector->injectData($data);
    }
}
