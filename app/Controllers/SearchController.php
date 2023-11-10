<?php

declare(strict_types=1);

namespace App\Controllers;

use App\Api;
use App\Response;

class SearchController
{
    private Api $api;

    public function __construct()
    {
        $this->api = new Api();
    }

    public function show(array $vars): Response
    {
        $episodeCode = $vars['id'];

        $episode = $this->api->fetchEpisodeByCode($episodeCode);

        $characters = $this->api->fetchCharactersForEpisode($episode->getId());

        return new Response('episodes/show', [
            'episode' => $episode,
            'characters' => $characters,
        ]);
    }
}
