<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TransactionController extends Controller
{
    public function placeOrder(Request $request)
    {
        $request->validate([
            'items' => 'required|array',
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

        try {
            // Save cart details
            $cartItems = [];
            foreach ($request->items as $item) {
                $cart = Cart::create([
                    'user_id' => $user->id,
                    'product_id' => $item['product_id'],
                    'total_item' => $item['total_item'],
                    'total_price' => $item['total_price'],
                    'transport_fee' => $request->transport_fee,
                    'discount_id' => $request->discount_id,
                ]);
            }
            // Save transaction details
            $transaction = Transaction::create([
                'user_id' => $user->id,
                'name' => $user->name,
                'email' => $user->email,
                'phone' => $user->phone,
                'address' => $user->address,
                'note' => $request->note,
                'cart_id' => $cart->id,
                'status' => 'pending',
            ]);

            return response()->json([
                'status' => true,
                'message' => 'Order placed successfully',
                'transaction' => $transaction,
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => false,
                'message' => 'Failed to place order',
                'error' => $e->getMessage(),
            ], 500);
        }
    }
}
