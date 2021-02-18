<?php

namespace App\Repositories;

use App\Models\Category as Model;
use Illuminate\Support\Facades\Cache;

class CategoryRepository extends CoreRepository
{

    protected function getModelClass()
    {
        return Model::class;
    }

    public function getCategories()
    {

    }

}
