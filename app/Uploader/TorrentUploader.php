<?php

namespace App\Uploader;

use Illuminate\Http\UploadedFile;
use SandFox\Bencode\Bencode;
use App\Exceptions\FileUploadException;

class TorrentUploader extends Uploader
{
	private float $totalLength = 0;

	public function process()
    {
		$this->checkTorrent();

		dd($this->file->getFileInfo());

    }

	/**
	 * @throws FileUploadException
	 */
	private function checkTorrent(): void
	{
		if(!$torrent = Bencode::decode($this->openFile())) {
			throw new FileUploadException(151);
		}

		$this->checkTorrentInfo($torrent);

		$torrent = $this->toggleDht($torrent);

		$this->checkLength($torrent);
	}

	/**
	 * @param array $torrent
	 * @throws FileUploadException
	 */
	private function checkTorrentInfo(array $torrent): void
	{
		$torrentInfo = $torrent['info'] ?? [];

		if (!isset($torrentInfo['name'], $torrentInfo['piece length'], $torrentInfo['pieces']) || \strlen($torrentInfo['pieces']) % 20 != 0) {
			throw new FileUploadException(152);
		}
	}

	/**
	 *
	 * @param array $torrent
	 * @return array
	 */
	private function toggleDht(array $torrent): array
	{
		if(!config('torrent.DHT')) {
			$torrent['info']['private'] = (int) 1;
			\File::replace($this->file->getRealPath(), Bencode::encode($torrent));
		}

		return $torrent;
	}

	/**
	 * @param array $torrent
	 * @throws FileUploadException
	 */
	private function checkLength(array $torrent): void
	{
		if (isset($torrent['info']['length'])) {
			$this->totalLength = (float)$torrent['info']['length'];
		} elseif (isset($torrent['info']['files']) && \is_array($torrent['info']['files'])) {
			foreach ($torrent['info']['files'] as $fn => $f) {
				$this->totalLength += (float)$f['length'];
			}
		} else {
			throw new FileUploadException(152);
		}
	}
}
