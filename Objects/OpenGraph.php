<?php

namespace EncoreDigitalGroup\SEO\Objects;

class OpenGraph
{
    public ?string $title;
    public ?string $description;
    public ?string $url;
    public ?string $type;
    public ?string $locale;
    public ?array $alternateLocales;
    public ?string $siteName;
    public array|string|null $image;
    public ?string $imageUrl;
    public ?int $imageSize;

    public function generateImageTags(): string
    {
        $tags = '';

        if (not_null($this->image)) {
            if (is_array($this->image)) {
                foreach ($this->image as $image) {
                    $tags .= '<meta property="og:image" content="' . $image . ' ">' . "\n";
                }

                return $tags;
            }

            $tags = '<meta property="og:image" content="' . $this->image . '">';
        }

        return $tags;
    }

    public function generateAlternateLocales(): string
    {
        $tags = '';

        if (not_null($this->image)) {
            if (is_array($this->alternateLocales)) {
                foreach ($this->alternateLocales as $image) {
                    $tags .= '<meta property="og:locale:alternate" content="' . $image . ' ">' . "\n";
                }

                return $tags;
            }

            $tags = '<meta property="og:locale:alternate" content="' . $this->alternateLocales . '">';
        }

        return $tags;
    }
}