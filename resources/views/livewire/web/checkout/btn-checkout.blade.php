

<button 
    wire:click="storeCheckout" 
    class="btn btn-orange-2 rounded border-0 shadow-sm w-100 py-2" 
    @if($grandTotal <= 0 || empty($address)) disabled @endif
    wire:loading.attr="disabled"
>
    <span wire:loading.remove>Process to Payment</span>
    <span wire:loading>
        <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
        Processing...
    </span>
</button>
