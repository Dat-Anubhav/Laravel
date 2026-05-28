<?php

namespace App\View\Components;

use App\Models\Category;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;
use App\Models\User; // 🔄 Import the User model


class CategoryTabs extends Component
{
    /**
     * Create a new component instance.
     */
    /**
     * Create a new component instance.
     */
    public function __construct(
        public ?\App\Models\User $user = null // 🔄 Added "?" and "= null" to make it completely optional!
    ) {}

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        // Keep your existing categories query running here
        $categories = Category::orderBy('name', 'asc')->get();
        return view('components.category-tabs', compact('categories'));
    }
}
