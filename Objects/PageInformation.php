<?php

namespace EncoreDigitalGroup\SEO\Objects;

class PageInformation
{
    public ?string $title = null;
    public ?string $description = null;
    public ?string $keywords = null;
    public ?string $author = null;
    public ?OpenGraph $openGraph;
    public ?Twitter $twitter;

    public function __construct($title = null, $description = null, $keywords = null, $author = null)
    {
        if (not_null($title)) {
            $this->title = $title;
        }

        if (not_null($description)) {
            $this->description = $description;
        }

        if (not_null($keywords)) {
            $this->keywords = $keywords;
        }

        if (not_null($author)) {
            $this->author = $author;
        }

        $this->openGraph = new OpenGraph();
        $this->twitter = new Twitter();

        if (not_null($title) || not_null($description)) {
            $this->sync();
        }
    }

    public function generateTags(): array
    {
        $this->sync();

        $tags = [];

        if (not_null($this->title)) {
            $tags[] = '<title>' . $this->title . '</title>';
        }

        if (not_null($this->description)) {
            $tags[] = '<meta name="description" content="' . $this->description . '">';
        }

        if (not_null($this->keywords)) {
            $tags[] = '<meta name="keywords" content="' . $this->keywords . '">';
        }

        if (not_null($this->author)) {
            $tags[] = '<meta name="author" content="' . $this->author . '">';
        }

        if (not_null($this->openGraph->title)) {
            $tags[] = '<meta property="og:title" content="' . $this->openGraph->title . '">';
        }

        if (not_null($this->openGraph->description)) {
            $tags[] = '<meta property="og:description" content="' . $this->openGraph->description . '">';
        }

        if (not_null($this->openGraph->url)) {
            $tags[] = '<meta property="og:url" content="' . $this->openGraph->url . '">';
        }

        if (not_null($this->openGraph->type)) {
            $tags[] = '<meta property="og:type" content="' . $this->openGraph->type . '">';
        }

        if (not_null($this->openGraph->locale)) {
            $tags[] = '<meta property="og:locale" content="' . $this->openGraph->locale . '">';
        }

        if (not_null($this->openGraph->alternateLocales)) {
            foreach ($this->openGraph->alternateLocales as $locale) {
                $tags[] = '<meta property="og:locale:alternate" content="' . $locale . '">';
            }
        }

        if (not_null($this->openGraph->siteName)) {
            $tags[] = '<meta property="og:site_name" content="' . $this->openGraph->siteName . '">';
        }

        if (not_null($this->openGraph->image)) {
            $tags[] = $this->openGraph->generateImageTags();
        }

        if (not_null($this->openGraph->imageUrl)) {
            $tags[] = '<meta property="og:image:url" content="' . $this->openGraph->imageUrl . '">';
        }

        return $tags;
    }

    public function sync(): void
    {
        $this->prepareData();
        $this->propagateData();
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;
        $this->sync();

        return $this;
    }

    public function setTitle(string $title): self
    {
        $this->title = $title;
        $this->sync();

        return $this;
    }

    private function prepareData(): void
    {
        $this->description = str_max_length($this->description);
    }

    private function propagateData(): void
    {
        if (not_null($this->title)) {
            $this->openGraph->title = $this->title;
            $this->twitter->title = $this->title;
        }

        if (not_null($this->description)) {
            $this->openGraph->description = $this->description;
            $this->twitter->card = $this->description;
        }
    }
}