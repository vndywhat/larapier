<?php

namespace App\Repositories;

use Illuminate\Database\Eloquent\Model;

abstract class CoreRepository
{
    abstract protected function getModelClass();

    /**
     * @var Model
     */
    private $model;

    /**
     * CoreRepository constructor.
     */
    public function __construct()
    {
        $this->model = app($this->getModelClass());
    }

    /**
     * @return \Illuminate\Contracts\Foundation\Application|Model|mixed
     */
    protected function startConditions()
    {
        return clone $this->model;
    }
}
