<?php

namespace StefanBauer\LaracastsTab\Laracasts;

class Result
{
    public $title;
    public $link;
    public $updatedAt;
    public $answered = false;
    public $authorName;
    public $authorLink;

    public function __construct(string $title, string $link)
    {
        $this->title = trim($title);
        $this->link = trim($link);
    }

    public function updatedAt(string $updatedAt)
    {
        $this->updatedAt = trim($updatedAt);

        return $this;
    }

    public function byAuthor(string $name, string $link)
    {
        $this->authorName = trim($name);
        $this->authorLink = trim($link);

        return $this;
    }

    public function markAsAnswered()
    {
        $this->answered = true;

        return $this;
    }
}
