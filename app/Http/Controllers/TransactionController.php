<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use App\Models\Category;
use Illuminate\Http\Request;
use Inertia\Inertia;

class TransactionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = auth()->user()->transactions()
            ->with('category');

        if ($request->has('search')) {
            $search = strtolower($request->input('search'));
            $query->where(function ($q) use ($search) {
                $q->whereRaw('LOWER(note) LIKE ?', ["%{$search}%"])
                  ->orWhereHas('category', function ($q) use ($search) {
                      $q->whereRaw('LOWER(name) LIKE ?', ["%{$search}%"]);
                  });
            });
        }

        $transactions = $query->latest('transaction_date')
            ->latest('created_at')
            ->paginate(10)
            ->withQueryString();

        $categories = auth()->user()->categories()->get();

        return Inertia::render('Transactions/Index', [
            'transactions' => $transactions,
            'categories' => $categories,
            'filters' => $request->only(['search']),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'category_id' => 'required|exists:categories,id',
            'amount' => 'required|numeric|min:0.01',
            'transaction_date' => 'required|date',
            'note' => 'nullable|string|max:255',
        ]);

        // Validasi kepemilikan kategori
        $category = Category::findOrFail($validated['category_id']);
        if ($category->user_id !== $request->user()->id) {
            abort(403);
        }

        $request->user()->transactions()->create([
            ...$validated,
            'type' => $category->type, // Ambil tipe dari kategori
        ]);

        return redirect()->back();
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Transaction $transaction)
    {
        if ($transaction->user_id !== $request->user()->id) {
            abort(403);
        }

        $validated = $request->validate([
            'category_id' => 'required|exists:categories,id',
            'amount' => 'required|numeric|min:0.01',
            'transaction_date' => 'required|date',
            'note' => 'nullable|string|max:255',
        ]);

        $category = Category::findOrFail($validated['category_id']);
        if ($category->user_id !== $request->user()->id) {
            abort(403);
        }

        $transaction->update([
            ...$validated,
            'type' => $category->type,
        ]);

        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request, Transaction $transaction)
    {
        if ($transaction->user_id !== $request->user()->id) {
            abort(403);
        }

        $transaction->delete();

        return redirect()->back();
    }
}