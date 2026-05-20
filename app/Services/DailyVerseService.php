<?php

declare(strict_types=1);

namespace App\Services;

use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;

class DailyVerseService
{
    private const CACHE_KEY = 'daily_verse.v2';
    private const CACHE_TTL_SECONDS = 86400;

    /**
     * @return array{kitab:string, teks:string}
     */
    public function getDailyVerse(): array
    {
        return Cache::remember(self::CACHE_KEY, self::CACHE_TTL_SECONDS, fn (): array => $this->fetchDailyVerse());

        // Testing (no cache): uncomment if needed.
        // return $this->fetchDailyVerse();
    }

    /**
     * @return array{kitab:string, teks:string}
     */
    private function fetchDailyVerse(): array
    {
        $fallback = [
            'kitab' => 'Yeremia 29:11',
            'teks' => 'Sebab Aku ini mengetahui rancangan-rancangan apa yang ada pada-Ku mengenai kamu, demikianlah firman TUHAN, yaitu rancangan damai sejahtera dan bukan rancangan kecelakaan, untuk memberikan kepadamu hari depan yang penuh harapan.',
        ];

        try {
            $bookMaxChapters = [
                'Maz' => 150,
                'Ams' => 31,
                'Yoh' => 21,
                'Rom' => 16,
                'Flp' => 4,
                '1 Tes' => 5,
                'Efe' => 6,
                'Yak' => 5,
            ];

            $abbr = array_rand($bookMaxChapters);
            $chapter = random_int(1, $bookMaxChapters[$abbr]);

            $encodedAbbr = rawurlencode($abbr);
            $url = "https://beeble.vercel.app/api/v1/passage/{$encodedAbbr}/{$chapter}";

            $response = Http::acceptJson()
                ->withoutVerifying()
                ->timeout(8)
                ->get($url);

            if (! $response->successful()) {
                return $fallback;
            }

            $verses = $response->json('data.verses');
            if (! is_array($verses) || $verses === []) {
                return $fallback;
            }

            $contentVerses = array_values(array_filter($verses, static function ($verse): bool {
                return is_array($verse) && (($verse['type'] ?? null) === 'content');
            }));

            if ($contentVerses === []) {
                return $fallback;
            }

            $picked = $contentVerses[array_rand($contentVerses)];

            $text = $picked['content']
                ?? $picked['text']
                ?? $picked['verseText']
                ?? $picked['value']
                ?? null;

            if (! is_string($text) || trim($text) === '') {
                return $fallback;
            }

            $text = trim(preg_replace('/\s+/', ' ', strip_tags($text)) ?? '');
            if ($text === '') {
                return $fallback;
            }

            $verseNumber = $picked['verse']
                ?? $picked['verseNumber']
                ?? $picked['number']
                ?? $picked['ayat']
                ?? null;

            $verseNumber = is_scalar($verseNumber) ? (string) $verseNumber : null;
            if ($verseNumber === null || trim($verseNumber) === '') {
                return $fallback;
            }

            $bookName = $response->json('data.book.name');
            if (! is_string($bookName) || trim($bookName) === '') {
                return $fallback;
            }

            $chapterFromApi = $response->json('data.book.chapter');
            $chapterToUse = is_scalar($chapterFromApi) ? (string) $chapterFromApi : (string) $chapter;
            $chapterToUse = trim($chapterToUse);
            if ($chapterToUse === '') {
                $chapterToUse = (string) $chapter;
            }

            $reference = trim($bookName).' '.$chapterToUse.':'.trim($verseNumber);

            return [
                'kitab' => $reference,
                'teks' => $text,
            ];
        } catch (\Throwable $e) {
            return $fallback;
        }
    }
}
