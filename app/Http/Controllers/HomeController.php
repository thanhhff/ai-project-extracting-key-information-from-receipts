<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\Auth;
use App\Models\Category;
use App\Models\Image;
use App\Models\Bill;
use Illuminate\Support\Str;
use App\Jobs\AnalysisImage;


class HomeController extends BaseController
{
    protected $client;

    public function __construct() {
        parent::__construct();
        $this->client = new Client();
    }

    public function index() {
        return view('index');
    }

    public function dashboard() {
        $billInMonths = Bill::whereUserId($this->user->id)
                            ->whereMonth('payment_date', date('m'))
                            ->whereYear('payment_date', date('Y'))->orderBy('payment_date', 'desc')->get();
        $totalAmountInMonths = collect($billInMonths)->sum('total');
        $numOfBills = count($billInMonths);
        $recentBills = array_slice($billInMonths->toArray(), 0, 10);
        $categories = Category::all();

        $totalBills = Bill::whereUserId($this->user->id)->get();
        $billGrCategory = collect($totalBills)->groupBy('category_id')->sortKeys();
        return view('dashboard.index', compact('totalAmountInMonths', 'numOfBills', 'totalBills', 'recentBills', 'categories', 'billGrCategory'));
    }

    public function bills() {
        $bills = Bill::with(['image', 'category'])->whereUserId($this->user->id)->orderBy('created_at', 'desc')->paginate(15);
        return view('dashboard.bills', compact('bills'));
    }

    public function newBill() {
        $categories = Category::all();
        return view('dashboard.add_bill', compact('categories'));
    }

    public function createBill(Request $request) {
        $request->validate([
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $image = base64_encode($request->image->get());

        $uploadData = [
            'key' => env('IMAGE_SEVER_KEY'),
            'expiration' => env('IMAGE_EXIST_TIMEOUT'),
            'name' => $request->image->hashName(),
            'image' => $image
        ];
        
        $response = $this->client->post(env('IMAGE_SERVER_URL'), ['form_params' => $uploadData]);
        $data = json_decode($response->getBody()->getContents());

        $image = Image::create([
            "user_id" => $this->user->id,
            "file_name" => $data->data->image->filename,
            "link" => $data->data->url
        ]);

        $bill = Bill::create([
            "user_id" => $this->user->id,
            "category_id" => $request->get("category_id"),
            "image_id" => $image->id,
            "note" => $request->get("note"),
            "status" => 1
        ]);

        AnalysisImage::dispatch($bill->id);

        return redirect()->route('bills')->with(['type' => 'success', 'message' => "Thêm hóa đơn thành công! Quá trình xử lý có thể mất một vài phút."]);

    }

    public function editBill($id) {
        $bill = Bill::find($id);
        $categories = Category::all();
        return view('dashboard.edit_bill', compact('bill', 'categories'));
    }

    public function updateBill($id, Request $request) {
        $bill = Bill::find($id);
        if($bill->user_id != $this->user->id) {
            return redirect()->route('bills')->with(['type' => 'error', 'message' => "Hóa đơn hợp lệ"]);
        } 
        $bill->update([
            'category_id' => $request->category_id,
            'total' => $request->total,
            'payment_date' => $request->payment_date,
            'seller' => $request->seller,
            'address' => $request->address,
            'note' => $request->note,
            'status' => 2
        ]);
        return redirect()->route('bills')->with(['type' => 'success', 'message' => "Cập nhật thành công"]);
    }

    public function deleteBill($id) {
        $bill = Bill::with('image')->find($id);
        if($bill->user_id != $this->user->id) {
            return redirect()->route('bills')->with(['type' => 'error', 'message' => "Hóa đơn hợp lệ"]);
        }   
        $bill->image->delete();
        $bill->delete();
        return redirect()->route('bills')->with(['type' => 'success', 'message' => "Hóa đơn đã được xóa"]);
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

        $uploadData = [
            'key' => env('IMAGE_SEVER_KEY'),
            'expiration' => env('IMAGE_EXIST_TIMEOUT'),
            'name' => $request->image->hashName(),
            'image' => $image
        ];

        $response = $this->client->post( env('IMAGE_SERVER_URL'), ['form_params' => $uploadData]);
        $data = json_decode($response->getBody()->getContents());

        $response = $this->client->get(env('API_URL') . '?url=' . $data->data->url);

        return response()->json(['status' => 'success', 'data' => $response->getBody()->getContents()]);
    }
}
