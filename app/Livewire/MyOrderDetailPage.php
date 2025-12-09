<?php

namespace App\Livewire;

use App\Models\Order;
use App\Models\OrderItem;
use Livewire\Attributes\Title;
use Livewire\Component;

class MyOrderDetailPage extends Component
{
    #[Title('Detail Pesanan - Rizqi Wood Gallery')]

    public $order_id;

    public function mount($order_id)
    {
        $this->order_id = $order_id;
    }

    public function render()
    {
        $order = Order::where('id', $this->order_id)
            ->where('user_id', auth()->id()) 
            ->with('items.product')
            ->firstOrFail();

        return view('livewire.my-order-detail-page', [
            'order' => $order
        ]);
    }
}