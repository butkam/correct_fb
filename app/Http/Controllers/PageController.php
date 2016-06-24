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
    $host = Config::get('services.telegram.host');
    $token = Config::get('services.telegram.token');

    $inlineQueryId = $reqest->inline_query['id'];
    $msg = $reqest->inline_query['query'];
    $queryUniqId = base64_encode(uniqid($inlineQueryId, true));

    // return error_log(var_export($msg, 1));

    $photoQuery = [
      'type'      => 'photo',
      'id'        => $queryUniqId,
      'photo_url' => 'https://dl.dropboxusercontent.com/u/4402725/test_mag.jpeg',
      'thumb_url' => 'https://dl.dropboxusercontent.com/u/4402725/test_mag.jpeg'
    ];

    $client = new \GuzzleHttp\Client();

    $res = $client->request('POST', $host . $token . '/answerInlineQuery', [
      'inline_query_id' => $inlineQueryId,
      'results' => json_encode($photoQuery),
    ]);
  }
}
