<?php

namespace App\Repositories;

use App\Models\Post as Model;
use App\Models\Topic;
use Illuminate\Support\Facades\Cache;

class PostRepository extends CoreRepository
{

    protected function getModelClass()
    {
        return Model::class;
    }

    public function findByTopic(Topic $topic)
    {
        $posts = Model::where('topic_id', $topic->id)
            ->with('author')
            ->orderBy('created_at')
            ->paginate(10);

        return $posts;
    }

    public function findLastPostById(int $postId)
    {
        $post = Model::find($postId)->with('author')->first();

        dd($post);
    }

}
