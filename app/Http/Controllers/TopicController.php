<?php

namespace App\Http\Controllers;

use App\Http\Requests\TopicReplyRequest;
use App\Models\Forum;
use App\Models\Post;
use App\Models\Topic;
use App\Repositories\PostRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TopicController extends Controller
{
    /**
     * @param int $topicId
     * @param PostRepository $postRepository
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function show(int $topicId, PostRepository $postRepository)
    {
        if(!$topic = Topic::where('id', $topicId)->with(['forum', 'author'])->first()) abort(404);

        $posts = $postRepository->findByTopic($topic);

        return view('topics.show', compact('topic', 'posts'));
    }

    public function storeReply(TopicReplyRequest $reply)
    {
        /**
         * @var Topic $topic
         */
        $topic = Topic::where('id', $reply->t)->first();

        /**
         * @var Forum $forum
         */
        $forum = Forum::find($topic->forum_id);

        /**
         * @var Post $post
         */
        $post = $topic->posts()->create([
            'forum_id' => $topic->forum_id,
            'poster_id' => Auth::id(),
            'text' => $reply->reply_message,
            'text_html' => $reply->reply_message
        ]);

        $topic->last_post_id = $post->id;
        $topic->last_post_time = $post->created_at;
        $topic->save();

        $forum->last_post_id = $post->id;
        $forum->posts_count += 1;
        $forum->save();

        if($post) return redirect()->to(route('topic', ['topic' => $topic->id]))
            ->withFragment("#post-{$post->id}");
    }
}
