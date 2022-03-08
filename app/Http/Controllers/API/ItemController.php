<?php

namespace App\Http\Controllers\API;

use App\Models\Item;
use App\Models\Order;
use App\Models\Sale;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class ItemController extends ApiController
{
    /**
     * Get all items from supplier
     * 
     * @return json
     */
    public function items()
    {
        $items = Item::paginate(10);
        
        return $this->success($items->getCollection());
    }

     /**
     * Order an item from supplier
     * 
     * @return json
     */
    public function order(Request $request)
    {
        $user = $request->user();
        $qty = rand(1, 999);

        $order = Order::firstOrNew([
            'user_id' => $user->id,
            'item_id' => $request->item_id,
            'warehouse_id' => $request->warehouse_id
        ]);

        $order->quantity += $qty;
        $order->save();

        return $this->success($order, 201);
    }

    /**
     * Remove an item from warehouse
     * 
     * @return json
     */
    public function delete(Request $request, $item_id)
    {
        $user = $request->user();

        $item = Order::where(['item_id' => $item_id, 'user_id' => $user->id])->delete();

        return $this->success($item, 201, "Item deleted");
    }

     /**
     * Show all items from warehouse
     * 
     * @return json
     */
    public function stock(Request $request)
    {
        $user = $request->user();
        $orders = Order::where(['user_id' => $user->id])->paginate(20);

        return $this->success($orders->getCollection());
    }

     /**
     * Sell an item to client
     * 
     * @return json
     */
    public function sell(Request $request)
    {
        $user = $request->user();
        $qty = rand(1, 999);

        $order = Order::where([
            'user_id' => $user->id,
            'item_id' => $request->item_id
        ])
        ->first();

        if ($order->quantity >= $qty) {
            $sale = Sale::create([
                'item_id' => $order->item_id,
                'client_id' => $request->client_id,
                'item_name' => $order->item->name,
                'quantity' => $qty
            ]);

            $order->quantity -= $qty;
            $order->save();

            Log::info("Yes: warehouse qty $qty");
            
            return $this->success($sale, 201, "Item is sold");
        }
        
        Log::warning("No: warehouse qty $qty");

        return $this->failed(403, "Not enough items");
    }
}
