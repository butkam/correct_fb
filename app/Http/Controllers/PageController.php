<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use GuzzleHttp\Client;
use Config;

class PageController extends Controller
{
  public function home()
  {
    $persons = ['Tim', 'John', 'Peter'];
    return view('welcome', compact('persons'));
  }

  public function bot()
  {
    return view('bot');
  }

  public function updates(Request $reqest)
  {

    $inlineQueryId = $reqest->inline_query['id'];
    $msg = $reqest->inline_query['query'];
    $queryUniqId = uniqid($inlineQueryId, true);
    $chatId = $reqest['message']['chat']['id'];
    $text = $reqest['message']['text'];
    error_log(var_export($reqest['message']['text'], 1));

    $par = [
      'type'          => 'document',
      'id'            => $queryUniqId,
      'title'         => 'Документ',
      'document_url'  => 'https://dl.dropboxusercontent.com/u/4402725/stickers.pdf',
      'mime_type'     => 'application/pdf'
    ];

    if ($reqest->inline_query) {
      $this->post(
      'answerInlineQuery', [
        'json' => [
          'inline_query_id' => $inlineQueryId,
          'results'         => [
            'json' => $par
            ]
        ]
      ]);
    }

    // $this->post('getMe');

    if (strpos($text, '/start') === 0) {
      $this->post(
      'sendMessage', [
        'json' => [
          'chat_id' => $chatId,
          'text'    => 'Привет, я ТекстБот!'
        ]]);
    }
  }

  public function post($method, $parameters)
  {
    $host = Config::get('services.telegram.host');
    $token = Config::get('services.telegram.token');

    $client = new \GuzzleHttp\Client([
      'base_uri' => $host . $token . '/',
      'timeout'  => 2.0
    ]);

    $response = $client->request('POST', $method, $parameters);
    error_log(var_export($response->getBody()->getContents(), 1));
  }
}
