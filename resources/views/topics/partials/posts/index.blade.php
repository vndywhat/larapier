<?php
/**
 * @var \App\Models\Topic $topic
 * @var \App\Models\Post $post
 */
?>

<div class="card" id="post-{{ $post->id }}">
	<div class="card-body">
		<div class="row">
			@include('topics.partials.posts.blocks.user-block', ['topic' => $topic, 'post' => $post])

			<div class="col-sm-10">
				<div class="row">
					<div class="col-sm-12 border-bottom mb-2 p-0 pb-1">
						<div class="float-left">
							<i class="far fa-clipboard"></i>
							<a href="#post-{{ $post->id }}" title="Линк на это сообщение">{{ $post->created_at->format('d.m.Y H:i') }}</a>
						</div>
						<div class="float-right">
							<div class="btn-group">
								<button class="btn btn-sm btn-outline-primary" title="Добавить опрос">
									<i class="fas fa-poll"></i>
								</button>
								<button class="btn btn-sm btn-outline-primary" title="Ответить с цитатой">
									<i class="fas fa-quote-left"></i>
								</button>
								<button class="btn btn-sm btn-outline-primary" title="Редактировать сообщение">
									<i class="fas fa-edit"></i>
								</button>
								<button class="btn btn-sm btn-outline-primary" title="Показать IP адрес автора">
									<i class="fas fa-map-marker-alt"></i>
								</button>
								<button class="btn btn-sm btn-outline-primary" title="Комментарий">
									<i class="fas fa-comment-medical"></i>
								</button>
								<button class="btn btn-sm btn-outline-primary" title="Модерировать сообщения">
									<i class="fab fa-monero"></i>
								</button>
							</div>
						</div>
					</div>
					<div class="col-sm-12">
						<span class="newIndicator"><span></span>Новое</span>
						<div class="post-body pb-2">
							{!! $post->text_html  !!}
						</div>
						@if($post->torrent)
							@include('topics.partials.posts.blocks.torrent-block', ['torrent' => $post->torrent])
						@endif
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
