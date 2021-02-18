<?php

namespace App\Http\Controllers;

use App\Http\Requests\AddTopicRequest;
use App\Models\Forum;
use App\Models\Post;
use App\Models\Topic;
use Illuminate\Support\Facades\Auth;

class ForumController extends Controller
{
    public function show(string $slug)
    {
        if (!$forum = Forum::where('slug', '=', $slug)->with(['category', 'topics'])->first()) abort(404);

        return view('forums.show', compact('forum'));
    }

    public function showForm(Forum $forum)
    {
        if (!$forum) abort(404);

        return view('topics.add', compact('forum'));
    }

    public function storeTopic(AddTopicRequest $form, Forum $forum)
    {
        /**
         * @var Topic $topic
         */
        $topic = Topic::create([
            'forum_id' => $forum->id,
            'title' => $form->title,
            'poster_id' => Auth::id(),
            'type' => $form->type,
        ]);
        /**
         * @var Post $post
         */
        $post = $topic->posts()->create([
            'forum_id' => $topic->forum_id,
            'poster_id' => $topic->poster_id,
            'text' => $form->message,
            'text_html' => $form->message,
        ]);

        if($post) {
            $topic->first_post_id = $topic->last_post_id = $post->id;
            $topic->last_post_time = $post->created_at;
            $topic->save();
        }

        $forum->last_post_id = $post->id;
        $forum->topics_count += 1;
        $forum->posts_count += 1;
        $forum->save();

        return redirect()
            ->route('topic', ['topic' => $topic->id])
			->withFragment('post-' . $post->id)
            ->with('success', 'Тема успешно создана!');
    }
}
