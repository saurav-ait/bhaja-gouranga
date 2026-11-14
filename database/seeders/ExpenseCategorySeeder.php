<?php

namespace Database\Seeders;

use App\Models\ExpenseCategory;
use Illuminate\Database\Seeder;

class ExpenseCategorySeeder extends Seeder
{
    public function run(): void
    {
        $categories = [
            [
                'name' => 'Puja & Festival',
                'description' => 'Puja, religious ceremonies and festivals',
            ],
            [
                'name' => 'Bhakta Seva',
                'description' => 'Devotee service and hospitality',
            ],
            [
                'name' => 'Winter Clothing Distribution',
                'description' => 'Winter clothes distribution program',
            ],
            [
                'name' => 'Children Gita Education',
                'description' => 'Gita education and children programs',
            ],
            [
                'name' => 'Food Distribution',
                'description' => 'Food and Prasad distribution',
            ],
            [
                'name' => 'Temple Maintenance',
                'description' => 'Temple repair and maintenance',
            ],
            [
                'name' => 'Office & Administration',
                'description' => 'Office and administrative expenses',
            ],
            [
                'name' => 'Other',
                'description' => 'Other organizational expenses',
            ],
        ];

        foreach ($categories as $category) {
            ExpenseCategory::firstOrCreate(
                ['name' => $category['name']],
                $category
            );
        }
    }
}
