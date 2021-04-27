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

    public function uploadImage(Request $request) {
        $request->validate([
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $imageName = time() . '.' . $request->image->extension();
        $request->image->move(public_path('images'), $imageName);

        $path = public_path('images/' . $imageName);

        $client = new Client();

        $response = $client->get('https://606de307603ded0017504c23.mockapi.io/api/v1/data/1?image=' . $path);


        return response()->json(['status' => 'success', 'data' => $response->getBody()->getContents()]);
    }
}
