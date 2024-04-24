<?php

namespace EncoreDigitalGroup\SEO\Objects;

class OpenGraph
{
    public ?string $title = null;

    public ?string $description = null;

    public ?string $url = null;

    public ?string $type = null;

    public ?string $locale = null;

    public ?array $alternateLocales = null;

    public ?string $siteName = null;

    public array|string|null $image = null;

    public ?string $imageUrl = null;

    public ?int $imageSize = null;

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
