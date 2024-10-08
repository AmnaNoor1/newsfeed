<?php

namespace App\Http\Controllers;

use GuzzleHttp\Client;
use Illuminate\Http\Request;

class RssFeedController extends Controller
{
    public function fetchFeed()
    {
        $client = new Client();
        $urls = [
            'https://www.standaard.be/rss/section/1f2838d4-99ea-49f0-9102-138784c7ea7c',//working
            'https://www.standaard.be/rss/section/eb1a6433-ca3f-4a3b-ab48-a81a5fb8f6e2', //working
            'https://www.gva.be/rss/section/4DFF3E33-6C32-4E60-803C-A2AC00EDE26C', //working
            'http://feeds.nieuwsblad.be/nieuwsblad/sport/autosport', //working
            // 'https://www.tijd.be/rss/politiek_economie.xml', //no image
            'http://feeds.nieuwsblad.be/economie/home', //working
            'https://www.hbvl.be/rss/section/3D61D4A0-88CE-44E9-BCE0-A2AD00AD7D2E', 
        ];

        $feedItems = [];

        foreach ($urls as $url) {
            $response = $client->get($url);
            $rssContent = $response->getBody()->getContents();

            $rss = simplexml_load_string($rssContent);

            foreach ($rss->channel->item as $item) {
                $feedItems[] = [
                    'title' => (string) $item->title,
                    'link' => (string) $item->link,
                    'description' => strip_tags((string) $item->description),
                    'pubDate' => (string) $item->pubDate,
                    'image' => isset($item->enclosure['url']) ? (string) $item->enclosure['url'] : null,
                ];
            }
        }

        return view('rssfeed', ['feedItems' => $feedItems]);
    }
}
