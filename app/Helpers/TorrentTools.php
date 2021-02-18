<?php

namespace App\Helpers;

class TorrentTools
{

    public static function humanSize($size, $rounder = null, $min = null, $space = '&nbsp;')
    {
        static $sizes = ['B', 'KB', 'MB', 'GB', 'TB', 'PB', 'EB', 'ZB', 'YB'];
        static $rounders = [0, 0, 0, 2, 3, 3, 3, 3, 3];

        $size = (float)$size;
        $ext = $sizes[0];
        $rnd = $rounders[0];

        if ($min == 'KB' && $size < 1024) {
            $size /= 1024;
            $ext = 'KB';
            $rounder = 1;
        } else {
            for ($i = 1, $cnt = count($sizes); ($i < $cnt && $size >= 1024); $i++) {
                $size /= 1024;
                $ext = $sizes[$i];
                $rnd = $rounders[$i];
            }
        }
        if (!$rounder) {
            $rounder = $rnd;
        }

        return round($size, $rounder) . $space . $ext;
    }

}
