<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Discount;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TransactionController extends Controller
{
    public function placeOrder(Request $request)
    {
        $request->validate([
            'items' => 'required|array',
            // 'total_item' => 'required|integer',
            'total_price' => 'required|numeric',
            'transport_fee' => 'required|numeric',
            'discount_id' => 'nullable|integer',
            'note' => 'nullable|string',
        ]);

        $user = Auth::user();

        if (!$user) {
            return response()->json([
                'status' => false,
                'message' => 'User not authenticated',
            ], 401);
        }

        // Save transaction details
        $transaction = Transaction::create([
            'user_id' => $user->id,
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'address' => $request->address,
            'note' => $request->note,
            'status' => 'pending',
        ]);

        // Save cart details
        foreach ($request->items as $item) {
            Cart::create([
                'user_id' => $user->id,
                'product_id' => $item['product_id'],
                'total_item' => $item['total_item'],
                'total_price' => $item['total_price'],
                'transport_fee' => $request->transport_fee,
                'discount_id' => $request->discount_id,
                'transaction_id' => $transaction->id,
            ]);
        }

        $discount = Discount::where('id', $request->discount_id)->firstOrFail();
        $discount->amount -= 1;
        $discount->save();

        return response()->json([
            'status' => true,
            'message' => 'Đơn hàng được đặt thành công!',
            'transaction' => $transaction,
        ]);
    }
}
