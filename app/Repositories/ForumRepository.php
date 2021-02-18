<?php

namespace App\Repositories;

use App\Models\Forum as Model;

class ForumRepository extends CoreRepository
{
    protected function getModelClass()
    {
        return Model::class;
    }

    public function getForumBySlug(string $slug)
    {
        $forum = Model::where('slug', $slug)
            //->with('forums.')
        ;

        return ($forum) ?? null;
    }
}
