<?php

/**
 * Crawls ingatlan.com for the adverts.
 * 
 * @param  string $firstPage The URI of the first page.
 * @return array of the adverts.
 */
function getAdverts($firstPage)
{
	$client = new Goutte\Client();
	$client->setHeader('Accept', 'text/html');

	$ads = [];
	$nextPage = $firstPage;

	do {

		$crawler = $client->request('GET', $nextPage);

		try {
		
			$nextPage = $crawler->selectLink('Következő oldal')->link()->getUri();
		
		} catch (\Exception $e) {

			$nextPage = null;

		}
		
		$ads = array_merge($ads, $crawler->filter('div.listing__card')->each(function ($advert) 
		{
			$tmp['link'] = 'https://ingatlan.com' . $advert->filter('a.listing__link')->first()->attr('href');

			$tmp['price'] = (int) preg_replace('/(\bFt\/hó)|(\s)/', '', $advert->filter('div.price')->first()->text());

			$tmp['address'] = trim($advert->filter('div.listing__address')->first()->text());

			$tmp['size'] = (int) preg_replace('/(\bm² terület)|(\s)/', '', $advert->filter('div.listing__data--area-size')->first()->text());

			$tmp['private'] = (bool)count($advert->filter('div.listing__labels')->children());

	    	return $tmp;
	    }));

	} while ($nextPage);

	return collect($ads);
}

function newAdverts()
{
	$ads = auth()->user()->adverts()->where('seen', false)->get();

	return count($ads);
}