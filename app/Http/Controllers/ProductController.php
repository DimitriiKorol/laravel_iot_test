<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;

use App\Models\Product;

class ProductController extends Controller
{
    // Архивация продукта
    public function archive($id)
    {
        $product = Product::findOrFail($id);
        $product->update(['is_archived' => true]);

        return view('product', [
            'message' => 'Product archived successfully',
            'product' => $product
        ]);
    }

    // Восстановление
    public function restore($id)
    {
        $product = Product::archived()->findOrFail($id);
        $product->update(['is_archived' => false]);

        return view('product', [
            'message' => 'Product restored successfully',
            'product' => $product
        ]);
    }

    // Редактирование
    public function edit($id, Request $request)
    {
        $product = Product::findOrFail($id);
        $product->update([
            'price' => $request->price,
            'quantity' => $request->quantity
        ]);

        return view('product', [
            'message' => 'Product edited successfully',
            'product' => $product
        ]);
    }
   
    // Удаление
    public function permanentDelete($id): JsonResponse 
    {
        if (!auth()->check() || !auth()->user()->isAdmin()) {
            abort(403, 'Admin only!');
        }

        $product = Product::archived()->findOrFail($id);

        DB::transaction(function () use ($product) {
            // Cвязи с устройствами
            $product->devices()->detach();
            
            // Удаление продукта
            $product->forceDelete();// Вообще как бы нежелательно в принципе, ну да ладно, я тут тренируюсь)
        });

        return response()->json([// Минимальный ответ, можно конечно рероут повесить и туда сообщение, ну пока так
            'message' => 'Product permanently deleted successfully'
        ]);
    }

    // Получение информации о продукте
    public function show($id)
    {
        $product = Product::with('devices')->findOrFail($id);

        return view('product', [
            'product' => $product,
            'is_admin' => auth()->user()->isAdmin(),
            'can_permanently_delete' => $product->is_archived && auth()->user()->isAdmin()
        ]);
       
    }

    // Вывод всех продуктов
    public function showAll()
    {
        $products = Product::all();

        return view('products', [
            'products' => $products,
        ]);
       
    }
}
