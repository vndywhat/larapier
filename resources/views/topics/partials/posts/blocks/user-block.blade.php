<?php
/**
 * @var \App\Models\Topic $topic
 * @var \App\Models\Post $post
 */
?>
<div class="col-sm-2">
	<div class="user__avatar text-center">
		@if($topic->author->id === $post->author->id)
			<div id="ts">
				<img title="Автор" src="{{ asset('images/tc.gif') }}">
			</div>
		@endif
		<img class="img-bordered img-circle"
			 src="{{ asset('images/noavatar.png') }}"
			 width="100"
			 height="100"
			 alt="Аватара"
		>
	</div>
	<div class="user__username text-center m-2">
		<span>{{ $post->author->username }}</span>
	</div>
	<div class="user__rank text-center m-2">
		<img src="{{ asset('images/ranks/admin.png') }}" alt="">
	</div>
	<div class="user__info text-center border-gray-dark">
		<ul class="products-list product-list-in-card">
			<li class="item pb-1">
				<span class="float-left">Пол:</span>
				<span class="float-right text-muted">{{ $post->author->gender }}</span>
			</li>
			<li class="item pb-1">
				<span class="float-left">Стаж:</span>
				<span class="float-right text-muted"
					  title="{{ $post->author->created_at->format('d.m.Y') }}"
				>{{ $post->author->joinedDate() }}</span>
			</li>
			<li class="item">
				<span class="float-left">Сообщений:</span>
				<span class="float-right text-muted">{{ $post->author->posts_count }}</span>
			</li>
		</ul>
	</div>
	<div class="user__actions text-center">
		<a
			class="btn btn-sm btn-outline-primary"
			href="{{ route('user', ['id' => $post->author->id]) }}"
		>
			<i class="fas fa-user"></i> Профиль
		</a>

		<a href="#" class="btn btn-sm btn-outline-primary">
			<i class="far fa-envelope"></i> ЛС
		</a>
	</div>
</div>
