@extends('layouts.page')

@section('head-title')
    Home
@endsection

@section('content')
    <header>
        <h1>Home</h1>
    </header>
    <main>
        <div class="vending-machines">
            <h2>Vending Machines</h2>

            <div class="wrap">

            @forelse($devices as $vending)
                <div class="vending">
                    <h4 class="cell title">{{ $vending->name }}</h4>
                    <ul class="prod-wrap">
                        @forelse($vending->products as $product)
                            <li>{{ $product->title }}</li>
                            <li>{{ $product->price }}</li>
                            <li>{{ $product->pivot->quantity }}</li>
                        @empty
                            <h5>No products found</h5>
                        @endforelse
                    </ul>
                </div>
            @empty

                <h2>No vending machines found</h2>

            @endforelse

            </div>
        </div>
        <div class="products">
            <a href="/products/" class="h2-btn">Products</a>
        </div>
    </main>
@endsection

    

