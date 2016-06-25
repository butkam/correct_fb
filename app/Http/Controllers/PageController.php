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
    $queryUniqId = base64_encode(uniqid($inlineQueryId, true));

    $this->post(
      'answerInlineQuery', [
        'inline_query_id' => $inlineQueryId,
        'results' => [
          'type'      => 'photo',
          'id'        => '234234234234234',
          'photo_url' => 'https://dl.dropboxusercontent.com/u/4402725/test_mag.jpeg',
          'thumb_url' => 'https://dl.dropboxusercontent.com/u/4402725/test_mag.jpeg'
    ]]);

    // $this->post('getMe');
  }

  public function post($method, $parameters = null)
  {
    error_log(var_export($method, 1));
    $host = Config::get('services.telegram.host');
    $token = Config::get('services.telegram.token');

    $client = new \GuzzleHttp\Client([ 'base_uri' => $host . $token . '/' ]);
    $res = $client->request('POST', $method, $parameters);

    error_log(var_export($res->getBody()->getContents(), 1));
    // var_dump($res->getBody()->getContents());
  }
}
