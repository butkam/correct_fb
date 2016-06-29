<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
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
    // error_log(var_export($reqest->inline_query, 1));

    if ($reqest->inline_query) {
      error_log(var_export('true', 1));
      $this->post(
      'answerInlineQuery', [
        'inline_query_id' => $inlineQueryId,
        'results' => [
          'type'          => 'document',
          'id'            => $queryUniqId,
          'title'         => 'Документ',
          'document_url'  => 'https://dl.dropboxusercontent.com/u/4402725/stickers.pdf',
          'mime_type'     => 'application/pdf'
        ]]);
    }

    // $this->post('getMe');
  }

  public function post($method, $parameters = null)
  {
    error_log(var_export($method, 1));
    $host = Config::get('services.telegram.host');
    $token = Config::get('services.telegram.token');

    $client = new \GuzzleHttp\Client([ 'base_uri' => $host . $token . '/' ]);
    $res = $client->request('POST', $method, $parameters);

    error_log(var_export($res->getBody(), 1));
    // var_dump($res->getBody()->getContents());
  }
}
