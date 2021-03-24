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

    public function storeTopic(AddTopicRequest $validatedForm, Forum $forum)
    {
        /**
         * @var Topic $topic
         */
        $topic = Topic::create([
            'forum_id' => $forum->id,
            'title' => $validatedForm->title,
            'poster_id' => Auth::id(),
            'type' => $validatedForm->type,
        ]);
        /**
         * @var Post $post
         */
        $post = $topic->posts()->create([
            'forum_id' => $topic->forum_id,
            'poster_id' => $topic->poster_id,
            'text' => $validatedForm->message,
            'text_html' => $validatedForm->message,
        ]);

        if($post) {
        	$topic->update([
        		'first_post_id' => $post->id,
        		'last_post_id' => $post->id,
				'last_post_time' => $post->created_at,
			]);
        }
		$forum->update([
			'last_post_id' => $post->id,
			'topics_count' => $forum->topics_count + 1,
			'posts_count' => $forum->posts_count + 1,
		]);

        /*$forum->increment('topics_count');
        $forum->last_post_id = $post->id;
        $forum->topics_count += 1;
        $forum->posts_count += 1;*/

        $forum->save();

        return redirect()
            ->route('topic', ['topic' => $topic->id])
			->withFragment('post-' . $post->id)
            ->with('success', 'Тема успешно создана!');
    }
}
