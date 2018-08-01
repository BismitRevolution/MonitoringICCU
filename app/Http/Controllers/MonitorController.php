<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class MonitorController extends Controller
{
    public function index() {
        return view('pages/monitor');
    }

    public function generate() {
        DB::table('heartbeat')->insert(
            [
                'customer_id' => 1,
                'value' => rand(1, 200),
            ]
        );
        DB::table('temperature')->insert(
            [
                'customer_id' => 1,
                'value' => rand(1, 50),
            ]
        );
    }

    public function retrieve() {
        $heartbeat = DB::table('heartbeat')
                        ->select('value')
                        ->where('customer_id', 1)
                        ->get();

        $temperature = DB::table('temperature')
                        ->select('value')
                        ->where('customer_id', 1)
                        ->get();
                        
        $result = array(
            'heartbeat' => $heartbeat,
            'temperature' => $temperature,
        );
        // $result->heartbeat = $heartbeat;
        // $result->temperature = $temperature;
        // dd(json_decode(json_encode($result), true));
        return json_decode(json_encode($result), true);
    }
}
