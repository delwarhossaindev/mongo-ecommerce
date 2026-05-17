<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Response;

class SitemapController extends Controller
{
    public function index(): Response
    {
        $urls = [];

        $urls[] = [
            'loc'        => url('/'),
            'lastmod'    => now()->toAtomString(),
            'changefreq' => 'daily',
            'priority'   => '1.0',
        ];

        $urls[] = [
            'loc'        => route('shop.index'),
            'lastmod'    => now()->toAtomString(),
            'changefreq' => 'daily',
            'priority'   => '0.9',
        ];

        Category::where('is_active', true)->get()->each(function ($cat) use (&$urls) {
            $urls[] = [
                'loc'        => route('shop.index', ['category' => $cat->id]),
                'lastmod'    => optional($cat->updated_at)->toAtomString() ?? now()->toAtomString(),
                'changefreq' => 'weekly',
                'priority'   => '0.7',
            ];
        });

        Product::where('is_active', true)->get()->each(function ($product) use (&$urls) {
            $urls[] = [
                'loc'        => route('shop.show', $product->id),
                'lastmod'    => optional($product->updated_at)->toAtomString() ?? now()->toAtomString(),
                'changefreq' => 'weekly',
                'priority'   => '0.8',
            ];
        });

        $xml  = '<?xml version="1.0" encoding="UTF-8"?>' . "\n";
        $xml .= '<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">' . "\n";
        foreach ($urls as $u) {
            $xml .= "  <url>\n";
            $xml .= '    <loc>' . htmlspecialchars($u['loc']) . "</loc>\n";
            $xml .= '    <lastmod>' . $u['lastmod'] . "</lastmod>\n";
            $xml .= '    <changefreq>' . $u['changefreq'] . "</changefreq>\n";
            $xml .= '    <priority>' . $u['priority'] . "</priority>\n";
            $xml .= "  </url>\n";
        }
        $xml .= '</urlset>';

        return response($xml, 200, [
            'Content-Type'  => 'application/xml; charset=utf-8',
            'Cache-Control' => 'public, max-age=3600',
        ]);
    }
}
