<div class="attachment-info text-center">
	<table class="table table-bordered table-sm" style="width: 95%;">
		<tbody>
		<tr class="text-center">
			<td colspan="3">
				<div class="btn-group">
					<a href="#" class="btn btn-sm btn-outline-primary">Как качать</a>
					<a href="#" class="btn btn-sm btn-outline-success">FAQ</a>
					<a href="#" class="btn btn-sm btn-outline-danger">Покраснели раздачи?</a>
				</div>
			</td>
		</tr>
		<tr>
			<td>Зарегистрирован</td>
			<td>{{ $torrent->created_at->format('d.m.Y H:i') }} Скачан: {{ $torrent->complete_count }} раз</td>
			<td rowspan="4">
				{{--<a href="dl.php?t=5981997" class="dl-stub dl-link dl-topic">--}}
				<a href="/dl/t/{{ $torrent->id }}" class="btn btn-outline-primary">
					<i class="far fa-save" title="Скачать .torrent"></i>
					<br>
					Скачать .torrent
				</a>
				<div class="pt-2 text-small">
					<i class="fas fa-hdd"></i>
					<span class="text-muted">127 KB</span>
				</div>
				<div class="pt-2">
					<button class="btn btn-outline-primary">Список файлов</button>
				</div>
			</td>
		</tr>
		<tr>
			<td>Тип</td>
			<td>
				<span title="Серебряная раздача"><i class="fas fa-coins text-secondary"></i></span>
			</td>
		</tr>
		<tr>
			<td>Статус</td>
			<td><span class="tor-icon tor-approved" style="color: #008000;">√</span> <b>проверено</b></td>
		</tr>
		<tr>
			<td>Размер</td>
			{{--<td>67.32 GB</td>--}}
			<td>{{ \App\Helpers\TorrentTools::humanSize($torrent->size) }}</td>
		</tr>
		{{--<tr>
			<td colspan="3"></td>
		</tr>--}}
		</tbody>
	</table>
</div>
