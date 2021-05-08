<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use App\Models\Bill;
use GuzzleHttp\Client;

class AnalysisImage implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $billId;
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($billId)
    {
        $this->billId = $billId;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle() {
        echo 'Start job analysis image!' . PHP_EOL;
        $bill = Bill::with('image')->find($this->billId);
        $client = new Client();
        try {
            $response = $client->get(env('API_URL') . '?url=' . $bill->image->link);
            $dataAnalys = json_decode($response->getBody()->getContents());
            $bill->seller = $dataAnalys->SELLER;
            $bill->total = (int) $dataAnalys->TOTAL_COST;
            $bill->payment_date = $this->_convertDate($dataAnalys->TIMESTAMP);
            $bill->address = $dataAnalys->ADDRESS;
            $bill->status = 2;
            $bill->save();
        } catch(Exception $e) {
            $this->failed($e);
        }
        echo 'End job!' . PHP_EOL;
    }

    private function _convertDate($date) {
        try {
            $separate = "/";
            if (strpos($date, '-') !== false) {
                $separate = "-";
            } else if (strpos($date, '.') !== false) {
                $separate = ".";
            }
            [$day, $month, $year] = explode($separate, $date);
            if($month > 12) {
                [$day, $month] = [$month, $day];
            }
            return $year . "-" . $month . "-" . $day; 
        } catch (Exception $e) {
            return date("Y-m-d");
        }
    }

    public function failed($exception) {
        $bill = Bill::find($this->billId);
        $bill->status = 3;
        $bill->save();
    }
}
