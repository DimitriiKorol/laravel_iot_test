@extends('layouts.page')

@section('head-title')
    Products
@endsection

@section('content')
    <header>
        <h1>Products</h1>
    </header>
    <main>
        <div class="titles">
            <p class="title">Title</p>
            <p class="title">price</p>
            <p class="title">quantity</p>
            <p class="title">Archived</p>
        </div>

        @forelse($products as $product)
            <div class="product-block">
                <a href="/product/{{ $product->id }}/" class="cell title">{{ $product->title }}</a>
                <p class="cell price">{{ $product->price }}</p>
                <p class="cell quantity">{{ $product->quantity }}</p>
                <p class="cell archived">{{ $product->is_archived ? 'Archived' : 'No' }}</p>
            </div>
        @empty

            <h2>No products found</h2>

        @endforelse
    </main>
@endsection
