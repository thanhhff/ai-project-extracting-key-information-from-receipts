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
use App;


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

    public function changeLanguage($language) {
        App::setlocale($language);
        session()->put('locale', $language);
        return redirect()->back();
    }

    public function dashboard() {
        $billInMonths = Bill::whereUserId($this->user->id)
                            ->whereMonth('payment_date', date('m'))
                            ->whereYear('payment_date', date('Y'))->orderBy('created_at', 'desc')->get();
        $billInPrevMonth = Bill::whereUserId($this->user->id)
                            ->whereMonth('payment_date', date('m') - 1)
                            ->whereYear('payment_date', date('Y'))->orderBy('created_at', 'desc')->get();

        $totalAmountInMonths = collect($billInMonths)->sum('total');
        $totalAmountInPrevMonths = collect($billInPrevMonth)->sum('total');
        $amountDiff = $totalAmountInMonths ? round(100 * ($totalAmountInMonths - $totalAmountInPrevMonths) / $totalAmountInMonths, 2) : 0;
        
        $numOfBills = count($billInMonths);
        $billDiff = $numOfBills ? round(100 * ($numOfBills - count($billInPrevMonth)) / $numOfBills, 1) : 0;

        $recentBills  = Bill::whereUserId($this->user->id)->orderBy('payment_date', 'desc')->take(10)->get();
        $categories = Category::all();

        $totalBills = Bill::whereUserId($this->user->id)->whereStatus(2)->get();
        $billGrCategory = collect($totalBills)->groupBy('category_id')->sortKeys();

        return view('dashboard.index', compact('totalAmountInMonths', 'numOfBills', 
                                'totalBills', 'recentBills', 'categories', 'billGrCategory',
                                'amountDiff', 'billDiff'));
    }

    public function bills() {
        $processingBills = Bill::with(['image', 'category'])->whereUserId($this->user->id)->whereStatus(1)->orderBy('created_at', 'desc')->get();
        $bills = Bill::with(['image', 'category'])->whereUserId($this->user->id)->where('status', '!=', 1)->orderBy('created_at', 'desc')->get();
        return view('dashboard.bills', compact('processingBills', 'bills'));
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
        $message = session()->get('locale') == 'en' ? 'The reciept has been updated' : 'Cập nhật thành công';

        return redirect()->route('bills')->with(['type' => 'success', 'message' => $message]);
    }

    public function deleteBill($id) {
        $bill = Bill::with('image')->find($id);
        if($bill->user_id != $this->user->id) {
            return redirect()->route('bills')->with(['type' => 'error', 'message' => "Hóa đơn hợp lệ"]);
        }   
        $bill->image->delete();
        $bill->delete();
        $message = session()->get('locale') == 'en' ? 'The reciept has been deleted' : 'Hóa đơn đã được xóa';

        return redirect()->route('bills')->with(['type' => 'success', 'message' => $message]);
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

        $responseUpload = $this->client->post( env('IMAGE_SERVER_URL'), ['form_params' => $uploadData]);
        $data = json_decode($responseUpload->getBody()->getContents());

        $responseProcess = $this->client->get(env('API_URL') . '?url=' . $data->data->url);

        return response()->json(['status' => 'success', 'data' => $responseProcess->getBody()->getContents()]);
    }
}
