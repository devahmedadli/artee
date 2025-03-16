<?php

namespace Database\Seeders;

use App\Models\Product;
use App\Models\OptionValue;
use App\Models\Requirement;
use Illuminate\Support\Str;
use App\Models\ProductOption;
use Illuminate\Database\Seeder;
use App\Models\ProductOptionValue;
use App\Models\OptionValueRequirement;
use Illuminate\Support\Facades\Storage;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create 5 products
        for ($i = 1; $i <= 3; $i++) {
            $product = Product::create([
                'ar_name' => 'منتج ' . $i,
                'en_name' => 'Product ' . $i,
                'base_price' => rand(50, 200),
                'ar_description' => 'وصف المنتج ' . $i . ' باللغة العربية. هذا نص تجريبي لوصف المنتج.',
                'en_description' => 'Description for product ' . $i . ' in English. This is a sample product description.',
                'image' => 'products/product-' . $i . '.jpg',
                'active' => true,
            ]);

            // Create placeholder image if it doesn't exist
            $this->createPlaceholderImage($product->image);

            // Create 3 options for each product
            $this->createProductOptions($product);
        }
    }

    /**
     * Create product options for a product
     */
    private function createProductOptions(Product $product): void
    {
        $optionTypes = [
            [
                'ar_name' => 'الحجم',
                'en_name' => 'Size',
                'values' => [
                    ['ar_value' => 'صغير', 'en_value' => 'Small', 'price' => 0],
                    ['ar_value' => 'متوسط', 'en_value' => 'Medium', 'price' => 10],
                    ['ar_value' => 'كبير', 'en_value' => 'Large', 'price' => 20],
                    ['ar_value' => 'كبير جداً', 'en_value' => 'X-Large', 'price' => 30],
                    ['ar_value' => 'ضخم', 'en_value' => 'XX-Large', 'price' => 40],
                ]
            ],
            [
                'ar_name' => 'اللون',
                'en_name' => 'Color',
                'values' => [
                    ['ar_value' => 'أحمر', 'en_value' => 'Red', 'price' => 5],
                    ['ar_value' => 'أزرق', 'en_value' => 'Blue', 'price' => 5],
                    ['ar_value' => 'أخضر', 'en_value' => 'Green', 'price' => 5],
                    ['ar_value' => 'أسود', 'en_value' => 'Black', 'price' => 0],
                    ['ar_value' => 'أبيض', 'en_value' => 'White', 'price' => 0],
                ]
            ],
            [
                'ar_name' => 'المادة',
                'en_name' => 'Material',
                'values' => [
                    ['ar_value' => 'قطن', 'en_value' => 'Cotton', 'price' => 0],
                    ['ar_value' => 'حرير', 'en_value' => 'Silk', 'price' => 25],
                    ['ar_value' => 'صوف', 'en_value' => 'Wool', 'price' => 15],
                    ['ar_value' => 'بوليستر', 'en_value' => 'Polyester', 'price' => 5],
                    ['ar_value' => 'جلد', 'en_value' => 'Leather', 'price' => 35],
                ]
            ]
        ];

        foreach ($optionTypes as $optionType) {
            $option = ProductOption::create([
                'product_id' => $product->id,
                'ar_name' => $optionType['ar_name'],
                'en_name' => $optionType['en_name'],
            ]);

            // Create values for each option
            foreach ($optionType['values'] as $valueData) {
                $value = OptionValue::create([
                    'option_id' => $option->id,
                    'ar_value' => $valueData['ar_value'],
                    'en_value' => $valueData['en_value'],
                    'price' => $valueData['price'],
                ]);

                // Create requirements for each value
                $this->createRequirements($value);
            }
        }
    }

    /**
     * Create requirements for a product option value
     */
    private function createRequirements(OptionValue $value): void
    {
        $requirementTypes = [
            [
                'ar_name' => 'تعليمات خاصة',
                'en_name' => 'Special Instructions',
                'type' => 'text',
                'required' => true,
            ],
            [
                'ar_name' => 'الكمية',
                'en_name' => 'Quantity',
                'type' => 'number',
                'required' => true,
            ],
            [
                'ar_name' => 'تصميم مخصص',
                'en_name' => 'Custom Design',
                'type' => 'custom_design',
                'required' => false,
            ],
            [
                'ar_name' => 'صورة مرجعية',
                'en_name' => 'Reference Image',
                'type' => 'image',
                'required' => false,
            ],
            [
                'ar_name' => 'ملف مرفق',
                'en_name' => 'Attachment',
                'type' => 'file',
                'required' => false,
            ],
            [
                'ar_name' => 'تغليف هدية',
                'en_name' => 'Gift Wrap',
                'type' => 'boolean',
                'required' => false,
            ],
        ];

        // Randomly select 3 requirements (ensuring custom_design is included)
        $customDesignIndex = array_search('custom_design', array_column($requirementTypes, 'type'));
        $selectedRequirements = [$requirementTypes[$customDesignIndex]];
        
        $otherRequirements = array_filter($requirementTypes, function($item, $key) use ($customDesignIndex) {
            return $key !== $customDesignIndex;
        }, ARRAY_FILTER_USE_BOTH);
        
        $randomRequirements = array_rand($otherRequirements, 2);
        foreach ($randomRequirements as $index) {
            $selectedRequirements[] = $otherRequirements[$index];
        }

        // Create the selected requirements
        foreach ($selectedRequirements as $reqData) {
            OptionValueRequirement::create([
                'option_value_id' => $value->id,
                'ar_name' => $reqData['ar_name'],
                'en_name' => $reqData['en_name'],
                'type' => $reqData['type'],
                'required' => $reqData['required'],
            ]);
        }
    }

    /**
     * Create a placeholder image if it doesn't exist
     */
    private function createPlaceholderImage(string $path): void
    {
        if (!Storage::disk('public')->exists($path)) {
            // Create directory if it doesn't exist
            $directory = dirname($path);
            if (!Storage::disk('public')->exists($directory)) {
                Storage::disk('public')->makeDirectory($directory);
            }

            // Copy a placeholder image or create one
            $placeholderPath = public_path('images/placeholder.jpg');
            if (file_exists($placeholderPath)) {
                Storage::disk('public')->put($path, file_get_contents($placeholderPath));
            } else {
                // Create a simple placeholder image using GD library
                $image = imagecreatetruecolor(800, 800);
                $bgColor = imagecolorallocate($image, 240, 240, 240);
                $textColor = imagecolorallocate($image, 100, 100, 100);
                imagefill($image, 0, 0, $bgColor);
                $text = 'Product Placeholder';
                imagestring($image, 5, 300, 400, $text, $textColor);
                
                ob_start();
                imagejpeg($image);
                $imageData = ob_get_clean();
                imagedestroy($image);
                
                Storage::disk('public')->put($path, $imageData);
            }
        }
    }
}
