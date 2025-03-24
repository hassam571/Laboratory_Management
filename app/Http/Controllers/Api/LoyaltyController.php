<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Lc;

class LoyaltyController extends Controller
{
    public function getDiscount(Request $request)
    {
        $phone = $request->input('phone');
        // Find LC record matching the phone number
        $lc = Lc::where('phone_number', $phone)->first();
        if ($lc) {
            return response()->json(['discount' => $lc->percentage]);
        }
        return response()->json(['discount' => 0]);
    }
}