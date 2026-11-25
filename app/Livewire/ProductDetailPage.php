<?php

namespace App\Livewire;

use App\Helpers\CartManagement;
use App\Livewire\Partials\Navbar;
use App\Models\Product;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Attributes\Title;
use Livewire\Component;

#[Title('Product Detail - MixxStore')]
class ProductDetailPage extends Component
{
    use LivewireAlert;
    public $slug;
    public $quantity = 1;

    public function mount($slug){
        $this->slug = $slug;
    }
    public function increaseQty(){
        $this->quantity++;

    }

    public function decreaseQty(){
        if($this->quantity > 1){
            $this->quantity--;
        }
    }
    public function addToCart($product_id){
        $total_count = CartManagement::addItemToCartWithQty($product_id, $this->quantity);

        $this->dispatch('update-cart-count', total_count:$total_count)->to(Navbar::class);

        $this->alert('success', 'Product Added to the cart Successfully', [
            'position' => 'bottom-end',
            'timer' => '3000',
            'toast' => 'true'
        ]);
    }

    public function render()
    {

        $product = Product::with(['brand', 'category'])->where('slug', $this->slug)->firstOrFail();

        $related = Product::with('brand')
            ->where('is_active', 1)
            ->where('category_id', $product->category_id)
            ->whereKeyNot($product->id)
            ->latest()
            ->take(4)
            ->get();

        return view('livewire.product-detail-page',[
            'product' => $product,
            'related' => $related,
        ]);
    }
}
