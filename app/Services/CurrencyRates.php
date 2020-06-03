<?php


namespace App\Services;


use Exception;
use GuzzleHttp\Client;

class CurrencyRates
{
    public static function getRates()
    {
        $url = config('currency_rates.api_url');

        $client = new Client();
        $response = $client->request('GET', $url);

        if ($response->getStatusCode() !== 200) {
            throw new Exception('Proplem with connect to nbrb API');
        }
        $currencies = CurrencyConversion::getCurrencies();
        $apiCur = json_decode($response->getBody()->getContents(), true);

        foreach ($currencies  as $currency) {
            $currency->touch();
            foreach ($apiCur as $value) {
                if (!$currency->isMain() && $value['Cur_Abbreviation'] == $currency->code) {
                    $currency->update(['rate' => $value['Cur_OfficialRate']]);
                    $currency->touch();
                }
            }
        }
    }
}
