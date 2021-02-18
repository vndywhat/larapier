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
							{{--<a href="#" onclick="return build_poll_add_form(this);" class="txtb">
								<img
									src="{{ asset('images/icon_poll.gif') }}"
									alt="[ Опрос ]" title="Добавить опрос">
							</a>--}}
							{{--<a class="txtb" href=""
							   onclick="ajax.exec({ action: 'posts', post_id: 1, type: 'reply'}); return false;">
								<img
									src="{{ asset('images/icon_quote.gif') }}"
									alt="[Цитировать]" title="Ответить с цитатой">
							</a>
							<a class="txtb" href="" onclick="edit_post(1, 'edit'); return false;">
								<img
									src="{{ asset('images/icon_edit.gif') }}"
									alt="[Изменить]" title="Редактировать сообщение">
							</a>
							<a class="txtb" href="./modcp.php?mode=ip&amp;p=1&amp;t=1">
								<img
									src="{{ asset('images/icon_ip.gif') }}"
									alt="[ip]" title="Показать IP адрес автора">
							</a>
							<a class="menu-root menu-alt1 txtb" href="#mc_1">
								<img
									src="{{ asset('images/icon_mc.gif') }}"
									alt="[Комментарий]" title="Комментарий">
							</a>
							<a class="txtb" href="viewtopic.php?t=1&amp;mod=1&amp;start=0#1">
								<img
									src="{{ asset('images/icon_mod.gif') }}"
									alt="[m]" title="Модерировать сообщения">
							</a>--}}
						</div>
					</div>
					<div class="col-sm-12">
						<span class="newIndicator"><span></span>Новое</span>
						<div class="post-body pb-2">
							{!! $post->text_html  !!}
						</div>

						<div class="attachment-info text-center" {{--style="display: none;"--}}>
							<table class="table table-bordered table-sm" style="width: 95%;">
								<tbody>
								<tr class="text-center">
									<td colspan="3">
										Как качать FAQ Покраснели раздачи?
									</td>
								</tr>
								<tr>
									<td>Зарегистрирован</td>
									<td>24-Дек-20 07:30 Скачан: 3,601 раз</td>
									<td rowspan="4">
										<a href="dl.php?t=5981997" class="dl-stub dl-link dl-topic">
											<img src="{{ asset('images/icon_dn.gif') }}" alt="Скачать .torrent"><br>
											Скачать .torrent
										</a>
										<p class="small">127&nbsp;KB</p>
										<div style="padding-top: 6px;">
											<button class="btn btn-outline-primary">Список файлов</button>
											{{--<input id="tor-filelist-btn" type="button" class="lite" style="width: 120px;" value="Список файлов">--}}
										</div>
									</td>
								</tr>
								<tr>
									<td>Тип</td>
									<td>Обычная</td>
								</tr>
								<tr>
									<td>Статус</td>
									<td><span class="tor-icon tor-approved" style="color: #008000;">√</span> <b>проверено</b></td>
								</tr>
								<tr>
									<td>Размер</td>
									<td>67.32 GB magnet</td>
								</tr>
								<tr>
									<td colspan="3"></td>
								</tr>
								</tbody>
							</table>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
