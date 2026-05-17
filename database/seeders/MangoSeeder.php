<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class MangoSeeder extends Seeder
{
    public function run(): void
    {
        $parent = Category::updateOrCreate(
            ['slug' => 'mango'],
            [
                'name'        => 'আম',
                'description' => 'রাজশাহীর ১০০% গাছে পাকা, কার্বাইড মুক্ত আম।',
                'image'       => '/images/gallery/mango-tree-cluster.jpg',
                'is_active'   => true,
            ]
        );

        $varieties = [
            [
                'name'              => 'গোপালভোগ',
                'slug'              => 'gopalbhog',
                'sku'               => 'AMG-GPB-01',
                'price'             => 140,
                'sale_price'        => null,
                'cost_price'        => 95,
                'stock'             => 500,
                'is_featured'       => true,
                'rating'            => 4.7,
                'review_count'      => 38,
                'short_description' => 'মে মাসের প্রথম দিকের আম। মিষ্টি ও সুগন্ধি, রসালো শাঁস।',
                'description'       => "গোপালভোগ রাজশাহীর সবচেয়ে আগে পাকা আমের জাতগুলোর একটি। ছোট থেকে মাঝারি সাইজের এই আমে মিষ্টি স্বাদ ও দারুণ সুগন্ধ থাকে। শাঁস কমলা-হলুদ, রসালো এবং আঁশ কম।\n\n• সংগ্রহের সময়: মে'র দ্বিতীয় সপ্তাহ\n• গড় ওজন: ২০০-৩০০ গ্রাম\n• স্বাদ: মিষ্টি, সুগন্ধি\n• ১০০% গাছে পাকা, কার্বাইড মুক্ত",
                'harvest_date'      => '২২ মে',
                'tags'              => ['গাছে পাকা', 'মিষ্টি', 'সুগন্ধি', 'আগাম জাত', 'গোপালভোগ'],
            ],
            [
                'name'              => 'রানীপছন্দ',
                'slug'              => 'ranipasand',
                'sku'               => 'AMG-RNP-02',
                'price'             => 130,
                'sale_price'        => null,
                'cost_price'        => 90,
                'stock'             => 450,
                'is_featured'       => false,
                'rating'            => 4.5,
                'review_count'      => 24,
                'short_description' => 'নামের মতোই রাণীর পছন্দ — মাঝারি সাইজের মিষ্টি আম।',
                'description'       => "রানীপছন্দ একটি জনপ্রিয় ও মিষ্টি আম। মাঝারি আকারের, সবুজ-হলুদ খোসা এবং উজ্জ্বল কমলা শাঁস। আঁশ খুবই কম, তাই খেতে আরামদায়ক।\n\n• সংগ্রহের সময়: মে'র শেষ সপ্তাহ\n• গড় ওজন: ২৫০-৩৫০ গ্রাম\n• স্বাদ: হালকা মিষ্টি, রসালো\n• বাচ্চাদের জন্য আদর্শ",
                'harvest_date'      => '২৫ মে',
                'tags'              => ['গাছে পাকা', 'মিষ্টি', 'আঁশ মুক্ত', 'রানীপছন্দ'],
            ],
            [
                'name'              => 'হিমসাগর',
                'slug'              => 'himsagar',
                'sku'               => 'AMG-HMS-03',
                'price'             => 180,
                'sale_price'        => 160,
                'cost_price'        => 120,
                'stock'             => 600,
                'is_featured'       => true,
                'rating'            => 4.9,
                'review_count'      => 92,
                'short_description' => 'রাজশাহীর "আমের রাজা" — অসাধারণ মিষ্টি ও সুগন্ধ। আঁশ নেই।',
                'description'       => "হিমসাগর (খিরসাপাত) রাজশাহীর সবচেয়ে জনপ্রিয় ও প্রশংসিত আম। মাখনের মতো মসৃণ শাঁস, ভরপুর মিষ্টি ও মন মাতানো সুগন্ধ। সম্পূর্ণ আঁশ মুক্ত।\n\n• সংগ্রহের সময়: মে'র শেষ\n• গড় ওজন: ৩০০-৪০০ গ্রাম\n• স্বাদ: প্রিমিয়াম মিষ্টি\n• GI ট্যাগপ্রাপ্ত জাত\n• বিশেষ অফার: ২০৳ ছাড়",
                'harvest_date'      => '৩০ মে',
                'tags'              => ['গাছে পাকা', 'প্রিমিয়াম', 'GI ট্যাগ', 'আঁশ মুক্ত', 'হিমসাগর', 'খিরসাপাত'],
            ],
            [
                'name'              => 'ল্যাংড়া',
                'slug'              => 'langra',
                'sku'               => 'AMG-LGR-04',
                'price'             => 200,
                'sale_price'        => 180,
                'cost_price'        => 140,
                'stock'             => 550,
                'is_featured'       => true,
                'rating'            => 4.8,
                'review_count'      => 76,
                'short_description' => 'টক-মিষ্টির অনন্য মিশ্রণ। সুগন্ধে ভরপুর প্রিমিয়াম আম।',
                'description'       => "ল্যাংড়া রাজশাহীর আরেকটি বিখ্যাত জাত। সবুজ খোসা, হলুদ শাঁস, এবং অসাধারণ সুগন্ধ। মিষ্টির সাথে হালকা টকের ভারসাম্য একে অনন্য করে তোলে।\n\n• সংগ্রহের সময়: জুন'র শুরু\n• গড় ওজন: ৩০০-৪০০ গ্রাম\n• স্বাদ: মিষ্টি-টক, সুগন্ধি\n• পাকার পরেও সবুজ থাকে\n• আমপ্রেমীদের প্রথম পছন্দ",
                'harvest_date'      => '১০ জুন',
                'tags'              => ['গাছে পাকা', 'প্রিমিয়াম', 'সুগন্ধি', 'ল্যাংড়া', 'মিষ্টি-টক'],
            ],
            [
                'name'              => 'রুপালি',
                'slug'              => 'rupali',
                'sku'               => 'AMG-RPL-05',
                'price'             => 140,
                'sale_price'        => null,
                'cost_price'        => 95,
                'stock'             => 500,
                'is_featured'       => false,
                'rating'            => 4.6,
                'review_count'      => 31,
                'short_description' => 'আম্রপালির স্থানীয় নাম — মিষ্টি, ছোট দানার আম।',
                'description'       => "রুপালি (আম্রপালি) আধুনিক জাতের আম। ছোট থেকে মাঝারি সাইজের, খুব মিষ্টি এবং দীর্ঘ সময় সংরক্ষণযোগ্য। দানা ছোট, শাঁস বেশি।\n\n• সংগ্রহের সময়: জুন'র মাঝামাঝি\n• গড় ওজন: ২০০-৩০০ গ্রাম\n• স্বাদ: ভরপুর মিষ্টি\n• দীর্ঘ সংরক্ষণ\n• পরিবারের সবার জন্য",
                'harvest_date'      => '১৫ জুন',
                'tags'              => ['গাছে পাকা', 'মিষ্টি', 'ছোট দানা', 'রুপালি', 'আম্রপালি'],
            ],
            [
                'name'              => 'সুরমা ফজলি',
                'slug'              => 'surma-fazli',
                'sku'               => 'AMG-SFZ-06',
                'price'             => 120,
                'sale_price'        => null,
                'cost_price'        => 80,
                'stock'             => 700,
                'is_featured'       => false,
                'rating'            => 4.4,
                'review_count'      => 18,
                'short_description' => 'বড় সাইজের নাবি জাতের আম। আঁচার-চাটনির জন্যও দারুণ।',
                'description'       => "সুরমা ফজলি দেরিতে পাকা বড় সাইজের আম। প্রতিটি আম প্রায় ৫০০-৮০০ গ্রাম পর্যন্ত হতে পারে। তাজা খাওয়া যায়, পাশাপাশি আঁচার, চাটনি ও জুসের জন্য আদর্শ।\n\n• সংগ্রহের সময়: জুন'র শেষ\n• গড় ওজন: ৫০০-৮০০ গ্রাম\n• স্বাদ: মিষ্টি, রসালো\n• বহুমুখী ব্যবহার\n• মৌসুমের শেষ পর্যন্ত পাওয়া যায়",
                'harvest_date'      => '২০ জুন',
                'tags'              => ['গাছে পাকা', 'বড় সাইজ', 'নাবি জাত', 'সুরমা', 'ফজলি'],
            ],
        ];

        $galleryImages = [
            '/images/gallery/mango-tree-single.jpg',
            '/images/gallery/mango-tree-cluster.jpg',
            '/images/gallery/mango-hand.jpg',
            '/images/gallery/mango-crate.jpg',
            '/images/gallery/mango-pile.jpg',
        ];

        foreach ($varieties as $idx => $v) {
            Product::updateOrCreate(
                ['slug' => $v['slug']],
                [
                    'name'              => $v['name'],
                    'description'       => $v['description'],
                    'short_description' => $v['short_description'],
                    'price'             => $v['price'],
                    'sale_price'        => $v['sale_price'],
                    'cost_price'        => $v['cost_price'],
                    'sku'               => $v['sku'],
                    'stock'             => $v['stock'],
                    'category_id'       => $parent->id,
                    'images'            => [
                        $galleryImages[$idx % count($galleryImages)],
                        $galleryImages[($idx + 1) % count($galleryImages)],
                    ],
                    'attributes'        => [
                        'harvest_date'  => $v['harvest_date'],
                        'origin'        => 'রাজশাহী',
                        'chemical_free' => true,
                        'tree_ripened'  => true,
                        'unit'          => 'কেজি',
                    ],
                    'tags'              => $v['tags'],
                    'is_active'         => true,
                    'is_featured'       => $v['is_featured'],
                    'rating'            => $v['rating'],
                    'review_count'      => $v['review_count'],
                ]
            );
        }

        $this->command->info(sprintf(
            '✅ Seeded 1 category + %d mango products.',
            count($varieties)
        ));
    }
}
