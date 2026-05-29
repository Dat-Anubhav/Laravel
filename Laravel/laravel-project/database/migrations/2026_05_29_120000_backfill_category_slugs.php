<?php

use App\Models\Category;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Str;

return new class extends Migration
{
    public function up(): void
    {
        Category::query()->each(function (Category $category): void {
            if (empty($category->slug)) {
                $category->update(['slug' => Str::slug($category->name)]);
            }
        });
    }

    public function down(): void
    {
        //
    }
};
