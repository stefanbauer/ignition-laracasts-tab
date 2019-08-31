<?php

namespace StefanBauer\LaracastsTab\Http\Controllers;

use Illuminate\Http\Request;
use StefanBauer\LaracastsTab\Laracasts\Crawler;

class TabController
{
    private $crawler;

    public function __construct(Crawler $crawler)
    {
        $this->crawler = $crawler;
    }

    public function search(Request $request)
    {
        $query = $request->input('query');

        if ($query === null) {
            return collect();
        }

        return $this->crawler->searchFor($query);
    }
}
