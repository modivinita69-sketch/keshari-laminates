<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\CompanyInfo;

class CompanyInfoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $companyInfo = [
            [
                'key' => 'hero_title',
                'value' => 'Premium Quality Laminates',
                'type' => 'text',
            ],
            [
                'key' => 'hero_subtitle',
                'value' => 'Wholesale distributor of premium laminates, bells, promica, and decor plys for all your interior design needs.',
                'type' => 'text',
            ],
            [
                'key' => 'about_us',
                'value' => 'Keshari Laminates is a leading wholesale distributor of premium quality laminates, serving customers with excellence for over a decade. We specialize in providing high-quality laminates, bells, promica, and decorative plywood to distributors and retailers.',
                'type' => 'text',
            ],
            [
                'key' => 'mission',
                'value' => 'To provide premium quality laminates at competitive wholesale prices while maintaining the highest standards of customer service and product excellence.',
                'type' => 'text',
            ],
            [
                'key' => 'vision',
                'value' => 'To be the most trusted and preferred wholesale distributor of laminates in the region, known for quality, reliability, and customer satisfaction.',
                'type' => 'text',
            ],
            [
                'key' => 'experience',
                'value' => 'With over 15 years of experience in the laminate industry, we have built strong relationships with manufacturers and customers alike.',
                'type' => 'text',
            ],
            [
                'key' => 'address',
                'value' => 'Keshari Laminates, Industrial Area, Your City, State - 123456',
                'type' => 'text',
            ],
            [
                'key' => 'phone',
                'value' => '+91 98765 43210',
                'type' => 'text',
            ],
            [
                'key' => 'email',
                'value' => 'info@kesharilaminates.com',
                'type' => 'text',
            ],
            [
                'key' => 'business_hours',
                'value' => 'Monday - Saturday: 9:00 AM - 6:00 PM',
                'type' => 'text',
            ],
        ];

        foreach ($companyInfo as $info) {
            CompanyInfo::create($info);
        }

        echo "Company information created successfully!\n";
    }
}