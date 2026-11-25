<?php

namespace App\Livewire;

use App\Helpers\CartManagement;
use App\Livewire\Partials\Navbar;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use App\Models\User;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Attributes\Title;
use Livewire\Component;


#[Title('MixxStore — Gothic & Alternative Fashion')]
class HomePage extends Component
{
    use LivewireAlert;

    public function addToCart($product_id)
    {
        $total_count = CartManagement::addItemToCart($product_id);

        $this->dispatch('update-cart-count', total_count: $total_count)->to(Navbar::class);

        $this->alert('success', 'Product added to cart', [
            'position' => 'bottom-end',
            'timer' => '3000',
            'toast' => 'true',
        ]);
    }

    public function render()
    {
        $brands = Brand::where('is_active', 1)->get();
        $categories = Category::where('is_active', 1)
            ->withCount(['products' => fn ($q) => $q->where('is_active', 1)])
            ->get();

        $featured = Product::with('brand')
            ->where('is_active', 1)
            ->where('is_featured', 1)
            ->latest()
            ->take(10)
            ->get();

        $newArrivals = Product::with('brand')
            ->where('is_active', 1)
            ->where('on_sale', 1)
            ->latest()
            ->take(4)
            ->get();

        return view('livewire.home-page', [
            'brands' => $brands,
            'categories' => $categories,
            'featured' => $featured,
            'onSale' => $newArrivals,
            'stats' => [
                'products' => Product::where('is_active', 1)->count(),
                'customers' => User::count(),
            ],
        ]);
    }
}
