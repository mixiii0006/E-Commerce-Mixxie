<?php

namespace Database\Seeders;

use App\Models\Address;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

/**
 * Demo data for screenshots: gothic fashion catalogue built from the
 * images in public/image, plus customers and orders across this year.
 *
 * php artisan db:seed --class=DemoSeeder
 */
class DemoSeeder extends Seeder
{
    private function img(string $file, string $dir): string
    {
        $target = storage_path("app/public/$dir");
        File::ensureDirectoryExists($target);
        $name = Str::slug(pathinfo($file, PATHINFO_FILENAME)) . '.' . pathinfo($file, PATHINFO_EXTENSION);
        File::copy(public_path("image/$file"), "$target/$name");

        return "$dir/$name";
    }

    public function run(): void
    {
        mt_srand(2026);

        // ---------- Brands ----------
        $brands = [];
        foreach ([
            'Nocturne Atelier' => 'brand1.png',
            'Hollow Skull Co.' => 'brand2.png',
            'Ravenmoor' => 'brand3.png',
            'Wraith Lace' => 'brand4.png',
            'Obsidian Sigil' => 'brand5.png',
            'Dragonthorn' => 'brand6.png',
            'Kurogane Tokyo' => 'band7.png',
            'Mourning Rose' => 'brand8.png',
        ] as $name => $file) {
            $brands[$name] = Brand::create([
                'name' => $name,
                'slug' => Str::slug($name),
                'image' => $this->img($file, 'brands'),
                'is_active' => true,
            ]);
        }

        // ---------- Categories ----------
        $categories = [];
        foreach ([
            'Boots & Shoes' => '47624cbf26cfb686df0eefb8a78a22c2.jpg',
            'Bags' => '52590e4d44100769d7d2dc5f1b02418e.jpg',
            'Corsets & Tops' => 'pngegg (5).png',
            'Dresses & Outerwear' => 'pngegg (10).png',
            'Skirts & Bottoms' => 'pngegg (16).png',
            'Chokers & Jewelry' => 'pngegg (34).png',
        ] as $name => $file) {
            $categories[$name] = Category::create([
                'name' => $name,
                'slug' => Str::slug($name),
                'image' => $this->img($file, 'categories'),
                'is_active' => true,
            ]);
        }

        // ---------- Products ----------
        // [name, category, brand, price, [images], featured, on_sale, in_stock, description]
        $catalogue = [
            ['Star Strap Platform Mary Janes', 'Boots & Shoes', 'Kurogane Tokyo', 89, ['3d7030090fa0d3521eac4fa77538aa60.jpg', 'aeae05c9266356cb19d6e380494603aa.jpg'], true, false, true, 'Chunky platform Mary Janes with twin star buckles and studded straps. Lightweight sole, 9 cm platform.'],
            ['Chain Strap Combat Boots', 'Boots & Shoes', 'Hollow Skull Co.', 149, ['47624cbf26cfb686df0eefb8a78a22c2.jpg', '47624cbf26cfb686df0eefb8a78a22c2 (1).jpg'], true, false, true, 'Heavy-duty combat boots with removable silver chains, steel-look toe cap and side zip.'],
            ['Buckle Chain Lace-Up Boots', 'Boots & Shoes', 'Ravenmoor', 119, ['68668cdcf067f92225e1d70b259d657d.jpg', '99fbb0e3b84f55e9ae571b5810eed6ae.jpg'], false, true, true, 'Mid-calf lace-up boots with a draped chain and buckle strap. Lug sole for everyday grip.'],
            ['Skull Buckle Stomper Boots', 'Boots & Shoes', 'Hollow Skull Co.', 189, ['99fbb0e3b84f55e9ae571b5810eed6ae.jpg', '68668cdcf067f92225e1d70b259d657d.jpg'], true, false, true, 'Statement stompers with metal skull plates, spiked heel and five buckle straps.'],
            ['Twin Buckle Platform Pumps', 'Boots & Shoes', 'Kurogane Tokyo', 99, ['aeae05c9266356cb19d6e380494603aa.jpg', '3d7030090fa0d3521eac4fa77538aa60.jpg'], false, false, true, 'Block-heel platform pumps with double buckle straps in glossy faux leather.'],
            ['Skull Hi-Top Platform Sneakers', 'Boots & Shoes', 'Hollow Skull Co.', 79, ['bc9b7ae2af5b19956dc5ada6cc4164c0.jpg', 'f183e95e53bdbeac7dcb308a93872ad0.jpg'], false, true, true, 'Patent hi-top sneakers with skull-and-crossbones tongue on a striped flatform sole.'],
            ['Rose Skull Print Boots', 'Boots & Shoes', 'Mourning Rose', 129, ['f183e95e53bdbeac7dcb308a93872ad0.jpg', 'bc9b7ae2af5b19956dc5ada6cc4164c0.jpg'], false, false, false, 'Lace-up work boots printed with roses and skulls. Padded collar, rubber outsole.'],
            ['Lace-Up Wedge Platform Boots', 'Boots & Shoes', 'Ravenmoor', 159, ['pngegg (39).png', 'pngegg (40).jpg'], true, false, true, 'Towering wedge boots with D-ring lacing and buckle detail. 14 cm wedge.'],
            ['Patent Platform Derby Shoes', 'Boots & Shoes', 'Obsidian Sigil', 109, ['pngegg (40).jpg', 'pngegg (39).png'], false, true, true, 'High-shine derby shoes on a chunky cleated platform.'],

            ['Occult Cat Bowler Bag', 'Bags', 'Obsidian Sigil', 69, ['52590e4d44100769d7d2dc5f1b02418e.jpg', 'ccac8f7f4956af676c31a866807aecb6.jpg'], true, false, true, 'Structured bowler bag printed with an all-seeing eye and black cats. Detachable strap.'],
            ['Studded Skull Satchel', 'Bags', 'Hollow Skull Co.', 89, ['8fae86bb40fd5b7e9cba6529475cbc80.jpg', 'eeb556b20fb5633336789e6e917ac031.jpg'], false, false, true, 'Flap satchel with skull emblem and pyramid studs. Fits a 13" tablet.'],
            ['Classic Leather Duffle Handbag', 'Bags', 'Nocturne Atelier', 119, ['97bbdedcd0cd03b93c9514bfe6786301.jpg', '8fae86bb40fd5b7e9cba6529475cbc80.jpg'], false, false, true, 'Barrel-shaped handbag in pebbled faux leather with buckle handles.'],
            ['Knuckle Handle Spiked Tote', 'Bags', 'Dragonthorn', 99, ['c2c8fcf6056309b40ad1c358f7000720.jpg', '97bbdedcd0cd03b93c9514bfe6786301.jpg'], true, true, true, 'Spiked tote with brass-knuckle handle and buckle straps across the front.'],
            ['Spirit Board Bowler Bag', 'Bags', 'Obsidian Sigil', 69, ['ccac8f7f4956af676c31a866807aecb6.jpg', '52590e4d44100769d7d2dc5f1b02418e.jpg'], false, true, true, 'Bowler bag with a spirit board print and Baphomet artwork.'],
            ['Gothic Cross Chain Crossbody', 'Bags', 'Wraith Lace', 59, ['eeb556b20fb5633336789e6e917ac031.jpg', '8fae86bb40fd5b7e9cba6529475cbc80.jpg'], false, false, true, 'Compact crossbody with silver cross and draped chain.'],
            ['Heart Chain Shoulder Bag', 'Bags', 'Kurogane Tokyo', 49, ['pngegg (41).png', 'eeb556b20fb5633336789e6e917ac031.jpg'], true, false, true, 'Glossy baguette bag with heart charms, chains and crosses.'],

            ['Red Rose Lace Camisole', 'Corsets & Tops', 'Mourning Rose', 39, ['pngegg (1).png', 'pngegg (10).png'], false, false, true, 'Red-and-black rose lace cami with ruffled hem and adjustable straps.'],
            ['Lavender Pinstripe Corset', 'Corsets & Tops', 'Nocturne Atelier', 79, ['pngegg (2).png', 'pngegg (6).png'], true, false, true, 'Steel-boned overbust corset in lavender pinstripe with cap sleeves and belt.'],
            ['Ruffled Victorian Blouse', 'Corsets & Tops', 'Wraith Lace', 45, ['pngegg (3).png', 'pngegg (10).png'], false, true, true, 'Sheer chiffon blouse with jabot ruffles and flared lace cuffs.'],
            ['Steampunk Brocade Corset', 'Corsets & Tops', 'Dragonthorn', 95, ['pngegg (12).png', 'pngegg (5).png'], false, false, true, 'Brown brocade underbust corset with brass clasp front.'],
            ['Black Lace-Up Overbust Corset', 'Corsets & Tops', 'Nocturne Atelier', 85, ['pngegg (5).png', 'pngegg (12).png'], true, false, true, 'Jacquard overbust corset with lace trim and full back lacing.'],
            ['Leather Waist Cincher', 'Corsets & Tops', 'Ravenmoor', 35, ['pngegg (22).png', 'pngegg (5).png'], false, true, true, 'Wide faux leather waist cincher with layered wrap design.'],

            ['Victorian Lace Mini Dress', 'Dresses & Outerwear', 'Wraith Lace', 99, ['pngegg (10).png', 'pngegg (11).png'], true, false, true, 'Red-and-black lace dress with corset bodice, choker collar and bell sleeves.'],
            ['Crimson Brocade Tailcoat', 'Dresses & Outerwear', 'Nocturne Atelier', 169, ['pngegg (11).png', 'pngegg (10).png'], true, false, true, 'Asymmetric tailcoat in crimson brocade with shredded hem and lace cuffs.'],
            ['Buckle Strap Faux Leather Dress', 'Dresses & Outerwear', 'Ravenmoor', 89, ['pngegg (4).png', 'pngegg (10).png'], false, true, true, 'Matte faux leather mini dress with buckle straps and ruffled skirt.'],

            ['Ruffle Tulle Layered Skirt', 'Skirts & Bottoms', 'Kurogane Tokyo', 55, ['pngegg (15).png', 'pngegg (23).png'], true, false, true, 'Asymmetric tiered skirt in black and grey tulle with zipped hip pockets.'],
            ['Red Tartan Buckle Skirt', 'Skirts & Bottoms', 'Hollow Skull Co.', 49, ['pngegg (16).png', 'pngegg (15).png'], true, true, true, 'Tiered red tartan mini with buckle straps and ruffle layers.'],
            ['Asymmetric Denim Skirt', 'Skirts & Bottoms', 'Obsidian Sigil', 39, ['pngegg (17).png', 'pngegg (20).png'], false, false, true, 'Washed black denim skirt with a raw asymmetric hem.'],
            ['Distressed Denim Shorts', 'Skirts & Bottoms', 'Obsidian Sigil', 29, ['pngegg (18).png', 'pngegg (17).png'], false, true, true, 'High-waist distressed shorts with frayed hem.'],
            ['Zip-Front Faux Leather Skirt', 'Skirts & Bottoms', 'Ravenmoor', 45, ['pngegg (19).png', 'pngegg (21).png'], false, false, true, 'Pencil mini skirt with full-length O-ring zip.'],
            ['Low-Rise Denim Mini Skirt', 'Skirts & Bottoms', 'Kurogane Tokyo', 35, ['pngegg (20).png', 'pngegg (17).png'], false, false, false, 'Y2K low-rise denim mini with pleated flounce.'],
            ['Grommet Belt Wrap Skirt', 'Skirts & Bottoms', 'Hollow Skull Co.', 49, ['pngegg (21).png', 'pngegg (19).png'], false, false, true, 'Faux leather wrap skirt with grommet belt and side zip.'],
            ['Lace Panel Maxi Skirt', 'Skirts & Bottoms', 'Wraith Lace', 65, ['pngegg (14).png', 'pngegg (23).png'], false, false, true, 'Floor-length mesh skirt with red lace panels and lacing detail.'],
            ['Bow Pleated Leather Mini', 'Skirts & Bottoms', 'Mourning Rose', 39, ['pngegg (24).png', 'pngegg (19).png'], false, true, true, 'Pleated faux leather micro skirt with bow front.'],
            ['Steampunk Layered Skirt', 'Skirts & Bottoms', 'Dragonthorn', 75, ['pngegg (7).png', 'pngegg (8).png'], false, false, true, 'Layered leather-look skirt with brass studs and striped ruffles.'],
            ['Olive Lace-Up Cargo Skirt', 'Skirts & Bottoms', 'Dragonthorn', 42, ['pngegg (8).png', 'pngegg (7).png'], false, false, true, 'Olive suede mini with lace-up front and cargo pockets.'],
            ['Grey Tulle Bubble Skirt', 'Skirts & Bottoms', 'Kurogane Tokyo', 52, ['pngegg (23).png', 'pngegg (15).png'], false, false, true, 'Puffy tulle bubble skirt with zip hip panel.'],

            ['Celestial Sun Layered Choker', 'Chokers & Jewelry', 'Nocturne Atelier', 29, ['pngegg (25).png', 'pngegg (26).png'], true, false, true, 'Triple-layer choker with sun medallion and drop crystal.'],
            ['Velvet Heart Locket Choker', 'Chokers & Jewelry', 'Mourning Rose', 19, ['pngegg (26).png', 'pngegg (29).png'], false, true, true, 'Velvet choker with gold filigree heart charm.'],
            ['O-Ring Leather Collar', 'Chokers & Jewelry', 'Hollow Skull Co.', 25, ['pngegg (27).png', 'pngegg (34).png'], false, false, true, 'Wide faux leather collar with silver O-ring.'],
            ['Amethyst Crystal Choker', 'Chokers & Jewelry', 'Wraith Lace', 22, ['pngegg (28).png', 'pngegg (31).png'], false, false, true, 'Black cord choker with raw amethyst point.'],
            ['Silver Heart Velvet Choker', 'Chokers & Jewelry', 'Mourning Rose', 18, ['pngegg (29).png', 'pngegg (26).png'], false, false, true, 'Velvet ribbon choker with engraved silver heart.'],
            ['Teardrop Gem Double Choker', 'Chokers & Jewelry', 'Nocturne Atelier', 27, ['pngegg (30).png', 'pngegg (25).png'], false, true, true, 'Double velvet band with Victorian teardrop gem.'],
            ['Amethyst Pendant Necklace', 'Chokers & Jewelry', 'Wraith Lace', 32, ['pngegg (31).png', 'pngegg (28).png'], false, false, true, 'Long silver chain with amethyst crystal pendant.'],
            ['Classic Lace Choker', 'Chokers & Jewelry', 'Kurogane Tokyo', 12, ['pngegg (32).png', 'pngegg (38).png'], false, false, true, 'Stretch lace choker in matte black.'],
            ['Bow Lace Choker', 'Chokers & Jewelry', 'Kurogane Tokyo', 15, ['pngegg (33).png', 'pngegg (32).png'], false, false, true, 'Scalloped lace choker with satin bow.'],
            ['Heart Ring Studded Choker', 'Chokers & Jewelry', 'Hollow Skull Co.', 24, ['pngegg (34).png', 'pngegg (9).png'], true, false, true, 'Studded faux leather choker with gold heart ring.'],
            ['Crescent Moon Choker', 'Chokers & Jewelry', 'Obsidian Sigil', 21, ['pngegg (35).png', 'pngegg (28).png'], false, false, true, 'Slim choker with silver crescent moon charm.'],
            ['Serpent Pendant Necklace', 'Chokers & Jewelry', 'Dragonthorn', 39, ['pngegg (36).png', 'pngegg (37).png'], true, false, true, 'Oxidised silver coiled serpent on a box chain.'],
            ['Gothic Cross Pendant', 'Chokers & Jewelry', 'Obsidian Sigil', 34, ['pngegg (37).png', 'pngegg (36).png'], false, true, true, 'Black enamel cross pendant with skull bail.'],
            ['Victorian Lace Collar', 'Chokers & Jewelry', 'Wraith Lace', 17, ['pngegg (38).png', 'pngegg (33).png'], false, false, true, 'Wide crochet lace collar choker.'],
            ['Heart Ring Leather Choker', 'Chokers & Jewelry', 'Ravenmoor', 19, ['pngegg (9).png', 'pngegg (34).png'], false, false, true, 'Faux leather choker with silver heart ring and snap closure.'],
        ];

        $products = collect();
        foreach ($catalogue as [$name, $cat, $brand, $price, $imgs, $featured, $sale, $stock, $desc]) {
            $products->push(Product::create([
                'name' => $name,
                'slug' => Str::slug($name),
                'category_id' => $categories[$cat]->id,
                'brand_id' => $brands[$brand]->id,
                'price' => $price,
                'images' => array_map(fn ($f) => $this->img($f, 'products'), $imgs),
                'description' => $desc,
                'is_active' => true,
                'is_featured' => $featured,
                'on_sale' => $sale,
                'in_stock' => $stock,
            ]));
        }

        // ---------- Users ----------
        $admin = User::updateOrCreate(['email' => 'admin@gmail.com'], [
            'name' => 'Admin MixxStore',
            'password' => Hash::make('password'),
            'email_verified_at' => now(),
        ]);
        $admin->forceFill(['created_at' => Carbon::create(2025, 12, 1)])->save();

        // Growing sign-ups across Jan–Nov 2026 (1 → 8 per month) for the customer chart
        $signupsPerMonth = [1 => 1, 2, 2, 3, 3, 4, 4, 5, 6, 7, 8];
        $firstNames = ['Ayu', 'Rizky', 'Nadia', 'Dimas', 'Salsabila', 'Kevin', 'Citra', 'Fajar', 'Intan', 'Bayu',
            'Melati', 'Raka', 'Vania', 'Yoga', 'Laras', 'Hana', 'Gilang', 'Tasya', 'Putri', 'Arif', 'Sinta', 'Bima',
            'Dewi', 'Reza', 'Kirana', 'Aditya', 'Nabila', 'Farhan', 'Zahra', 'Galih', 'Wulan', 'Iqbal', 'Rara',
            'Daffa', 'Anisa', 'Rangga', 'Shafa', 'Teguh', 'Maya', 'Bagas', 'Alya', 'Hendra', 'Tiara', 'Yudha', 'Keisha'];
        $lastNames = ['Lestari', 'Pratama', 'Putri', 'Saputra', 'Rahma', 'Wijaya', 'Anggraini', 'Nugroho', 'Maharani',
            'Setiawan', 'Kusuma', 'Aditya', 'Oktaviani', 'Firmansyah', 'Sekar', 'Febriani', 'Ramadhan', 'Amelia',
            'Hidayat', 'Permata', 'Santoso', 'Wibowo', 'Hakim', 'Purnama'];

        $customers = collect();
        $test = User::where('email', 'test@example.com')->first();
        if ($test) {
            $test->forceFill(['name' => 'Mixxie Demo', 'created_at' => Carbon::create(2025, 12, 20)])->save();
            $customers->push($test);
        }
        $n = 0;
        foreach ($signupsPerMonth as $month => $count) {
            for ($k = 0; $k < $count; $k++, $n++) {
                $name = $firstNames[$n % count($firstNames)] . ' ' . $lastNames[($n * 7) % count($lastNames)];
                $u = User::create([
                    'name' => $name,
                    'email' => Str::slug($name, '.') . ".$n@example.com",
                    'password' => Hash::make('password'),
                ]);
                $u->forceFill(['created_at' => Carbon::create(2026, $month, mt_rand(1, 24), mt_rand(8, 22))])->save();
                $customers->push($u);
            }
        }

        // ---------- Orders ----------
        $cities = [
            ['Jakarta Selatan', 'DKI Jakarta', '12190'], ['Bandung', 'Jawa Barat', '40115'],
            ['Surabaya', 'Jawa Timur', '60271'], ['Yogyakarta', 'DI Yogyakarta', '55223'],
            ['Semarang', 'Jawa Tengah', '50132'], ['Medan', 'Sumatera Utara', '20112'],
            ['Denpasar', 'Bali', '80113'], ['Makassar', 'Sulawesi Selatan', '90111'],
            ['Malang', 'Jawa Timur', '65111'], ['Bekasi', 'Jawa Barat', '17141'],
        ];
        $streets = ['Jl. Melati No. 12', 'Jl. Sudirman No. 45', 'Jl. Kenanga Raya No. 8', 'Jl. Diponegoro No. 21',
            'Jl. Merdeka No. 3', 'Jl. Gatot Subroto Kav. 9', 'Jl. Anggrek No. 17', 'Jl. Pahlawan No. 66'];
        $notes = [null, null, null, 'Tolong dibungkus rapi ya, untuk kado.', 'Kirim sore hari.', 'Titip di satpam kalau tidak ada orang.'];

        $orderCount = 0;
        for ($month = 1; $month <= 11; $month++) {
            $perMonth = 3 + $month + mt_rand(0, 3); // growing trend
            for ($n = 0; $n < $perMonth; $n++) {
                $day = $month === 11 ? mt_rand(1, 24) : mt_rand(1, 28);
                $date = Carbon::create(2026, $month, $day, mt_rand(8, 23), mt_rand(0, 59));
                $eligible = $customers->filter(fn ($c) => $c->created_at <= $date);
                $customer = $eligible->isEmpty() ? $customers->first() : $eligible->random();

                $daysAgo = $date->diffInDays(Carbon::create(2026, 11, 25));
                $roll = mt_rand(1, 100);
                if ($roll <= 6) {
                    $status = 'canceled';
                } elseif ($daysAgo > 14) {
                    $status = 'delivered';
                } elseif ($daysAgo > 7) {
                    $status = $roll < 60 ? 'shipped' : 'delivered';
                } elseif ($daysAgo <= 4) {
                    $status = 'new';
                } else {
                    $status = ['processing', 'shipped'][mt_rand(0, 1)];
                }
                $method = mt_rand(1, 100) <= 65 ? 'stripe' : 'cod';
                $payStatus = match (true) {
                    $status === 'canceled' => $method === 'stripe' ? 'failed' : 'pending',
                    $method === 'stripe' => 'paid',
                    $status === 'delivered' => 'paid',
                    default => 'pending',
                };

                $order = Order::create([
                    'user_id' => $customer->id,
                    'grand_total' => 0,
                    'payment_method' => $method,
                    'payment_status' => $payStatus,
                    'status' => $status,
                    'currency' => 'USD',
                    'shipping_amount' => 0,
                    'shipping_method' => ['JNE', 'JNT', 'SiCepat', 'Ninja'][mt_rand(0, 3)],
                    'notes' => $notes[mt_rand(0, count($notes) - 1)],
                ]);

                $total = 0;
                foreach ($products->random(mt_rand(1, 4)) as $p) {
                    $qty = mt_rand(1, 100) <= 80 ? 1 : mt_rand(2, 3);
                    $line = $p->price * $qty;
                    $total += $line;
                    $item = OrderItem::create([
                        'order_id' => $order->id,
                        'product_id' => $p->id,
                        'quantity' => $qty,
                        'unit_amount' => $p->price,
                        'total_amount' => $line,
                    ]);
                    $item->forceFill(['created_at' => $date, 'updated_at' => $date])->save();
                }

                [$first, $last] = array_pad(explode(' ', $customer->name, 2), 2, '');
                [$city, $state, $zip] = $cities[mt_rand(0, count($cities) - 1)];
                Address::create([
                    'order_id' => $order->id,
                    'first_name' => $first,
                    'last_name' => $last,
                    'phone' => '08' . mt_rand(11, 99) . mt_rand(10000000, 99999999),
                    'street_address' => $streets[mt_rand(0, count($streets) - 1)],
                    'city' => $city,
                    'state' => $state,
                    'country' => 'Indonesia',
                    'zip_code' => $zip,
                ]);

                $order->forceFill([
                    'grand_total' => $total,
                    'created_at' => $date,
                    'updated_at' => $date->copy()->addDays(min($daysAgo, mt_rand(0, 5))),
                ])->save();
                $orderCount++;
            }
        }

        $this->command?->info(sprintf(
            'Seeded %d brands, %d categories, %d products, %d customers, %d orders.',
            count($brands), count($categories), $products->count(), $customers->count(), $orderCount
        ));
    }
}
