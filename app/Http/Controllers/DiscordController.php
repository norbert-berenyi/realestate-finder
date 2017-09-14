<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DiscordController extends Controller
{
    public function test()
    {
    	$client = new \GuzzleHttp\Client(['headers' => ['Authorization' => 'Bot MzU3OTcyOTg0MzgxNzAyMTQ2.DJxr2Q.JXyLNNshdSciVFX84eSdgh3rj1s']]);
    	
    	$res = $client->request('GET', 'https://discordapp.com/api/v6/gateway/bot');

    	$contents = json_decode($res->getBody()->getContents());

		// $res = $client->request('POST', 'https://discordapp.com/api/v6/channels/357978403544104970/messages', 
		// [
		// 	'json' => ['content' => 'Test']
		// ]);
	
    	dd($contents);
    }
}
