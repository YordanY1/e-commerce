<!-- products/partials/search_dropdown.blade.php -->
@foreach($products as $product)
    <a href="{{ url('/product/' . $product->slug) }}" class="dropdown-item d-flex align-items-center py-2">
        @if($product->images->first()) <!-- Check if the product has an image -->
            <img src="{{ asset('storage/' . $product->images->first()->path) }}" alt="{{ $product->name }}" style="width: 50px; height: 50px; object-fit: cover; margin-right: 10px;">
        @endif
        <div>
            <div class="font-weight-bold">{{ $product->name }}</div>
            <div class="text-muted">{{ $product->price->price }} лв.</div>

        </div>
    </a>
@endforeach

@if(count($products) > 0)
    <a href="{{ url('/products?query=' . request('query')) }}" class="dropdown-item text-center">
        Виж всички
    </a>
@endif
