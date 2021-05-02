<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\Auth;


class HomeController extends BaseController
{
    public function index() {
        return view('index');
    }

    public function dashboard() {
        return view('dashboard.index');
    }

    public function bills() {
        return view('dashboard.bills');
    }

    public function addBill() {
        return view('dashboard.add_bill');
    }

    public function editBill() {
        return view('dashboard.edit_bill');
    }

    public function analysis() {
        return view('dashboard.analysis');
    }

    public function logout() {
        Auth::logout();
        return redirect()->route('home');
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
