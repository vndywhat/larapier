<?php

namespace App\Uploader;

use App\Models\Attachment;
use SandFox\Bencode\Bencode;
use App\Exceptions\FileUploadException;

class TorrentUploader extends Uploader
{
	private float $totalLength = 0.0;
	private array $decodedTorrent = [];

	public function process()
    {
		$this->checkTorrent();

		return $this->save();

    }

	/**
	 * @throws FileUploadException|\Illuminate\Contracts\Filesystem\FileNotFoundException
	 */
	private function checkTorrent(): void
	{
		if(!$this->decodedTorrent = Bencode::decode($this->file->get())) {
			throw new FileUploadException(151);
		}

		$this->checkTorrentInfo();

		$this->checkLength();

		$this->toggleDht();
	}

	/**
	 * Checking key "info" in decoded torrent file
	 * @throws FileUploadException
	 */
	private function checkTorrentInfo(): void
	{
		$torrentInfo = $this->decodedTorrent['info'] ?? [];

		if (!isset($torrentInfo['name'], $torrentInfo['piece length'], $torrentInfo['pieces'])
			|| \strlen($torrentInfo['pieces']) % 20 != 0) {
			throw new FileUploadException(152);
		}
	}

	/**
	 * If DHT is disabled, make the torrent private.
	 * @return void
	 */
	private function toggleDht(): void
	{
		if(!config('torrent.DHT')) {
			$this->decodedTorrent['info']['private'] = (int) 1;
			\File::replace($this->file->getRealPath(), Bencode::encode($this->decodedTorrent));
		}
	}

	/**
	 * @see https://wiki.theory.org/BitTorrentSpecification#Metainfo_File_Structure
	 * @throws FileUploadException
	 */
	private function checkLength(): void
	{
		if (isset($this->decodedTorrent['info']['length'])) {
			$this->totalLength = (float)$this->decodedTorrent['info']['length'];
		} elseif (isset($this->decodedTorrent['info']['files'])
				&& \is_array($this->decodedTorrent['info']['files'])) {
			foreach ($this->decodedTorrent['info']['files'] as $fn => $f) {
				$this->totalLength += (float)$f['length'];
			}
		} else {
			throw new FileUploadException(152);
		}
	}

	/**
	 * Saves the file
	 * @return Attachment
	 */
	private function save(): Attachment
	{
		$filename = (config('attachment.add_site_name'))
			? '[' . config('app.domain') . ']' . $this->file->hashName()
			: $this->file->hashName();

		$path = $this->file->storeAs('torrents', $filename);

		return Attachment::create([
			'filename' => $filename,
			'extension' => $this->file->getClientOriginalExtension(),
			'mime_type' => $this->file->getMimeType(),
			'file_size' => $this->file->getSize(),
		]);
	}
}
