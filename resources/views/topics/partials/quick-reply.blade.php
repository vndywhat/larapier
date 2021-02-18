<div class="row">
	<div class="col-sm-12">
		<div class="card">
			<div class="card-header pb-0">
				<h4 class="text-muted text-center">
					Быстрый ответ
				</h4>
			</div>
			<div class="card-body">
				{{ $errors }}
				<form action="{{ route('topic_reply', ['topic' => $topic->id]) }}" method="POST">
					@csrf
					<input type="hidden" name="t" value="{{ $topic->id }}">
					<div class="form-group text-center">
						<div class="buttons">
							<input type="button" value="B" name="codeB" title="Жирный текст: [b]текст[/b] (Ctrl+B)" style="font-weight: bold; width: 25px;">
							<input type="button" value="i" name="codeI" title="Наклонный текст: [i]текст[/i] (Ctrl+I)" style="width: 25px; font-style: italic;">
							<input type="button" value="u" name="codeU" title="Подчеркнутый текст: [u]текст[/u] (Ctrl+U)" style="width: 25px; text-decoration: underline;">
							<input type="button" value="s" name="codeS" title="Зачеркнутый текст: [s]текст[/s] (Ctrl+S)" style="width: 25px; text-decoration: line-through;">&nbsp;&nbsp;
							<input type="button" value="Цитата" name="codeQuote" title="Цитата: [quote]текст[/quote] (Ctrl+Q)" style="width: 57px;">
							<input type="button" value="Img" name="codeImg" title="Вставить картинку: [img]http://image_url[/img] (Ctrl+R)" style="width: 40px;">
							<input type="button" value="Ссылка" name="codeUrl" title="Ссылка (Ctrl+W)" style="width: 63px; text-decoration: underline;">&nbsp;
							<input type="button" value="Код" name="codeCode" title="Код: [code]код[/code] (Ctrl+K)" style="width: 43px;">
							<input type="button" value="Список" name="codeList" title="Список: [list]текст[/list] (Ctrl+L)" style="width: 60px;">
							<input type="button" value="1." name="codeOpt" title="Нумерованный список: [list=]текст[/list] (Ctrl+O)" style="width: 30px;">&nbsp;
							<input type="button" value="Цит.выдел" name="quoteselected" title="Цитировать выделенный текст" onclick="bbcode.onclickQuoteSel();">
						</div>
					</div>
					<div class="form-group">
                                <textarea
									name="reply_message"
									id="reply-message"
									rows="10"
									cols="52"
									class="form-control"></textarea>
					</div>
					<div class="form-group text-center">
						<button class="btn btn-primary">Предв. просмотр</button>
						<button type="submit" class="btn btn-success">Отправить</button>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>
