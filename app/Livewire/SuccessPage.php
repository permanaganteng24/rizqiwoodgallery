<?php

namespace App\Livewire;

use App\Models\Order;
use Livewire\Attributes\Title;
use Livewire\Component;

class SuccessPage extends Component
{
    #[Title('Order Berhasil - Rizqi Wood')]

    public $order;

    public function mount($order_id)
    {
        $this->order = Order::findOrFail($order_id);
    }

    public function render()
    {
        return view('livewire.success-page');
    }
}