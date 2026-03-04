<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LabExController extends Controller
{
    public function index()
    {
        return view('lab-exercises.index');
    }

    public function miniTest()
    {
        $bill = [
            'customer'  => 'Ahmed Al-Rashidi',
            'date'      => now()->format('d M Y'),
            'invoice'   => 'INV-' . rand(1000, 9999),
            'items'     => [
                ['name' => 'Whole Milk (2 L)',      'qty' => 2, 'price' => 1.25],
                ['name' => 'Sourdough Bread',        'qty' => 1, 'price' => 2.50],
                ['name' => 'Free-Range Eggs (12)',   'qty' => 1, 'price' => 3.75],
                ['name' => 'Cheddar Cheese (500 g)', 'qty' => 1, 'price' => 4.20],
                ['name' => 'Orange Juice (1 L)',     'qty' => 3, 'price' => 1.90],
                ['name' => 'Pasta (500 g)',          'qty' => 2, 'price' => 0.99],
                ['name' => 'Tomato Sauce (jar)',     'qty' => 2, 'price' => 1.60],
                ['name' => 'Chicken Breast (1 kg)',  'qty' => 1, 'price' => 6.80],
            ],
            'tax_rate'  => 0.15,
            'discount'  => 3.00,
        ];

        return view('lab-exercises.mini-test', compact('bill'));
    }

    public function transcript()
    {
        $student = [
            'name'       => 'Ahmed Al-Rashidi',
            'id'         => 'S-20240042',
            'major'      => 'Computer Science',
            'semester'   => 'Spring 2026',
            'advisor'    => 'Dr. Sarah Mitchell',
        ];

        $courses = [
            ['code' => 'CS101', 'name' => 'Introduction to Programming',  'credits' => 3, 'grade' => 'A',  'points' => 4.0],
            ['code' => 'CS201', 'name' => 'Data Structures',               'credits' => 3, 'grade' => 'B+', 'points' => 3.3],
            ['code' => 'CS301', 'name' => 'Algorithms',                    'credits' => 3, 'grade' => 'A-', 'points' => 3.7],
            ['code' => 'CS401', 'name' => 'Web Development',               'credits' => 3, 'grade' => 'A',  'points' => 4.0],
            ['code' => 'MATH201','name'=> 'Discrete Mathematics',          'credits' => 3, 'grade' => 'B',  'points' => 3.0],
            ['code' => 'SEC301', 'name' => 'Web Security Fundamentals',    'credits' => 3, 'grade' => 'A',  'points' => 4.0],
            ['code' => 'DB301',  'name' => 'Database Systems',             'credits' => 3, 'grade' => 'B+', 'points' => 3.3],
        ];

        return view('lab-exercises.transcript', compact('student', 'courses'));
    }

    public function products()
    {
        $products = [
            [
                'id'          => 1,
                'name'        => 'Wireless Noise-Cancelling Headphones',
                'price'       => 129.99,
                'description' => 'Premium over-ear headphones with 30-hour battery life, active noise cancellation, and rich sound quality.',
                'image'       => 'https://images.unsplash.com/photo-1505740420928-5e560c06d30e?w=400&h=300&fit=crop',
                'badge'       => 'Best Seller',
                'badge_color' => '#00f0ff',
            ],
            [
                'id'          => 2,
                'name'        => 'Mechanical Gaming Keyboard',
                'price'       => 89.99,
                'description' => 'RGB backlit mechanical keyboard with tactile switches, N-key rollover, and programmable macro keys.',
                'image'       => 'https://images.unsplash.com/photo-1587829741301-dc798b83add3?w=400&h=300&fit=crop',
                'badge'       => 'Hot',
                'badge_color' => '#ff00d0',
            ],
            [
                'id'          => 3,
                'name'        => 'Ultra-Wide Curved Monitor',
                'price'       => 549.00,
                'description' => '34" ultrawide QHD curved display, 144 Hz refresh rate, 1ms response time, perfect for gaming and productivity.',
                'image'       => 'https://images.unsplash.com/photo-1527443224154-c4a3942d3acf?w=400&h=300&fit=crop',
                'badge'       => 'New',
                'badge_color' => '#7cffcb',
            ],
            [
                'id'          => 4,
                'name'        => 'Ergonomic Office Chair',
                'price'       => 299.95,
                'description' => 'Lumbar support, adjustable armrests, mesh back for breathability. Designed for all-day comfort.',
                'image'       => 'https://images.unsplash.com/photo-1592078615290-033ee584e267?w=400&h=300&fit=crop',
                'badge'       => 'Sale',
                'badge_color' => '#ffcc00',
            ],
            [
                'id'          => 5,
                'name'        => 'Smart 4K Webcam',
                'price'       => 74.50,
                'description' => 'Crystal-clear 4K streaming webcam with auto-focus, HDR, built-in noise-cancelling mic, and privacy cover.',
                'image'       => 'https://images.unsplash.com/photo-1526170375885-4d8ecf77b99f?w=400&h=300&fit=crop',
                'badge'       => null,
                'badge_color' => null,
            ],
            [
                'id'          => 6,
                'name'        => 'Portable SSD 1 TB',
                'price'       => 109.00,
                'description' => 'USB-C NVMe external SSD. Read up to 1050 MB/s. Shock-resistant, pocket-sized and bus-powered.',
                'image'       => 'https://images.unsplash.com/photo-1625895197185-efcec01cffe0?w=400&h=300&fit=crop',
                'badge'       => 'Best Seller',
                'badge_color' => '#00f0ff',
            ],
        ];

        return view('lab-exercises.products', compact('products'));
    }
}
