<?php

use EncoreDigitalGroup\SEO\Objects\PageInformation;

if (!function_exists('seo')) {
    function seo(string $title = null, string $description = null, $keywords = null, $author = null): PageInformation
    {
        return new PageInformation($title, $description, $keywords, $author);
    }
}

if (!function_exists('seo_tags')) {
    function seo_tags(string $title = null, string $description = null, $keywords = null, $author = null): string
    {
        $tagData = (new PageInformation($title, $description, $keywords, $author))->generateTags();
        $tags = '';

        foreach ($tagData as $data) {
            $tags .= $data . "\n";
        }

        return $tags;
    }
}