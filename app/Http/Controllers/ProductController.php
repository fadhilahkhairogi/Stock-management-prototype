<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        $query = Product::with('category');

        if ($request->filled('search')) {
            $query->where('name', 'like', '%' . $request->search . '%')
                  ->orWhere('barcode', 'like', '%' . $request->search . '%');
        }

        $products = $query->latest()->paginate(10)->withQueryString();

        // Cache Dashboard
        $dashboardData = Cache::remember('admin.products.dashboard.data', 600, function () {
            // Kekurangan Stok
            $lowStockProducts = Product::whereColumn('stock', '<=', 'min_stock')
                                ->select('name', 'stock', 'min_stock')
                                ->latest()
                                ->take(10)
                                ->get()
                                ->toArray(); // Convert array

            // Kesehatan Stok
            $totalProducts = Product::count();
            $healthyProducts = Product::whereColumn('stock', '>', 'min_stock')->count();
            $healthPercentage = $totalProducts > 0 ? round(($healthyProducts / $totalProducts) * 100) : 0;

            // Total Aset
            $totalBuyValue = Product::sum(\DB::raw('buy_price * stock'));
            $totalSellValue = Product::sum(\DB::raw('sell_price * stock'));
            $potentialProfitMargin = $totalBuyValue > 0 ? (($totalSellValue - $totalBuyValue) / $totalBuyValue) * 100 : 0;

            // Data Pie Chart
            $totalStock = Product::sum('stock');
            $categoryStocks = Product::select('category_id', \DB::raw('SUM(stock) as total_stock'))
                ->groupBy('category_id')
                ->with('category')
                ->get();

            $chartLabels = [];
            $chartData = [];
            $otherStock = 0;

            foreach ($categoryStocks as $cs) {
                if ($totalStock > 0 && ($cs->total_stock / $totalStock) > 0.1) {
                    $chartLabels[] = $cs->category ? $cs->category->name : 'Tanpa Kategori';
                    $chartData[] = (int) $cs->total_stock;
                } else {
                    $otherStock += $cs->total_stock;
                }
            }

            if ($otherStock > 0) {
                $chartLabels[] = 'Other';
                $chartData[] = (int) $otherStock;
            }

            return compact('lowStockProducts', 'healthPercentage', 'chartLabels', 'chartData', 'totalBuyValue', 'totalSellValue', 'potentialProfitMargin');
        });

        // Rebuild Objects
        $dashboard = [
            'lowStockProducts' => call_user_func(function() use ($dashboardData) {
                // Cast to Object
                return collect($dashboardData['lowStockProducts'])->map(fn($item) => (object) $item);
            }),
            'healthPercentage' => $dashboardData['healthPercentage'],
            'totalBuyValue'    => $dashboardData['totalBuyValue'],
            'totalSellValue'   => $dashboardData['totalSellValue'],
            'potentialProfitMargin' => $dashboardData['potentialProfitMargin'],
            'pieChart'         => null
        ];

        // Build Chart
        if (count($dashboardData['chartData']) > 0) {
            $larapex = app(\ArielMejiaDev\LarapexCharts\LarapexChart::class);
            $dashboard['pieChart'] = $larapex->pieChart()
                ->setTitle('Distribusi Stok')
                ->addData($dashboardData['chartData'])
                ->setLabels($dashboardData['chartLabels'])
                ->setColors(['#00A6FF', '#045595', '#00FF1A', '#FF0004', '#ffc107', '#9C27B0']);
        }

        return view('admin.products.index', compact('products', 'dashboard'));
    }

    public function create()
    {
        $categories = Category::all();
        return view('admin.products.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name'        => 'required|string|max:255',
            'category_id' => 'required|exists:categories,id',
            'barcode'     => 'nullable|string|max:255',
            'buy_price'   => 'required|numeric|min:0',
            'sell_price'  => 'required|numeric|min:0',
            'stock'       => 'required|integer|min:0',
            'min_stock'   => 'required|integer|min:0',
        ]);

        Product::create($validated);

        // Clear Cache
        Cache::forget('admin.products.dashboard.data');

        return redirect()->route('admin.products.index')
                         ->with('success', 'Produk berhasil ditambahkan.');
    }

    public function edit(Product $product)
    {
        $categories = Category::all();
        return view('admin.products.edit', compact('product', 'categories'));
    }

    public function update(Request $request, Product $product)
    {
        $validated = $request->validate([
            'name'        => 'required|string|max:255',
            'category_id' => 'required|exists:categories,id',
            'barcode'     => 'nullable|string|max:255',
            'buy_price'   => 'required|numeric|min:0',
            'sell_price'  => 'required|numeric|min:0',
            'stock'       => 'required|integer|min:0',
            'min_stock'   => 'required|integer|min:0',
        ]);

        $product->update($validated);

        // Clear Cache
        Cache::forget('admin.products.dashboard.data');

        return redirect()->route('admin.products.index')
                         ->with('success', 'Produk berhasil diperbarui.');
    }

    public function destroy(Product $product)
    {
        $product->delete();

        // Clear Cache
        Cache::forget('admin.products.dashboard.data');

        return redirect()->route('admin.products.index')
                         ->with('success', 'Produk berhasil dihapus.');
    }
}
