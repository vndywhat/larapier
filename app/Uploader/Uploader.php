<?php

namespace App\Uploader;

use App\Exceptions\FileUploadException;
use Illuminate\Database\Eloquent\Model;
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

	//abstract public function process(): Model;
	/**
	 * Проверка файла, переименование, сохранение на диске и в Database
	 * должен вернуть Model
	 * @return mixed
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
		dd($file->getMimeType());

		$uploader = self::$mimeTypes[$file->getMimeType()] ?? null;

		if (!isset($uploader)) {
			throw new FileUploadException(101);
		}
		return (new $uploader($file));
	}

	protected function openFile(): string
	{
		return \File::get($this->file->getRealPath());
	}
}
