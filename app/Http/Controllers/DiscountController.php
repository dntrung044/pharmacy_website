<?php

namespace App\Http\Controllers;

use App\Models\Discount;
use Carbon\Carbon;
use Illuminate\Http\Request;

class DiscountController extends Controller
{
    public function applyDiscount(Request $request)
    {
        $today = Carbon::now('Asia/Ho_Chi_Minh')->format('Y/m/d');
        $code = $request->input('code');

        $discount = Discount::where('code', $code)
            ->where('status', 'active')
            ->where('date_start', '<=', $today)
            ->where('date_end', '>=', $today)
            ->first();
        if (!$discount) {
            return response()->json(['error' => 'Mã giảm giá không đúng hoặc đã hết hạn!'], 400);
        }

        return response()->json(['discount' => $discount]);
    }
}
