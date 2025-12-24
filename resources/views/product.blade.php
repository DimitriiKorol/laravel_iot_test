@extends('layouts.page')

@section('head-title')
    {{ $product->title }}
@endsection

@section('content')
    <header>
        <h1>{{ $product->title }}</h1>
    </header>
    <main>
        <div class="description">
            Some description
        </div>

        @if (isset($message))
            <h2>
                {{ $message }}
            </h2>
        @endif

        <p class="nums">Current price: {{ $product->price }}</p>

        <p class="nums">Current quantity: {{ $product->quantity }}</p>

        <div class="buttons">
            <a class="button edit" onclick="showForm(event)">Edit</a>

            @if ($product->is_archived)

                <form action="{{ route('product.restore', $product->id) }}" method="POST" class="btn-wrap">
                    @csrf
                    @method('PATCH')
                    <button type="submit" class="button btn-warning">Restore</button>
                </form>

            @else

                <form action="{{ route('product.archive', $product->id) }}" method="POST" class="btn-wrap">
                    @csrf
                    @method('PATCH')
                    <button type="submit" class="button btn-warning">Archive</button>
                </form>
            
            @endif

            @if (isset($can_permanently_delete) && $can_permanently_delete)
                <form action="{{ route('product.permanent', $product->id) }}" method="POST" class="btn-wrap">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="button btn-warning">!Delete!</button>
                </form>
            @endif

            
        </div>

        <div class="pop-form-wrapper">
            <form class="edit-form" action="{{ route('product.edit', $product->id) }}" method="POST">
                @csrf
                @method('PATCH')

                <div class="hide-form" onclick="hideForm(event)">
                    <div></div>
                    <div></div>
                </div>

                <label for="price">Price</label>
                <input name="price" type="text" placeholder="Change price" value="{{ $product->price }}">

                <label for="price">Quantity</label>
                <input name="quantity" type="text" placeholder="Change Quantity" value="{{ $product->quantity }}">

                <button type="submit">Change</button>
            </form>
        </div>
        
    </main>
@endsection
