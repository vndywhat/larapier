<?php


namespace App\Exceptions;

use Throwable;

class FileUploadException extends \Exception
{
	protected const ERROR_MSG = [
		101 => 'This extension of file is not supported',

		151 => 'This is not a bencoded file',
		152 => 'Torrent file is invalid',
	];

	/**
	 * FileUploadException constructor.
	 *
	 * @param int             $code
	 * @param array|null      $replace
	 * @param \Throwable|null $throwable
	 */
	public function __construct(int $code = 999, array $replace = null, Throwable $throwable = null)
	{
		$message = self::ERROR_MSG[$code];
		if ($replace) {
			foreach ($replace as $key => $value) {
				$message = \str_replace($key, $value, $message);
			}
		}

		parent::__construct($message, $code, $throwable);
	}
}
