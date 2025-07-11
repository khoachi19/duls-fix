<?php

namespace App\Livewire\Web\Checkout;

use App\Models\Cart;
use App\Models\Branch;
use App\Models\District;
use App\Models\Shipping;
use Livewire\Component;

class Index extends Component
{
    public $address;
    public $branch_id;
    public $district_id;
    public $districts;

    public $selectShippingId = '';
    public $selectShippingPrice = 0;

    public $grandTotal = 0;
    public $totalPrice = 0;

    public function mount()
    {
        $this->districts = collect();
        $cartData = $this->getCartsData();
        $this->totalPrice = $cartData['totalPrice'];
        $this->grandTotal = $this->totalPrice;
    }

    public function getCartsData()
    {
        $carts = Cart::with('product')
            ->where('customer_id', auth()->guard('customer')->user()->id)
            ->get();

        return [
            'totalPrice' => $carts->sum(function ($cart) {
                return $cart->product->price * $cart->qty;
            })
        ];
    }

    public function updatedBranchId($value)
    {
        $this->district_id = '';
        $this->selectShippingId = '';
        $this->selectShippingPrice = 0;
        $this->grandTotal = $this->totalPrice;

        if ($value) {
            $this->districts = District::where('branch_id', $value)->get();
        } else {
            $this->districts = collect();
        }
    }

    public function selectShipping($id)
    {
        $shipping = Shipping::find($id);
        if ($shipping) {
            $this->selectShippingId = $shipping->id;
            $this->selectShippingPrice = $shipping->price;
            $this->grandTotal = $this->totalPrice + $shipping->price;
        }
    }

    public function render()
    {
        $branches = Branch::all();
        $shippings = Shipping::all();

        return view('livewire.web.checkout.index', compact('branches', 'shippings'));
    }
}