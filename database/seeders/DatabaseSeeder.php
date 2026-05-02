<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Product;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Contact;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Disable foreign key checks
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');

        // Truncate tables to avoid duplicates
        DB::table('contacts')->truncate();
        DB::table('order_items')->truncate();
        DB::table('orders')->truncate();
        DB::table('products')->truncate();
        // Users will be updated or created

        // Create Admin User
        $admin = User::updateOrCreate(
            ['email' => 'admin@thingy.com'],
            [
                'name' => 'Admin',
                'password' => Hash::make('admin123'),
                'role' => 'admin',
                'phone' => '03001234567',
                'address' => 'Lahore, Pakistan',
            ]
        );

        // Create Regular Users
        $users = [
            [
                'name' => 'Ahmed Khan',
                'email' => 'ahmed@example.com',
                'password' => Hash::make('user123'),
                'role' => 'user',
            ],
            [
                'name' => 'Sara Malik',
                'email' => 'sara@example.com',
                'password' => Hash::make('user123'),
                'role' => 'user',
            ],
            [
                'name' => 'Fatima Noor',
                'email' => 'fatima@example.com',
                'password' => Hash::make('user123'),
                'role' => 'user',
            ],
        ];

        $createdUsers = [];
        foreach ($users as $userData) {
            $createdUsers[] = User::updateOrCreate(
                ['email' => $userData['email']],
                $userData
            );
        }

        // Create Products
        $productsData = [
            // Gadgets (4)
            [
                'name' => 'Mini Bluetooth Speaker',
                'category' => 'Gadgets',
                'price' => 1500,
                'stock' => 25,
                'short_description' => 'Compact and powerful speaker for on-the-go music.',
                'description' => 'Enjoy your favorite tunes anywhere with this mini Bluetooth speaker. It delivers crystal-clear sound with deep bass and has a long battery life. Perfect for travel, workouts, or casual listening.',
            ],
            [
                'name' => 'LED Star Projector',
                'category' => 'Gadgets',
                'price' => 2200,
                'stock' => 15,
                'short_description' => 'Create a starry night sky in your room.',
                'description' => 'Transform your bedroom into a magical wonderland with this LED star projector. It projects hundreds of stars on your ceiling and walls. Great for relaxation and creating a cozy atmosphere.',
            ],
            [
                'name' => 'Wireless Earbuds',
                'category' => 'Gadgets',
                'price' => 3500,
                'stock' => 20,
                'short_description' => 'High-quality wireless earbuds with noise cancellation.',
                'description' => 'Experience immersive audio with these wireless earbuds. They feature active noise cancellation, comfortable fit, and up to 8 hours of battery life. Ideal for music lovers and commuters.',
            ],
            [
                'name' => 'USB Night Light',
                'category' => 'Gadgets',
                'price' => 800,
                'stock' => 40,
                'short_description' => 'Portable USB-powered night light for safety.',
                'description' => 'This USB night light provides soft, warm illumination. It\'s perfect for bedrooms, hallways, or emergency situations. Easy to plug in and use anywhere with a USB port.',
            ],
            // Stationery (4)
            [
                'name' => 'Doodle Notebook',
                'category' => 'Stationery',
                'price' => 450,
                'stock' => 50,
                'short_description' => 'Creative notebook for doodling and sketching.',
                'description' => 'Unleash your creativity with this doodle notebook. It has high-quality paper perfect for pencils, pens, and markers. The compact size makes it great for on-the-go inspiration.',
            ],
            [
                'name' => 'Pastel Pen Set',
                'category' => 'Stationery',
                'price' => 350,
                'stock' => 60,
                'short_description' => 'Set of 12 colorful pastel pens.',
                'description' => 'Add a touch of color to your notes with this pastel pen set. Each pen has smooth ink flow and vibrant colors. Perfect for journaling, planning, or artistic projects.',
            ],
            [
                'name' => 'Star Sticky Notes',
                'category' => 'Stationery',
                'price' => 200,
                'stock' => 80,
                'short_description' => 'Adorable star-shaped sticky notes.',
                'description' => 'Keep track of your thoughts with these cute star sticky notes. They come in various sizes and are perfect for reminders, bookmarks, or quick notes. Fun and functional!',
            ],
            [
                'name' => 'Glitter Tape Set',
                'category' => 'Stationery',
                'price' => 550,
                'stock' => 35,
                'short_description' => 'Sparkly tape for decorating and crafting.',
                'description' => 'Make your crafts shine with this glitter tape set. It includes various widths and colors. Great for scrapbooking, card making, or adding sparkle to any project.',
            ],
            // Home Decor (3)
            [
                'name' => 'Fairy Light String',
                'category' => 'Home Decor',
                'price' => 1200,
                'stock' => 30,
                'short_description' => 'Warm fairy lights for cozy ambiance.',
                'description' => 'Create a magical atmosphere with these fairy lights. They have warm white LEDs and multiple lighting modes. Perfect for bedrooms, parties, or holiday decorations.',
            ],
            [
                'name' => 'Smiley Face Cushion',
                'category' => 'Home Decor',
                'price' => 1800,
                'stock' => 20,
                'short_description' => 'Fun smiley face throw pillow.',
                'description' => 'Brighten up your space with this adorable smiley face cushion. It\'s soft, comfortable, and adds a cheerful vibe to any room. Machine washable for easy care.',
            ],
            [
                'name' => 'Ceramic Plant Pot',
                'category' => 'Home Decor',
                'price' => 900,
                'stock' => 25,
                'short_description' => 'Elegant ceramic pot for indoor plants.',
                'description' => 'Display your favorite plants in style with this ceramic pot. It has a modern design with drainage holes. Available in various sizes to fit different plant needs.',
            ],
            // Fashion (3)
            [
                'name' => 'Squishy Bear Keychain',
                'category' => 'Fashion',
                'price' => 300,
                'stock' => 70,
                'short_description' => 'Cute squishy bear keychain accessory.',
                'description' => 'Carry your keys in style with this squishy bear keychain. It\'s soft, squeezable, and comes in multiple colors. A fun addition to bags, backpacks, or key rings.',
            ],
            [
                'name' => 'Pastel Hair Clips Set',
                'category' => 'Fashion',
                'price' => 450,
                'stock' => 55,
                'short_description' => 'Set of 6 pastel-colored hair clips.',
                'description' => 'Keep your hair in place with these pretty pastel hair clips. They have strong grips and come in assorted designs. Perfect for everyday use or special occasions.',
            ],
            [
                'name' => 'Tote Bag with Print',
                'category' => 'Fashion',
                'price' => 1100,
                'stock' => 30,
                'short_description' => 'Stylish tote bag with unique print.',
                'description' => 'Carry your essentials in this trendy tote bag. It features a unique print design and durable fabric. Spacious enough for books, groceries, or daily items.',
            ],
            // Toys (3)
            [
                'name' => 'Fidget Cube',
                'category' => 'Toys',
                'price' => 600,
                'stock' => 45,
                'short_description' => 'Stress-relieving fidget toy cube.',
                'description' => 'Relieve stress and improve focus with this fidget cube. It has multiple sides with different interactive features like buttons, switches, and gears. Compact and portable.',
            ],
            [
                'name' => 'Squishmallow Plush',
                'category' => 'Toys',
                'price' => 2500,
                'stock' => 20,
                'short_description' => 'Ultra-soft squishy plush toy.',
                'description' => 'Hug this ultra-soft squishmallow plush for ultimate comfort. It\'s perfect for cuddling and comes in various characters. Great for all ages who love soft toys.',
            ],
            [
                'name' => 'Pop It Toy',
                'category' => 'Toys',
                'price' => 400,
                'stock' => 90,
                'short_description' => 'Addictive popping sensory toy.',
                'description' => 'Enjoy hours of fun with this pop it toy. It has bubbles that make satisfying popping sounds. Helps with stress relief and fine motor skills development.',
            ],
            // Beauty (3)
            [
                'name' => 'Lip Gloss Set',
                'category' => 'Beauty',
                'price' => 750,
                'stock' => 40,
                'short_description' => 'Set of 5 shimmering lip glosses.',
                'description' => 'Achieve glossy, hydrated lips with this lip gloss set. Each shade provides long-lasting color and moisture. Perfect for everyday wear or special events.',
            ],
            [
                'name' => 'Face Mask Pack',
                'category' => 'Beauty',
                'price' => 850,
                'stock' => 35,
                'short_description' => 'Pack of 10 hydrating face masks.',
                'description' => 'Pamper your skin with these hydrating face masks. They contain nourishing ingredients for all skin types. Use once a week for glowing, refreshed skin.',
            ],
            [
                'name' => 'Nail Art Kit',
                'category' => 'Beauty',
                'price' => 1200,
                'stock' => 25,
                'short_description' => 'Complete kit for creative nail art.',
                'description' => 'Unleash your creativity with this nail art kit. It includes polishes, tools, and stickers for professional-looking designs. Great for beginners and experts alike.',
            ],
        ];

        $products = [];
        foreach ($productsData as $index => $productData) {
            $product = Product::updateOrCreate(
                ['slug' => Str::slug($productData['name'])],
                [
                    'name' => $productData['name'],
                    'description' => $productData['description'],
                    'short_description' => $productData['short_description'],
                    'price' => $productData['price'],
                    'sale_price' => null,
                    'stock' => $productData['stock'],
                    'category' => $productData['category'],
                    'image' => 'products/default.jpg',
                    'gallery' => null,
                    'is_featured' => $index < 8, // First 8 featured
                    'is_new_arrival' => $index >= 14, // Last 6 new arrivals
                    'status' => 'active',
                ]
            );
            $products[] = $product;
        }

        // Create Orders
        $ahmed = User::where('email', 'ahmed@example.com')->first();
        $sara = User::where('email', 'sara@example.com')->first();
        $fatima = User::where('email', 'fatima@example.com')->first();

        $ordersData = [
            [
                'user' => $ahmed,
                'status' => 'delivered',
                'payment_method' => 'cod',
                'customer_name' => $ahmed->name,
                'customer_email' => $ahmed->email,
                'customer_phone' => '03001234567',
                'shipping_address' => 'Karachi, Pakistan',
                'city' => 'Karachi',
                'order_note' => null,
                'items' => [
                    ['product_index' => 0, 'quantity' => 1], // Mini Bluetooth Speaker
                    ['product_index' => 2, 'quantity' => 2], // Wireless Earbuds
                ],
            ],
            [
                'user' => $sara,
                'status' => 'shipped',
                'payment_method' => 'cod',
                'customer_name' => $sara->name,
                'customer_email' => $sara->email,
                'customer_phone' => '03009876543',
                'shipping_address' => 'Islamabad, Pakistan',
                'city' => 'Islamabad',
                'order_note' => null,
                'items' => [
                    ['product_index' => 4, 'quantity' => 3], // Doodle Notebook
                    ['product_index' => 6, 'quantity' => 1], // Star Sticky Notes
                ],
            ],
            [
                'user' => $fatima,
                'status' => 'processing',
                'payment_method' => 'bank_transfer',
                'customer_name' => $fatima->name,
                'customer_email' => $fatima->email,
                'customer_phone' => '03005556677',
                'shipping_address' => 'Lahore, Pakistan',
                'city' => 'Lahore',
                'order_note' => 'Please handle with care',
                'items' => [
                    ['product_index' => 8, 'quantity' => 1], // Fairy Light String
                ],
            ],
            [
                'user' => $ahmed,
                'status' => 'confirmed',
                'payment_method' => 'cod',
                'customer_name' => $ahmed->name,
                'customer_email' => $ahmed->email,
                'customer_phone' => '03001234567',
                'shipping_address' => 'Karachi, Pakistan',
                'city' => 'Karachi',
                'order_note' => null,
                'items' => [
                    ['product_index' => 11, 'quantity' => 2], // Squishy Bear Keychain
                    ['product_index' => 14, 'quantity' => 1], // Fidget Cube
                    ['product_index' => 15, 'quantity' => 1], // Squishmallow Plush
                ],
            ],
            [
                'user' => $sara,
                'status' => 'pending',
                'payment_method' => 'cod',
                'customer_name' => $sara->name,
                'customer_email' => $sara->email,
                'customer_phone' => '03009876543',
                'shipping_address' => 'Islamabad, Pakistan',
                'city' => 'Islamabad',
                'order_note' => 'Gift wrapping please',
                'items' => [
                    ['product_index' => 17, 'quantity' => 1], // Lip Gloss Set
                    ['product_index' => 18, 'quantity' => 2], // Face Mask Pack
                ],
            ],
            [
                'user' => null,
                'status' => 'pending',
                'payment_method' => 'cod',
                'customer_name' => 'Zara Ahmed',
                'customer_email' => 'zara@example.com',
                'customer_phone' => '03004445566',
                'shipping_address' => 'Peshawar, Pakistan',
                'city' => 'Peshawar',
                'order_note' => null,
                'items' => [
                    ['product_index' => 5, 'quantity' => 1], // Pastel Pen Set
                ],
            ],
        ];

        foreach ($ordersData as $orderData) {
            $totalAmount = 0;
            $orderItems = [];

            foreach ($orderData['items'] as $item) {
                $product = $products[$item['product_index']];
                $quantity = $item['quantity'];
                $unitPrice = $product->price;
                $subtotal = $unitPrice * $quantity;
                $totalAmount += $subtotal;

                $orderItems[] = [
                    'product_id' => $product->id,
                    'product_name' => $product->name,
                    'product_image' => $product->image,
                    'unit_price' => $unitPrice,
                    'quantity' => $quantity,
                    'subtotal' => $subtotal,
                ];
            }

            $order = Order::create([
                'user_id' => $orderData['user'] ? $orderData['user']->id : null,
                'customer_name' => $orderData['customer_name'],
                'customer_email' => $orderData['customer_email'],
                'customer_phone' => $orderData['customer_phone'],
                'shipping_address' => $orderData['shipping_address'],
                'city' => $orderData['city'],
                'total_amount' => $totalAmount,
                'discount_amount' => 0,
                'final_amount' => $totalAmount,
                'status' => $orderData['status'],
                'payment_method' => $orderData['payment_method'],
                'order_note' => $orderData['order_note'],
            ]);

            foreach ($orderItems as $itemData) {
                $itemData['order_id'] = $order->id;
                OrderItem::create($itemData);
            }
        }

        // Create Contacts
        $contactsData = [
            [
                'name' => 'Bilal Qureshi',
                'email' => 'bilal@example.com',
                'subject' => 'Order Query',
                'message' => 'I want to know about my order status',
                'is_read' => true,
            ],
            [
                'name' => 'Ayesha Raza',
                'email' => 'ayesha@example.com',
                'subject' => 'Product Availability',
                'message' => 'Do you have more colors for the Squishy Bear Keychain?',
                'is_read' => false,
            ],
            [
                'name' => 'Hassan Ali',
                'email' => 'hassan@example.com',
                'subject' => 'Delivery Issue',
                'message' => 'My order has not arrived yet, please help',
                'is_read' => false,
            ],
        ];

        foreach ($contactsData as $contactData) {
            Contact::create($contactData);
        }

        // Enable foreign key checks
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
    }
}
