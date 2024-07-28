<?php

namespace Database\Seeders;

use App\Models\NutritionType;
use App\Models\Product;
use Illuminate\Database\Seeder;
use Image;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $products = [
            [
                'name' => 'CN-G',
                'image' => 'cn-g.jpeg',
                'price' => fake()->numberBetween(10_000, 200_000),
                'stock' => fake()->numberBetween(0, 50),
                'description' => 'It is a fertilizer that can increase nitrogen nutrition in various types of plants',
                'type' => 'Powder',
                'metadata' => 'CN-G, Nitrate Nitrogen, Calcium, Powder, It is a fertilizer that can increase nitrogen nutrition in various types of plants',
                'nutrition_types' => ['Nitrate Nitrogen', 'Calcium']
            ],
            [
                'name' => 'CSN',
                'image' => 'csn.jpeg',
                'price' => fake()->numberBetween(10_000, 200_000),
                'stock' => fake()->numberBetween(0, 50),
                'description' => 'Single macro fertilizer contains Nitrogen in the form of Nitrate which is easily soluble and easily absorbed by plants.',
                'type' => 'Powder',
                'metadata' => 'CSN, Nitrogen, Powder, Single macro fertilizer contains Nitrogen in the form of Nitrate which is easily soluble and easily absorbed by plants.',
                'nutrition_types' => ['Nitrogen']
            ],
            [
                'name' => 'Magnit',
                'image' => 'magnit.jpeg',
                'price' => fake()->numberBetween(10_000, 200_000),
                'stock' => fake()->numberBetween(0, 50),
                'description' => 'Fertilizer containing magnersium and nitrogen in prill form',
                'type' => 'Powder',
                'metadata' => 'Magnit, Magnesium, Nitrogen, Powder, Fertilizer containing magnersium and nitrogen in prill form',
                'nutrition_types' => ['Magnesium', 'Nitrogen']
            ],
            [
                'name' => 'ZNURECOTE',
                'image' => 'znurecote.png',
                'price' => fake()->numberBetween(10_000, 200_000),
                'stock' => fake()->numberBetween(0, 50),
                'description' => 'Contains Urea Argon to reduce dosage and increase nitrogen nutrition',
                'type' => 'Powder',
                'metadata' => 'ZNURECOTE, Argon Urea Nitrogen, Powder, Contains Urea Argon to reduce dosage and increase nitrogen nutrition',
                'nutrition_types' => ['Argon Urea Nitrogen']
            ],
            [
                'name' => 'ZA Pak Tani',
                'image' => 'za-pak-tani.png',
                'price' => fake()->numberBetween(10_000, 200_000),
                'stock' => fake()->numberBetween(0, 50),
                'description' => 'Macro fertilizer containing the nutrients Nitrogen and Sulfur',
                'type' => 'Powder',
                'metadata' => 'ZA Pak Tani, Nitrogen, Sulfur, Powder, Macro fertilizer containing the nutrients Nitrogen and Sulfur',
                'nutrition_types' => ['Nitrogen', 'Sulfur']
            ],
            [
                'name' => 'KS Pak Tani',
                'image' => 'ks-pak-tani.jpg',
                'price' => fake()->numberBetween(10_000, 200_000),
                'stock' => fake()->numberBetween(0, 50),
                'description' => 'Fertilizer with a fairly high calcium and nitrogen content in the form of nitrate',
                'type' => 'Powder',
                'metadata' => 'KS Pak Tani, Calcium, Nitrogen, Powder, Fertilizer with a fairly high calcium and nitrogen content in the form of nitrate',
                'nutrition_types' => ['Calcium', 'Nitrogen']
            ],
            [
                'name' => 'KS Plus',
                'image' => 'ks-plus.jpeg',
                'price' => fake()->numberBetween(10_000, 200_000),
                'stock' => fake()->numberBetween(0, 50),
                'description' => 'Fertilizer with high nitrogen content and ammonium with good composition',
                'type' => 'Powder',
                'metadata' => 'KS Plus, Nitrogen, Ammonium, Powder, Fertilizer with high nitrogen content and ammonium with good composition',
                'nutrition_types' => ['Nitrogen', 'Ammonium']
            ],
            [
                'name' => 'SSP-18',
                'image' => 'ssp-18.jpg',
                'price' => fake()->numberBetween(10_000, 200_000),
                'stock' => fake()->numberBetween(0, 50),
                'description' => 'Fertilizer containing the main nutrient phosphorus in the form of p205 is granular',
                'type' => 'Powder',
                'metadata' => 'SSP-18, Phosphorus, Mahnesium, Powder, Fertilizer containing the main nutrient phosphorus in the form of p205 is granular',
                'nutrition_types' => ['Phosphorus', 'Mahnesium']
            ],
            [
                'name' => 'SP-18',
                'image' => 'sp-18.jpg',
                'price' => fake()->numberBetween(10_000, 200_000),
                'stock' => fake()->numberBetween(0, 50),
                'description' => 'Fertilizer with a phosphorus content of 18% in the form of p205, and in granular form',
                'type' => 'Powder',
                'metadata' => 'SP-18, Phosphor, Powder, Fertilizer with a phosphorus content of 18% in the form of p205, and in granular form',
                'nutrition_types' => ['Phosphor']
            ],
            [
                'name' => 'SP-27',
                'image' => 'sp-27.jpeg',
                'price' => fake()->numberBetween(10_000, 200_000),
                'stock' => fake()->numberBetween(0, 50),
                'description' => 'Fertilizer with a phosphorus content of 27% in the form of p205',
                'type' => 'Powder',
                'metadata' => 'SP-27, Phosphor, Powder, Fertilizer with a phosphorus content of 27% in the form of p205',
                'nutrition_types' => ['Phosphor']
            ],
            [
                'name' => 'TSP-36',
                'image' => 'tsp-36.jpeg',
                'price' => fake()->numberBetween(10_000, 200_000),
                'stock' => fake()->numberBetween(0, 50),
                'description' => 'Fertilizer with a phosphorus content of 36% in granular form',
                'type' => 'Powder',
                'metadata' => 'TSP-36, Phosphor, Powder, Fertilizer with a phosphorus content of 36% in granular form',
                'nutrition_types' => ['Phosphor']
            ],
            [
                'name' => 'MerokeTSP',
                'image' => 'meroketsp.jpeg',
                'price' => fake()->numberBetween(10_000, 200_000),
                'stock' => fake()->numberBetween(0, 50),
                'description' => 'Fertilizer with 46% phosphorus content in granular form',
                'type' => 'Powder',
                'metadata' => 'MerokeTSP, Phosphor, Powder, Fertilizer with 46% phosphorus content in granular form',
                'nutrition_types' => ['Phosphor']
            ],
            [
                'name' => 'Agrophos',
                'image' => 'agrophos.jpeg',
                'price' => fake()->numberBetween(10_000, 200_000),
                'stock' => fake()->numberBetween(0, 50),
                'description' => 'Fertilizer with a phosphorus content of 46% in liquid form that is easy to apply',
                'type' => 'Liquid',
                'metadata' => 'Agrophos, Phosphor, Liquid, Fertilizer with a phosphorus content of 46% in liquid form that is easy to apply',
                'nutrition_types' => ['Phosphor']
            ],
            [
                'name' => 'Fertiphos',
                'image' => 'fertiphos.jpg',
                'price' => fake()->numberBetween(10_000, 200_000),
                'stock' => fake()->numberBetween(0, 50),
                'description' => 'Compound fertilizer containing phosphorus, sulfur and boron',
                'type' => 'Powder',
                'metadata' => 'Fertiphos, Phosphorus, Sulfur, Powder, Compound fertilizer containing phosphorus, sulfur and boron',
                'nutrition_types' => ['Phosphorus', 'Sulfur']
            ],
            [
                'name' => 'MKP',
                'image' => 'mkp.jpg',
                'price' => fake()->numberBetween(10_000, 200_000),
                'stock' => fake()->numberBetween(0, 50),
                'description' => 'Compound fertilizer with 52% phosphorus and 32% potassium',
                'type' => 'Powder',
                'metadata' => 'MKP, Phosphorus, Potassium, Powder, Compound fertilizer with 52% phosphorus and 32% potassium',
                'nutrition_types' => ['Phosphorus', 'Potassium']
            ],
            [
                'name' => 'SuburKali',
                'image' => 'suburkali.jpeg',
                'price' => fake()->numberBetween(10_000, 200_000),
                'stock' => fake()->numberBetween(0, 50),
                'description' => 'This fertilizer is a compound fertilizer with a balanced content of three nutrient elements',
                'type' => 'Powder',
                'metadata' => 'SuburKali, Potassium Magnesium Sulfur, Powder, This fertilizer is a compound fertilizer with a balanced content of three nutrient elements',
                'nutrition_types' => ['Potassium Magnesium Sulfur']
            ],
            [
                'name' => 'MerokeKKB',
                'image' => 'merokeKKB.jpg',
                'price' => fake()->numberBetween(10_000, 200_000),
                'stock' => fake()->numberBetween(0, 50),
                'description' => 'MerokeKKB contains the nutrients Potassium, Magnesium, Sulfur and Boron. Composition: 40.0 % K20 (Potassium Oxide) 6.0 % MgO (Magnesium Oxide) 4.0 % S (Sulfur) 0.8 % B203 (Boron Oxide).',
                'type' => 'Powder',
                'metadata' => 'MerokeKKB, Potassium Magnesium Sulfur Boron, Powder, MerokeKKB contains the nutrients Potassium, Magnesium, Sulfur and Boron. Composition: 40.0 % K20 (Potassium Oxide) 6.0 % MgO (Magnesium Oxide) 4.0 % S (Sulfur) 0.8 % B203 (Boron Oxide).',
                'nutrition_types' => ['Potassium Magnesium Sulfur Boron']
            ],
            [
                'name' => 'MerokeMOP',
                'image' => 'merokeMOP.jpeg',
                'price' => fake()->numberBetween(10_000, 200_000),
                'stock' => fake()->numberBetween(0, 50),
                'description' => 'MerokeMOP Fertilizer is a single KCI fertilizer containing 60% Potassium (K20), in the form of fine crystals',
                'type' => 'Powder',
                'metadata' => 'MerokeMOP, Potassium, Powder, MerokeMOP Fertilizer is a single KCI fertilizer containing 60% Potassium (K20), in the form of fine crystals',
                'nutrition_types' => ['Potassium']
            ],
            [
                'name' => 'Provit Orange',
                'image' => 'proit-orange.jpeg',
                'price' => fake()->numberBetween(10_000, 200_000),
                'stock' => fake()->numberBetween(0, 50),
                'description' => 'Water-soluble NPK 8-9-39+3MgO+TE complete compound fertilizer specially formulated for agriculture with high potassium (K) content.',
                'type' => 'Powder',
                'metadata' => 'Provit Orange, Potassium, Powder, Water-soluble NPK 8-9-39+3MgO+TE complete compound fertilizer specially formulated for agriculture with high potassium (K) content.',
                'nutrition_types' => ['Potassium']
            ],
            [
                'name' => 'MerokeKALINITRA',
                'image' => 'merokeKALINITRA.jpg',
                'price' => fake()->numberBetween(10_000, 200_000),
                'stock' => fake()->numberBetween(0, 50),
                'description' => 'Fertilizer in crystal form, pure white with water soluble Nitrogen (N) and Potassium (K), is a suitable choice for a wide range of horticultural crops',
                'type' => 'Powder',
                'metadata' => 'MerokeKALINITRA, Potassium Nitrogen, Powder, Fertilizer in crystal form, pure white with water soluble Nitrogen (N) and Potassium (K), is a suitable choice for a wide range of horticultural crops',
                'nutrition_types' => ['Potassium Nitrogen']
            ],
            [
                'name' => 'MerokeSOP',
                'image' => 'merokesop.png',
                'price' => fake()->numberBetween(10_000, 200_000),
                'stock' => fake()->numberBetween(0, 50),
                'description' => 'MerokeSOP contains ideal levels of Potassium (K) for plants sensitive to Chloride (CI). Contains 52% Potassium Oxide (K2O), and 18% Sulfur (S).',
                'type' => 'Powder',
                'metadata' => 'MerokeSOP, Potassium Chloride Sulfur, Powder, MerokeSOP contains ideal levels of Potassium (K) for plants sensitive to Chloride (CI). Contains 52% Potassium Oxide (K2O), and 18% Sulfur (S).',
                'nutrition_types' => ['Potassium Chloride Sulfur']
            ]
        ];

        foreach ($products as $product) {
            $createdProduct = Product::create([
                'name' => $product['name'],
                'price' => $product['price'],
                'stock' => $product['stock'],
                'description' => $product['description'],
                'type' => $product['type'],
                'metadata' => $product['metadata'],
            ]);

            $createdProduct->uploadImageFromPath("images/" . $product["image"], "product", str($createdProduct->name)->slug("_"));

            // Attach nutrition types
            foreach ($product['nutrition_types'] as $nutritionType) {
                $nutritionTypeModel = NutritionType::firstOrCreate(['name' => $nutritionType]);
                $createdProduct->nutritionTypes()->attach($nutritionTypeModel);
            }
        }
    }
}
