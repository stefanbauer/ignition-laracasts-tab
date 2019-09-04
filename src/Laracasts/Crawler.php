<?php

namespace StefanBauer\LaracastsTab\Laracasts;

use Goutte\Client;
use Symfony\Component\DomCrawler\Crawler as BaseCrawler;
use Symfony\Component\HttpFoundation\Request;

class Crawler
{
    public const BASE_URL = 'https://laracasts.com/';

    private $uri = 'discuss';
    private $client;

    public function __construct(Client $client)
    {
        $this->client = $client;
    }

    public function searchFor(string $term)
    {
        $crawler = $this->client->request(
            Request::METHOD_GET,
            sprintf('%s%s/?popular=1&q=%s', static::BASE_URL, $this->uri, urlencode($term))
        );

        $results = new ResultCollection();

        $crawler->filter('div.conversation-list-item')->each(function (BaseCrawler $listItem) use ($results) {
            $result = (new Result(
                $listItem->filter('a.conversation-list-link')->first()->text(),
                static::BASE_URL . substr($listItem->filter('a.conversation-list-link')->first()->attr('href'), 1)
            ))->byAuthor(
                $listItem->filter('.conversation-list-title div a.tw-uppercase')->first()->text(),
                $listItem->filter('.conversation-list-title div a.tw-uppercase')->first()->attr('href')
            )->updatedAt($listItem->filter('.conversation-list-title div span a.tw-font-bold')->first()->text());

            if ($listItem->filter('div.conversation-list-avatar span.is-answered')->count()) {
                $result->markAsAnswered();
            }

            $results->add($result);
        });

        return $results;
    }
}
