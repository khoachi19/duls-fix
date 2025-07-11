@section('title')
Checkout - Eat Your Favorite Foods
@stop

@section('keywords')
Food Store, Eat Your Favorite Foods
@stop

@section('description')
Checkout - Food Store - Eat Your Favorite Foods
@stop

@section('image')
{{ asset('images/logo.png') }}
@stop

<div>
    <div class="container">
        <div class="row justify-content-center mt-0" style="margin-bottom: 320px;">
            <div class="col-md-6">

                <div class="bg-white rounded-bottom-custom shadow-sm p-3 sticky-top mb-3">
                    <div class="d-flex justify-content-start">
                        <div>
                            <x-buttons.back />
                        </div>
                    </div>
                </div>

                <div class="card rounded shadow-sm border-0 mb-4">
                    <div class="card-body">
                        <h6>
                            <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="currentColor" class="bi bi-geo-alt mb-1" viewBox="0 0 16 16">
                                <path d="M12.166 8.94c-.524 1.062-1.234 2.12-1.96 3.07A32 32 0 0 1 8 14.58a32 32 0 0 1-2.206-2.57c-.726-.95-1.436-2.008-1.96-3.07C3.304 7.867 3 6.862 3 6a5 5 0 0 1 10 0c0 .862-.305 1.867-.834 2.94M8 16s6-5.686 6-10A6 6 0 0 0 2 6c0 4.314 6 10 6 10" />
                                <path d="M8 8a2 2 0 1 1 0-4 2 2 0 0 1 0 4m0 1a3 3 0 1 0 0-6 3 3 0 0 0 0 6" />
                            </svg>
                            Shipping Information
                        </h6>
                        <hr />

                        <!-- Pilih Cabang -->
                        <select class="form-select rounded mb-3" wire:model.live="branch_id">
                            <option value="">-- Pilih Cabang --</option>
                            @foreach($branches as $branch)
                                <option value="{{ $branch->id }}">{{ $branch->name }}</option>
                            @endforeach
                        </select>

                        <!-- Pilih Kecamatan -->
                        <select class="form-select rounded mb-3" wire:model.live="district_id" @if(!$branch_id) disabled @endif>
                            <option value="">-- Pilih Kecamatan --</option>
                            @if($districts && $districts->count() > 0)
                                @foreach($districts as $district)
                                    <option value="{{ $district->id }}">{{ $district->name }}</option>
                                @endforeach
                            @endif
                        </select>
                        @if($branch_id && $districts && $districts->count() == 0)
                            <small class="text-muted">Tidak ada kecamatan tersedia untuk cabang ini.</small>
                        @endif

                        <!-- Address -->
                        <div class="mb-3">
                            <textarea class="form-control rounded" wire:model="address" rows="3" placeholder="Address: Jl. Kebon Jeruk No. 1, Jakarta Barat"></textarea>
                        </div>
                    </div>
                </div>

                <!-- Bagian Kurir -->
                @if($district_id)
                <div class="card rounded shadow-sm border-0 mb-5">
                    <div class="card-body">
                        <h6>
                            <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="currentColor" class="bi bi-truck mb-1" viewBox="0 0 16 16">
                                <path d="M0 3.5A1.5 1.5 0 0 1 1.5 2h9A1.5 1.5 0 0 1 12 3.5V5h1.02a1.5 1.5 0 0 1 1.17.563l1.481 1.85a1.5 1.5 0 0 1 .329.938V10.5a1.5 1.5 0 0 1-1.5 1.5H14a2 2 0 1 1-4 0H5a2 2 0 1 1-3.998-.085A1.5 1.5 0 0 1 0 10.5zm1.294 7.456A2 2 0 0 1 4.732 11h5.536a2 2 0 0 1 .732-.732V3.5a.5.5 0 0 0-.5-.5h-9a.5.5 0 0 0-.5.5v7a.5.5 0 0 0 .294.456M12 10a2 2 0 0 1 1.732 1h.768a.5.5 0 0 0 .5-.5V8.35a.5.5 0 0 0-.11-.312l-1.48-1.85A.5.5 0 0 0 13.02 6H12zm-9 1a1 1 0 1 0 0 2 1 1 0 0 0 0-2m9 0a1 1 0 1 0 0 2 1 1 0 0 0 0-2" />
                            </svg>
                            Courier Delivery
                        </h6>
                        <hr />
                        @if(count($shippings) > 0)
                            <div class="space-y-3">
                                @foreach($shippings as $shipping)
                                    <div class="form-check p-3 border rounded {{ $selectShippingId == $shipping->id ? 'border-primary bg-light' : '' }}" 
                                         style="cursor: pointer;">
                                        <input class="form-check-input" 
                                               type="radio" 
                                               name="shipping" 
                                               id="shipping_{{ $shipping->id }}"
                                               value="{{ $shipping->id }}"
                                               wire:model.live="selectShippingId">
                                        <label class="form-check-label w-100 d-flex justify-content-between" 
                                               for="shipping_{{ $shipping->id }}"
                                               style="cursor: pointer;">
                                            <div class="fw-medium">
                                                {{ $shipping->nama_kurir }}
                                            </div>
                                            <div class="fw-bold">
                                                Rp {{ number_format($shipping->harga_kurir, 0, ',', '.') }}
                                            </div>
                                        </label>
                                    </div>
                                @endforeach
                            </div>
                        @else
                            <p class="text-danger">Tidak ada opsi kurir tersedia.</p>
                        @endif
                    </div>
                </div>
                @endif

                <!-- Ringkasan Pembayaran -->
                @if($selectShippingId)
                    <div class="card rounded shadow-sm border-0 mb-4">
                        <div class="card-body">
                            <h6>
                                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="currentColor" class="bi bi-receipt mb-1" viewBox="0 0 16 16">
                                    <path d="M1.92.506a.5.5 0 0 1 .434.14L3 1.293l.646-.647a.5.5 0 0 1 .708 0L5 1.293l.646-.647a.5.5 0 0 1 .708 0L7 1.293l.646-.647a.5.5 0 0 1 .708 0L9 1.293l.646-.647a.5.5 0 0 1 .708 0l.646.647.646-.647a.5.5 0 0 1 .708 0l.646.647.646-.647a.5.5 0 0 1 .801.13l.5 1A.5.5 0 0 1 15 2v12a.5.5 0 0 1-.053.224l-.5 1a.5.5 0 0 1-.8.13L13 14.707l-.646.647a.5.5 0 0 1-.708 0L11 14.707l-.646.647a.5.5 0 0 1-.708 0L9 14.707l-.646.647a.5.5 0 0 1-.708 0L7 14.707l-.646.647a.5.5 0 0 1-.708 0L5 14.707l-.646.647a.5.5 0 0 1-.708 0L3 14.707l-.646.647a.5.5 0 0 1-.801-.13l-.5-1A.5.5 0 0 1 1 14V2a.5.5 0 0 1 .053-.224l.5-1a.5.5 0 0 1 .367-.27m.217 1.338L2 2.118v11.764l.137.274.51-.51a.5.5 0 0 1 .707 0l.646.647.646-.646a.5.5 0 0 1 .708 0l.646.646.646-.646a.5.5 0 0 1 .708 0l.646.646.646-.646a.5.5 0 0 1 .708 0l.646.646.646-.646a.5.5 0 0 1 .708 0l.646.646.646-.646a.5.5 0 0 1 .708 0l.509.509.137-.274V2.118l-.137-.274-.51.51a.5.5 0 0 1-.707 0L12 1.707l-.646.647a.5.5 0 0 1-.708 0L10 1.707l-.646.647a.5.5 0 0 1-.708 0L8 1.707l-.646.647a.5.5 0 0 1-.708 0L6 1.707l-.646.647a.5.5 0 0 1-.708 0L4 1.707l-.646.647a.5.5 0 0 1-.708 0z"/>
                                    <path d="M3 4.5a.5.5 0 0 1 .5-.5h6a.5.5 0 1 1 0 1h-6a.5.5 0 0 1-.5-.5m0 2a.5.5 0 0 1 .5-.5h6a.5.5 0 1 1 0 1h-6a.5.5 0 0 1-.5-.5m0 2a.5.5 0 0 1 .5-.5h6a.5.5 0 1 1 0 1h-6a.5.5 0 0 1-.5-.5m0 2a.5.5 0 0 1 .5-.5h6a.5.5 0 0 1 0 1h-6a.5.5 0 0 1-.5-.5m8-6a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 0 1h-1a.5.5 0 0 1-.5-.5m0 2a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 0 1h-1a.5.5 0 0 1-.5-.5m0 2a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 0 1h-1a.5.5 0 0 1-.5-.5m0 2a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 0 1h-1a.5.5 0 0 1-.5-.5"/>
                                </svg>
                                Ringkasan Pembayaran
                            </h6>
                            <hr />
                            <div class="d-flex justify-content-between mb-2">
                                <span>Subtotal Produk</span>
                                <span class="fw-medium">Rp {{ number_format($totalPrice, 0, ',', '.') }}</span>
                            </div>
                            <div class="d-flex justify-content-between mb-2">
                                <span>Biaya Kurir</span>
                                <span class="fw-medium">Rp {{ number_format($selectShippingPrice, 0, ',', '.') }}</span>
                            </div>
                            <hr />
                            <div class="d-flex justify-content-between">
                                <span class="fw-bold">Total Pembayaran</span>
                                <span class="fw-bold text-primary">Rp {{ number_format($grandTotal, 0, ',', '.') }}</span>
                            </div>
                        </div>
                    </div>
                @endif

                <!-- Tombol Checkout -->
                @if($selectShippingId)
    <livewire:web.checkout.btn-checkout 
        key="{{ now() }}" 
        :branch_id="$branch_id" 
        :district_id="$district_id" 
        :address="$address" 
        :grandTotal="$grandTotal" 
        :selectShippingId="$selectShippingId" 
        :selectShippingPrice="$selectShippingPrice" 
    />
@endif


                <!-- Pesan Sukses -->
               

                <!-- Pesan Error -->
                

            </div>
        </div>
    </div>
</div>