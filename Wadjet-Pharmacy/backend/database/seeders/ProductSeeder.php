<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Product;

class ProductSeeder extends Seeder
{
    public function run(): void
    {
        $products = [
            ['category_id' => 1, 'supplier_id' => 1, 'name' => 'Paracetamol Tablets 500mg', 'image' => 'images/pain_relief/Paracetamol_Tablets.jpg', 'price' => 12.50, 'quantity' => 300, 'has_offer' => false, 'offer_value' => 0],
            ['category_id' => 1, 'supplier_id' => 1, 'name' => 'Ibuprofen Tablets 400mg', 'image' => 'images/pain_relief/Ibuprofen_Tablets.jpg', 'price' => 18.75, 'quantity' => 220, 'has_offer' => true, 'offer_value' => 15.00, 'start_offer' => '2026-07-01', 'end_offer' => '2026-08-31'],
            ['category_id' => 1, 'supplier_id' => 3, 'name' => 'Fast-Dissolve Pain Relief Tablets 500mg', 'image' => 'images/pain_relief/Fast_Dissolve_Pain_Relief_Tablets.jpg', 'price' => 15.00, 'quantity' => 180, 'has_offer' => false, 'offer_value' => 0],
            ['category_id' => 1, 'supplier_id' => 1, 'name' => 'Topical Muscle Pain Relief Gel', 'image' => 'images/pain_relief/Topical_Muscle_Pain_Relief_Gel.jpg', 'price' => 45.00, 'quantity' => 90, 'has_offer' => false, 'offer_value' => 0],
            ['category_id' => 1, 'supplier_id' => 5, 'name' => 'Paracetamol Syrup for Kids', 'image' => 'images/pain_relief/Paracetamol_Syrup_for_Kids.jpg', 'price' => 22.00, 'quantity' => 140, 'has_offer' => false, 'offer_value' => 0],
            ['category_id' => 1, 'supplier_id' => 1, 'name' => 'Aspirin Tablets 81mg', 'image' => 'images/pain_relief/Aspirin_Tablets.jpg', 'price' => 9.75, 'quantity' => 260, 'has_offer' => false, 'offer_value' => 0],
            ['category_id' => 1, 'supplier_id' => 5, 'name' => 'Ibuprofen Syrup for Kids', 'image' => 'images/pain_relief/Ibuprofen_Syrup_for_Kids.jpg', 'price' => 26.50, 'quantity' => 110, 'has_offer' => true, 'offer_value' => 10.00, 'start_offer' => '2026-07-01', 'end_offer' => '2026-08-31'],
            ['category_id' => 1, 'supplier_id' => 3, 'name' => 'Back Pain Relief Patches', 'image' => 'images/pain_relief/Back_Pain_Relief_Patches.jpg', 'price' => 35.00, 'quantity' => 75, 'has_offer' => false, 'offer_value' => 0],
            ['category_id' => 1, 'supplier_id' => 1, 'name' => 'Cooling Gel for Sprains', 'image' => 'images/pain_relief/Cooling_Gel_for_Sprains.jpg', 'price' => 38.00, 'quantity' => 60, 'has_offer' => false, 'offer_value' => 0],
            ['category_id' => 2, 'supplier_id' => 4, 'name' => 'Vitamin C 1000mg Effervescent Tablets', 'image' => 'images/vitamins_supplements/VitaminC.jpg', 'price' => 55.00, 'quantity' => 200, 'has_offer' => true, 'offer_value' => 20.00, 'start_offer' => '2026-07-01', 'end_offer' => '2026-08-31'],
            ['category_id' => 2, 'supplier_id' => 4, 'name' => 'Vitamin D3 1000 IU Capsules', 'image' => 'images/vitamins_supplements/VitaminD3_1000IU_Capsules.jpg', 'price' => 60.00, 'quantity' => 180, 'has_offer' => false, 'offer_value' => 0],
            ['category_id' => 2, 'supplier_id' => 4, 'name' => 'Omega-3 Fish Oil Capsules', 'image' => 'images/vitamins_supplements/Omega3_Fish_Oil_Capsules.jpg', 'price' => 95.00, 'quantity' => 130, 'has_offer' => false, 'offer_value' => 0],
            ['category_id' => 2, 'supplier_id' => 2, 'name' => 'Adult Multivitamin Tablets', 'image' => 'images/vitamins_supplements/Adult_Multivitamin_Tablets.jpg', 'price' => 110.00, 'quantity' => 150, 'has_offer' => false, 'offer_value' => 0],
            ['category_id' => 2, 'supplier_id' => 4, 'name' => 'Zinc Plus Tablets', 'image' => 'images/vitamins_supplements/Zinc_Plus_Tablets.jpg', 'price' => 40.00, 'quantity' => 170, 'has_offer' => false, 'offer_value' => 0],
            ['category_id' => 2, 'supplier_id' => 2, 'name' => 'Calcium + Magnesium + Zinc Tablets', 'image' => 'images/vitamins_supplements/Calcium_Magnesium_Zinc_Tablets.jpg', 'price' => 85.00, 'quantity' => 120, 'has_offer' => true, 'offer_value' => 15.00, 'start_offer' => '2026-07-01', 'end_offer' => '2026-08-31'],
            ['category_id' => 2, 'supplier_id' => 4, 'name' => 'Biotin Capsules for Hair & Nails', 'image' => 'images/vitamins_supplements/Biotin_Capsules_Hair_Nails.jpg', 'price' => 70.00, 'quantity' => 140, 'has_offer' => false, 'offer_value' => 0],
            ['category_id' => 2, 'supplier_id' => 2, 'name' => 'Iron Supplement Syrup', 'image' => 'images/vitamins_supplements/Iron_Supplement_Syrup.jpg', 'price' => 48.00, 'quantity' => 100, 'has_offer' => false, 'offer_value' => 0],
            ['category_id' => 2, 'supplier_id' => 4, 'name' => 'Vitamin B-Complex Tablets', 'image' => 'images/vitamins_supplements/VitaminB_Complex_Tablets.jpg', 'price' => 52.00, 'quantity' => 160, 'has_offer' => false, 'offer_value' => 0],
            ['category_id' => 2, 'supplier_id' => 2, 'name' => 'Marine Collagen Powder Sachets', 'image' => 'images/vitamins_supplements/Marine_Collagen_Powder_Sachets.jpg', 'price' => 150.00, 'quantity' => 65, 'has_offer' => true, 'offer_value' => 25.00, 'start_offer' => '2026-07-01', 'end_offer' => '2026-08-31'],
            ['category_id' => 2, 'supplier_id' => 4, 'name' => 'Probiotic Capsules for Gut Health', 'image' => 'images/vitamins_supplements/Probiotic_Capsules_Gut_Health.jpg', 'price' => 130.00, 'quantity' => 90, 'has_offer' => false, 'offer_value' => 0],
            ['category_id' => 2, 'supplier_id' => 2, 'name' => 'Glucosamine Capsules for Joint Health', 'image' => 'images/vitamins_supplements/Glucosamine_Capsules_Joint_Health.jpg', 'price' => 140.00, 'quantity' => 70, 'has_offer' => false, 'offer_value' => 0],
            ['category_id' => 3, 'supplier_id' => 6, 'name' => 'Daily Facial Moisturizer', 'image' => 'images/skincare/Daily_Facial_Moisturizer.jpg', 'price' => 65.00, 'quantity' => 150, 'has_offer' => false, 'offer_value' => 0],
            ['category_id' => 3, 'supplier_id' => 6, 'name' => 'Oily Skin Facial Cleanser', 'image' => 'images/skincare/Oily_Skin_Facial_Cleanser.jpg', 'price' => 48.00, 'quantity' => 170, 'has_offer' => false, 'offer_value' => 0],
            ['category_id' => 3, 'supplier_id' => 6, 'name' => 'Sunscreen Cream SPF 50', 'image' => 'images/skincare/Sunscreen_Cream.jpg', 'price' => 95.00, 'quantity' => 200, 'has_offer' => true, 'offer_value' => 10.00, 'start_offer' => '2026-07-01', 'end_offer' => '2026-08-31'],
            ['category_id' => 3, 'supplier_id' => 6, 'name' => 'Vitamin C Face Serum', 'image' => 'images/skincare/VitaminC_Face_Serum.jpg', 'price' => 120.00, 'quantity' => 90, 'has_offer' => false, 'offer_value' => 0],
            ['category_id' => 3, 'supplier_id' => 3, 'name' => 'Anti-Aging Cream', 'image' => 'images/skincare/Anti_Aging_Cream.jpg', 'price' => 160.00, 'quantity' => 60, 'has_offer' => false, 'offer_value' => 0],
            ['category_id' => 3, 'supplier_id' => 6, 'name' => 'Micellar Makeup Remover Solution', 'image' => 'images/skincare/Micellar_Makeup_Remover_Solution.jpg', 'price' => 55.00, 'quantity' => 130, 'has_offer' => false, 'offer_value' => 0],
            ['category_id' => 3, 'supplier_id' => 3, 'name' => 'Acne Treatment Spot Cream', 'image' => 'images/skincare/Acne_Treatment_Spot_Cream.jpg', 'price' => 70.00, 'quantity' => 110, 'has_offer' => false, 'offer_value' => 0],
            ['category_id' => 3, 'supplier_id' => 6, 'name' => 'Purifying Clay Mask', 'image' => 'images/skincare/Purifying_Clay_Mask.jpg', 'price' => 45.00, 'quantity' => 95, 'has_offer' => true, 'offer_value' => 10.00, 'start_offer' => '2026-07-01', 'end_offer' => '2026-08-31'],
            ['category_id' => 3, 'supplier_id' => 3, 'name' => 'Intensive Hand Cream', 'image' => 'images/skincare/Intensive_Hand_Cream.jpg', 'price' => 30.00, 'quantity' => 220, 'has_offer' => false, 'offer_value' => 0],
            ['category_id' => 4, 'supplier_id' => 6, 'name' => 'Anti-Dandruff Shampoo', 'image' => 'images/haircare/Anti_Dandruff_Shampoo.jpg', 'price' => 58.00, 'quantity' => 180, 'has_offer' => false, 'offer_value' => 0],
            ['category_id' => 4, 'supplier_id' => 6, 'name' => 'Nourishing Conditioner for Dry Hair', 'image' => 'images/haircare/Nourishing_Conditioner_Dry_Hair.jpg', 'price' => 50.00, 'quantity' => 160, 'has_offer' => false, 'offer_value' => 0],
            ['category_id' => 4, 'supplier_id' => 3, 'name' => 'Natural Nourishing Hair Oil', 'image' => 'images/haircare/Natural_Nourishing_Hair_Oil.jpg', 'price' => 65.00, 'quantity' => 120, 'has_offer' => false, 'offer_value' => 0],
            ['category_id' => 4, 'supplier_id' => 6, 'name' => 'Anti Hair-Loss Strengthening Serum', 'image' => 'images/haircare/Anti_Hair_Loss_Strengthening_Serum.jpg', 'price' => 145.00, 'quantity' => 70, 'has_offer' => true, 'offer_value' => 15.00, 'start_offer' => '2026-07-01', 'end_offer' => '2026-08-31'],
            ['category_id' => 4, 'supplier_id' => 5, 'name' => 'Gentle No-Tears Baby Shampoo', 'image' => 'images/haircare/Gentle_No_Tears_Baby_Shampoo.jpg', 'price' => 42.00, 'quantity' => 140, 'has_offer' => false, 'offer_value' => 0],
            ['category_id' => 4, 'supplier_id' => 3, 'name' => 'Repair Mask for Damaged Hair', 'image' => 'images/haircare/Repair_Mask _Damaged_Hair.jpg', 'price' => 75.00, 'quantity' => 85, 'has_offer' => false, 'offer_value' => 0],
            ['category_id' => 4, 'supplier_id' => 6, 'name' => 'Argan Oil for Smooth Hair', 'image' => 'images/haircare/Argan_Oil_Smooth_Hair.jpg', 'price' => 80.00, 'quantity' => 100, 'has_offer' => false, 'offer_value' => 0],
            ['category_id' => 5, 'supplier_id' => 2, 'name' => 'Whitening Toothpaste', 'image' => 'images/oralcare/Whitening_Toothpaste.jpg', 'price' => 35.00, 'quantity' => 250, 'has_offer' => false, 'offer_value' => 0],
            ['category_id' => 5, 'supplier_id' => 2, 'name' => 'Antibacterial Mouthwash', 'image' => 'images/oralcare/Antibacterial_Mouthwash.jpg', 'price' => 40.00, 'quantity' => 190, 'has_offer' => false, 'offer_value' => 0],
            ['category_id' => 5, 'supplier_id' => 3, 'name' => 'Soft Bristle Toothbrush', 'image' => 'images/oralcare/Soft_Bristle_Toothbrush.jpg', 'price' => 20.00, 'quantity' => 300, 'has_offer' => false, 'offer_value' => 0],
            ['category_id' => 5, 'supplier_id' => 3, 'name' => 'Dental Floss', 'image' => 'images/oralcare/Dental_Floss.jpg', 'price' => 15.00, 'quantity' => 260, 'has_offer' => false, 'offer_value' => 0],
            ['category_id' => 5, 'supplier_id' => 5, 'name' => 'Strawberry Kids Toothpaste', 'image' => 'images/oralcare/Strawberry_Kids_Toothpaste.jpg', 'price' => 28.00, 'quantity' => 150, 'has_offer' => true, 'offer_value' => 10.00, 'start_offer' => '2026-07-01', 'end_offer' => '2026-08-31'],
            ['category_id' => 5, 'supplier_id' => 2, 'name' => 'Fluoride Protection Gel', 'image' => 'images/oralcare/Fluoride_Protection_Gel.jpg', 'price' => 50.00, 'quantity' => 90, 'has_offer' => false, 'offer_value' => 0],
            ['category_id' => 6, 'supplier_id' => 5, 'name' => 'Baby Diapers Medium Size - Economy Pack', 'image' => 'images/babycare/Baby_Diapers_Medium_Economy.jpg', 'price' => 180.00, 'quantity' => 140, 'has_offer' => true, 'offer_value' => 15.00, 'start_offer' => '2026-07-01', 'end_offer' => '2026-08-31'],
            ['category_id' => 6, 'supplier_id' => 5, 'name' => 'Baby Wet Wipes', 'image' => 'images/babycare/Baby_Wet_Wipes.jpg', 'price' => 35.00, 'quantity' => 300, 'has_offer' => false, 'offer_value' => 0],
            ['category_id' => 6, 'supplier_id' => 5, 'name' => 'Diaper Rash Cream', 'image' => 'images/babycare/Diaper_Rash_Cream.jpg', 'price' => 45.00, 'quantity' => 160, 'has_offer' => false, 'offer_value' => 0],
            ['category_id' => 6, 'supplier_id' => 5, 'name' => 'Infant Formula Stage 1', 'image' => 'images/babycare/Infant_Formula_Stage1.jpg', 'price' => 220.00, 'quantity' => 80, 'has_offer' => false, 'offer_value' => 0],
            ['category_id' => 6, 'supplier_id' => 5, 'name' => 'Tear-Free Baby Shampoo', 'image' => 'images/babycare/Tear_Free_Baby_Shampoo.jpg', 'price' => 38.00, 'quantity' => 150, 'has_offer' => false, 'offer_value' => 0],
            ['category_id' => 6, 'supplier_id' => 5, 'name' => 'Anti-Colic Baby Bottle', 'image' => 'images/babycare/Anti_Colic_Baby_Bottle.jpg', 'price' => 95.00, 'quantity' => 100, 'has_offer' => false, 'offer_value' => 0],
            ['category_id' => 6, 'supplier_id' => 5, 'name' => 'Medical-Grade Silicone Pacifier', 'image' => 'images/babycare/Medical_Grade_Silicone_Pacifier.jpg', 'price' => 25.00, 'quantity' => 200, 'has_offer' => false, 'offer_value' => 0],
            ['category_id' => 7, 'supplier_id' => 1, 'name' => 'Cold & Flu Relief Tablets', 'image' => 'images/cold_flu/Cold_Flu_Relief_Tablets.jpg', 'price' => 30.00, 'quantity' => 220, 'has_offer' => false, 'offer_value' => 0],
            ['category_id' => 7, 'supplier_id' => 1, 'name' => 'Cough Syrup - Codeine Free', 'image' => 'images/cold_flu/Cough_Syrup.jpg', 'price' => 32.00, 'quantity' => 180, 'has_offer' => false, 'offer_value' => 0],
            ['category_id' => 7, 'supplier_id' => 1, 'name' => 'Nasal Decongestant Spray', 'image' => 'images/cold_flu/Nasal_Decongestant_Spray.jpg', 'price' => 28.00, 'quantity' => 160, 'has_offer' => true, 'offer_value' => 10.00, 'start_offer' => '2026-07-01', 'end_offer' => '2026-08-31'],
            ['category_id' => 7, 'supplier_id' => 3, 'name' => 'Throat Lozenges', 'image' => 'images/cold_flu/Throat_Lozenges.jpg', 'price' => 18.00, 'quantity' => 240, 'has_offer' => false, 'offer_value' => 0],
            ['category_id' => 7, 'supplier_id' => 4, 'name' => 'Vitamin C & Zinc Immune Support', 'image' => 'images/cold_flu/VitaminC_Zinc_Immune_Support.jpg', 'price' => 55.00, 'quantity' => 130, 'has_offer' => false, 'offer_value' => 0],
            ['category_id' => 7, 'supplier_id' => 1, 'name' => 'Saline Nasal Spray', 'image' => 'images/cold_flu/Saline_Nasal_Spray.jpg', 'price' => 22.00, 'quantity' => 190, 'has_offer' => false, 'offer_value' => 0],
        ];

        foreach ($products as $product) {
            Product::create([
                'category_id' => $product['category_id'],
                'supplier_id' => $product['supplier_id'],
                'admin_id' => 1,
                'name' => $product['name'],
                'description' => $product['name'] . ' - an over-the-counter pharmacy product. No prescription required.',
                'image' => $product['image'] ?? 'https://placehold.co/400x400/007979/FFFFFF?text=Product',
                'barcode' => null,
                'price' => $product['price'],
                'quantity' => $product['quantity'],
                'status' => $product['quantity'] > 0 ? 'available' : 'out_of_stock',
                'has_offer' => $product['has_offer'],
                'offer_value' => $product['offer_value'],
                'start_offer' => $product['start_offer'] ?? null,
                'end_offer' => $product['end_offer'] ?? null,
            ]);
        }

        // Add 50 random products
        Product::factory(50)->create();
    }
}