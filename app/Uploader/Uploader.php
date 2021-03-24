<?php

namespace App\Uploader;

use App\Exceptions\FileUploadException;
use Illuminate\Http\UploadedFile;

abstract class Uploader
{
	private static array $mimeTypes = [
		'application/x-bittorrent' => TorrentUploader::class,
	];

	/**
	 * Файл к загрузке
	 * @var UploadedFile $file
	 */
	protected UploadedFile $file;

	protected function __construct(UploadedFile $file)
	{
		$this->file = $file;
	}

	/**
	 * Проверка файла, переименование, сохранение на диске и в Database
	 * должен вернуть App\Models\Attachment
	 * @return \App\Models\Attachment
	 */
	abstract public function process();

	/**
	 * Возвращает загрузчик
	 *
	 * @param UploadedFile $file
	 * @return Uploader
	 * @throws FileUploadException
	 */
	public static function getUploader(UploadedFile $file)
	{
		$uploader = self::$mimeTypes[$file->getMimeType()] ?? null;

		if (!$uploader) {
			throw new FileUploadException(101);
		}
		return (new $uploader($file));
	}
}
