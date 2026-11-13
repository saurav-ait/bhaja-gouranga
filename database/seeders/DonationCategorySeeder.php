<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\DonationCategory;

class DonationCategorySeeder extends Seeder
{
    public function run(): void
    {
        $categories = [
            'General Donation',
            'Puja & Festival',
            'Bhakta Seva',
            'Winter Clothing Distribution',
            'Children Gita Education',
            'Temple Maintenance',
            'Food Distribution',
            'Other',
        ];

        foreach ($categories as $category) {
            DonationCategory::firstOrCreate([
                'name' => $category,
            ]);
        }
    }
}