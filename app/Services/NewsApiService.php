<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;

class NewsApiService
{
    protected $apiUrl = 'https://itsedekah.id/news_api.php';

    private function normalizeText($value)
    {
        if (!is_string($value)) {
            return $value;
        }

        $decoded = html_entity_decode($value, ENT_QUOTES | ENT_HTML5, 'UTF-8');

        $decoded = str_replace(["\r\n", "\r"], "\n", $decoded);

        $decoded = preg_replace('/�([^�]+)�/u', '"$1"', $decoded);
        $decoded = preg_replace('/([[:alnum:]])�([[:alnum:]])/u', "$1'$2", $decoded);

        $decoded = str_replace(
            ['â€œ', 'â€�', 'â€', 'â€', 'â€˜', 'â€™', 'â€’', 'â€“', 'â€”', 'Â'],
            ['"', '"', '"', '"', "'", "'", '-', '-', '-', ''],
            $decoded
        );

        $replacements = [
            "\u{00A0}" => ' ',
            "\u{201C}" => '"',
            "\u{201D}" => '"',
            "\u{201E}" => '"',
            "\u{00AB}" => '"',
            "\u{00BB}" => '"',
            "\u{2018}" => "'",
            "\u{2019}" => "'",
            "\u{201A}" => "'",
            "\u{2013}" => '-',
            "\u{2014}" => '-',
        ];

        return strtr($decoded, $replacements);
    }

    /**
     * Get all news from the API
     *
     * @return array
     */
    public function getAllNews()
    {
        try {
            $response = Http::get($this->apiUrl);
            
            if ($response->successful()) {
                $body = $response->body();
                if (function_exists('mb_convert_encoding')) {
                    $body = mb_convert_encoding($body, 'UTF-8', 'UTF-8, ISO-8859-1, Windows-1252');
                }
                $news = json_decode($body, true, 512, JSON_INVALID_UTF8_SUBSTITUTE);
                
                // Process news to add source field and ensure all have thumbnail
                return collect($news)->map(function ($item) {
                    $item['source'] = 'external';
                    $item['thumbnail'] = $item['thumbnail'] ?? asset('img/default.jpg');
                    $item['title'] = $this->normalizeText($item['title'] ?? '');
                    // Make sure the body is properly escaped HTML and clean any unwanted tags
                    $item['body'] = $this->cleanHtml($item['body']);
                    return $item;
                })->toArray();
            }
            
            return [];
        } catch (\Exception $e) {
            \Log::error('Failed to fetch news from API: ' . $e->getMessage());
            return [];
        }
    }

    /**
     * Get a specific news item by ID
     *
     * @param string $id
     * @return array|null
     */
    public function getNewsById($id)
    {
        $allNews = $this->getAllNews();
        
        foreach ($allNews as $news) {
            if ($news['id'] == $id) {
                return $news;
            }
        }
        
        return null;
    }

    /**
     * Clean HTML content to properly display on the website
     * 
     * @param string $html
     * @return string
     */
    private function cleanHtml($html)
    {
        // Replace escaped quotes and slashes
        $html = str_replace('\\"', '"', $html);
        $html = str_replace("\\/", "/", $html);
        
        // Replace escaped newlines with actual newlines
        $html = str_replace('\\n', "\n", $html);
        
        // Remove unnecessary tags like <\/span>, <\/p>, <\/b>
        $html = str_replace(['<\/span>', '<\/p>', '<\/b>'], ['</span>', '</p>', '</b>'], $html);
        
        return $html;
    }
} 
