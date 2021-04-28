<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Client;


class HomeController
{
    public function index() {
        return view('index');
    }

    public function test() {
        return view('test');
    }

    /**
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function uploadImage(Request $request) {
        $request->validate([
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $image = base64_encode($request->image->get());

        $client = new Client();

        $uploadData = [
            'key' => env('IMAGE_SEVER_KEY'),
            'expiration' => env('IMAGE_EXIST_TIMEOUT'),
            'name' => $request->image->hashName(),
            'image' => $image
        ];

        $response = $client->post( env('IMAGE_SERVER_URL'), ['form_params' => $uploadData]);
        $data = json_decode($response->getBody()->getContents());

        $response = $client->get(env('API_URL') . '?url=' . $data->data->url);

        return response()->json(['status' => 'success', 'data' => $response->getBody()->getContents()]);
    }
}
