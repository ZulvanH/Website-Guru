<?php

namespace App\Helpers;

class YouTubeUtil
{
    public function showVideo($id)
{
    // Mendapatkan data video dari database berdasarkan ID atau sumber data lainnya
    $video = \App\Models\Video::findOrFail($id);

    // Mendapatkan URL thumbnail menggunakan fungsi getYouTubeThumbnail()
    $thumbnailUrl = \App\Helpers\YouTubeUtil::getYouTubeThumbnail($video->youtube_url);

    // Menampilkan tampilan (view) video dengan data yang diperlukan
    return view('video.show', compact('video', 'thumbnailUrl'));
}
    public static function getYouTubeThumbnail($videoUrl)
    {
        $videoId = self::getYouTubeVideoId($videoUrl);
        $apiKey = config('services.youtube.api_key');

        $thumbnailUrl = '';// Implementasikan logika untuk mendapatkan URL thumbnail YouTube di sini

        return $thumbnailUrl;
    }

    private static function getYouTubeVideoId($videoUrl)
    {
        $queryString = parse_url($videoUrl, PHP_URL_QUERY);
        parse_str($queryString, $params);

        if (isset($params['v'])) {
            return $params['v'];
        }

        return '';
    }
}
