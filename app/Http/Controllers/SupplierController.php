<?php

namespace App\Http\Controllers;

use App\Models\Supplier;
use Illuminate\Http\Request;

class SupplierController extends Controller
{
    public function index(Request $request)
    {
        $query = Supplier::query();

        if ($request->filled('search')) {
            $query->where('name', 'like', '%' . $request->search . '%')
                  ->orWhere('contact', 'like', '%' . $request->search . '%');
        }

        $suppliers = $query->latest()->paginate(10)->withQueryString();

        return view('logistic.suppliers.index', compact('suppliers'));
    }

    public function create()
    {
        return view('logistic.suppliers.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name'    => 'required|string|max:255',
            'contact' => 'required|string|max:255',
            'address' => 'required|string',
        ]);

        Supplier::create($validated);

        return redirect()->route('logistic.suppliers.index')
                         ->with('success', 'Supplier berhasil ditambahkan.');
    }

    public function edit(Supplier $supplier)
    {
        return view('logistic.suppliers.edit', compact('supplier'));
    }

    public function update(Request $request, Supplier $supplier)
    {
        $validated = $request->validate([
            'name'    => 'required|string|max:255',
            'contact' => 'required|string|max:255',
            'address' => 'required|string',
        ]);

        $supplier->update($validated);

        return redirect()->route('logistic.suppliers.index')
                         ->with('success', 'Supplier berhasil diperbarui.');
    }

    public function destroy(Supplier $supplier)
    {
        $supplier->delete();

        return redirect()->route('logistic.suppliers.index')
                         ->with('success', 'Supplier berhasil dihapus.');
    }
}
