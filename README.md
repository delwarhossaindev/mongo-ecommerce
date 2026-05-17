<h1 align="center">
  <img src="public/favicon.svg" width="80" alt="AamGhor logo"><br>
  AamGhor — আমঘর
</h1>

<p align="center">
  <strong>রাজশাহীর স্বাদ আপনার দরজায়</strong><br>
  Tree-ripened, chemical-free mangoes from Rajshahi orchards, delivered across Bangladesh.
</p>

<p align="center">
  <img src="https://img.shields.io/badge/Laravel-10.x-FF2D20?logo=laravel" alt="Laravel">
  <img src="https://img.shields.io/badge/PHP-8.1+-777BB4?logo=php" alt="PHP">
  <img src="https://img.shields.io/badge/Bootstrap-5.3-7952B3?logo=bootstrap" alt="Bootstrap">
  <img src="https://img.shields.io/badge/Database-SQLite-003B57?logo=sqlite" alt="SQLite">
  <img src="https://img.shields.io/badge/Payment-SSLCommerz-1abc9c" alt="SSLCommerz">
</p>

---

## 📖 About

**AamGhor** (আমঘর — "Mango House") is a Bengali-first e-commerce platform specialising in seasonal, tree-ripened mangoes sourced directly from Rajshahi. The site features a fully localised UI (Bengali primary, English fallback), seasonal harvest scheduling, courier-aware delivery pricing, and a WhatsApp-led ordering flow.

> **Contact:** 📞 01329335577 &nbsp;•&nbsp; 💬 [WhatsApp 01797384242](https://wa.me/8801797384242) &nbsp;•&nbsp; ✉️ info@aamghor.com

---

## ✨ Features

### Storefront
- 🏠 **Bengali-first UI** with Hind Siliguri font, Bootstrap 5.3, custom green/orange theme
- 🥭 **6 mango varieties** seeded — গোপালভোগ, রানীপছন্দ, হিমসাগর, ল্যাংড়া, রুপালি, সুরমা ফজলি
- 🛒 **Shop** — filterable product grid, category/price/rating sort, pagination
- 📄 **Product detail** — gallery, ratings, related products, breadcrumb
- 🛍️ **Cart + Checkout** — session-backed cart, address capture, order tracking
- 💳 **SSLCommerz payment gateway** integration (sandbox + live)
- 👤 **Auth** — register, login, profile, change password, order history

### Marketing & UX
- 🗓️ **Harvest schedule modal** auto-shown to first-time visitors with 2026 dates
- 🚛 **Courier partners** displayed prominently — Sundarban, AJR, Janani, SA Paribahan
- 🏙️ **Delivery pricing strip** — Dhaka ৳75-80/kg, outside Dhaka ৳90/kg
- 💬 **Floating WhatsApp button** (sticky, animated, pulse notification)
- ⚡ **Splash screen** on initial page load with logo bounce animation
- 🌳 **"আমাদের বাগান থেকে" gallery** with image-failure-safe Bengali fallback
- 🎨 **Branded error pages** — 403, 404, 419, 429, 500, 503 (all Bengali)
- 📧 **Bengali email layout** for order confirmation, etc.

### SEO & Performance
- 🤖 `robots.txt` with proper allow/disallow rules
- 🗺️ Dynamic `/sitemap.xml` (home + shop + categories + products)
- 📊 **Structured data (JSON-LD)**:
  - `LocalBusiness` (with WhatsApp contact point)
  - `Product` (price, stock, brand, rating)
  - `BreadcrumbList` (for shop and product pages)
- 🔗 **Open Graph + Twitter Card** with custom SVG OG image
- ⚡ **Preconnect + DNS prefetch** for CDNs
- 🖼️ `loading="lazy"` + explicit `width`/`height` on all images (CLS-safe)
- 🎯 `fetchpriority="high"` on LCP product image
- ♿ Semantic HTML — single `<h1>` per page, ARIA labels, `prefers-reduced-motion`

---

## 🛠️ Tech Stack

| Layer | Choice |
|---|---|
| Framework | Laravel 10 |
| PHP | 8.1+ |
| Database | SQLite (default) — easily swappable to MySQL/PostgreSQL |
| Frontend | Blade templates + Bootstrap 5.3 + Bootstrap Icons |
| Fonts | Hind Siliguri (Bengali) + Georgia serif (wordmark) |
| Payment | SSLCommerz |
| Cache/Session | File-based (default) |

---

## 🚀 Installation

### Prerequisites
- PHP 8.1+
- Composer
- (Optional) Node.js — only if you customise frontend assets

### Setup

```bash
# 1. Clone or extract the project
cd d:/wamp64/www/mongo-ecommerce

# 2. Install dependencies
composer install

# 3. Environment
cp .env.example .env
php artisan key:generate

# 4. Database (SQLite — default)
# .env already points to database/database.sqlite
touch database/database.sqlite  # if it doesn't exist
php artisan migrate

# 5. Seed mango products + category
php artisan db:seed

# 6. Run dev server
php artisan serve
# → http://localhost:8000
```

### Configuration

Edit `.env`:

```dotenv
APP_NAME="AamGhor"
APP_URL=http://localhost:8000

# SSLCommerz (get from sslcommerz.com)
SSLCZ_STORE_ID=your_store_id
SSLCZ_STORE_PASSWORD=your_store_password
SSLCZ_IS_LIVE=false
```

---

## 🌱 Database Seeding

The `MangoSeeder` creates 1 category + 6 mango products with realistic Rajshahi pricing.

```bash
# Seed (idempotent — safe to re-run; uses updateOrCreate by slug)
php artisan db:seed --class=MangoSeeder

# Fresh database + seed
php artisan migrate:fresh --seed
```

| Variety | Slug | Price | Sale | Stock | Featured |
|---|---|---:|---:|---:|:-:|
| গোপালভোগ | `gopalbhog` | ৳140 | — | 500 | ⭐ |
| রানীপছন্দ | `ranipasand` | ৳130 | — | 450 | — |
| হিমসাগর | `himsagar` | ৳180 | ৳160 | 600 | ⭐ |
| ল্যাংড়া | `langra` | ৳200 | ৳180 | 550 | ⭐ |
| রুপালি | `rupali` | ৳140 | — | 500 | — |
| সুরমা ফজলি | `surma-fazli` | ৳120 | — | 700 | — |

---

## 🖼️ Required Images

Save 5 mango photos to `public/images/gallery/` with these exact names:

| File | Purpose |
|---|---|
| `mango-tree-single.jpg` | Gallery card |
| `mango-tree-cluster.jpg` | **Hero background** + gallery card |
| `mango-hand.jpg` | Gallery card |
| `mango-crate.jpg` | Gallery card |
| `mango-pile.jpg` | Gallery card |

If a file is missing, a styled Bengali fallback div is rendered (no broken images).

See [`public/images/gallery/README.txt`](public/images/gallery/README.txt) for details.

---

## 🗂️ Project Structure

```
mongo-ecommerce/
├── app/
│   ├── Http/Controllers/Web/
│   │   ├── HomeController.php
│   │   ├── ShopController.php
│   │   ├── SitemapController.php       ← dynamic XML sitemap
│   │   ├── WebAuthController.php
│   │   ├── WebCartController.php
│   │   └── WebOrderController.php
│   └── Models/
│       ├── Category.php / Product.php / Cart.php / Order.php / Payment.php
├── database/
│   ├── migrations/                     ← categories, products, carts, orders, payments
│   └── seeders/
│       ├── DatabaseSeeder.php
│       └── MangoSeeder.php             ← 6 mango varieties
├── public/
│   ├── favicon.svg                     ← icon-only logo
│   ├── robots.txt                      ← SEO rules
│   └── images/
│       ├── logo.svg                    ← full wordmark logo
│       ├── og-image.svg                ← social share (1200×630)
│       └── gallery/                    ← (you provide the 5 photos)
├── resources/views/
│   ├── layouts/app.blade.php           ← main shell (meta, splash, navbar, footer, WhatsApp)
│   ├── home.blade.php                  ← landing page
│   ├── shop/index.blade.php            ← product grid + filters
│   ├── shop/show.blade.php             ← product detail + Product schema
│   ├── partials/
│   │   ├── logo-mark.blade.php         ← reusable SVG logo (icon-only)
│   │   ├── logo-wordmark.blade.php     ← icon + "AamGhor" wordmark
│   │   └── product-card.blade.php
│   ├── errors/                         ← branded 403/404/419/429/500/503
│   └── emails/
│       ├── layout.blade.php            ← branded email shell
│       └── order-confirmation.blade.php
└── routes/web.php
```

---

## 🛣️ Routes Overview

| Method | Path | Purpose |
|---|---|---|
| GET | `/` | Home (hero, schedule, gallery, featured products) |
| GET | `/sitemap.xml` | Dynamic XML sitemap |
| GET | `/shop` | Product grid (filter, sort, search) |
| GET | `/shop/{id}` | Product detail (+ Product JSON-LD) |
| GET/POST | `/login`, `/register`, `/logout` | Auth |
| GET/PUT | `/profile`, `/profile/password` | Account |
| GET/POST/PUT/DELETE | `/cart`, `/cart/add`, `/cart/{productId}` | Cart |
| GET/POST | `/checkout`, `/orders`, `/orders/{id}` | Orders |
| POST | `/payment/{success,fail,cancel,ipn}` | SSLCommerz callbacks |

---

## 🎨 Brand

| Asset | Value |
|---|---|
| **Name** | আমঘর / AamGhor |
| **Tagline** | রাজশাহীর স্বাদ আপনার দরজায় (Taste of Rajshahi at your door) |
| **Primary Green** | `#2F5D2F` |
| **Mango Orange** | `#F4B128` |
| **Leaf Green** | `#4C8C2B` |
| **Background Cream** | `#fffdf5` |
| **WhatsApp Green** | `#25D366` |
| **Bengali Font** | Hind Siliguri (Google Fonts) |
| **Wordmark Font** | Georgia, serif |

Logo is defined in [`resources/views/partials/logo-mark.blade.php`](resources/views/partials/logo-mark.blade.php) — change once, updates everywhere.

---

## 🔧 Common Commands

```bash
# Cache management
php artisan view:clear
php artisan config:clear
php artisan cache:clear
php artisan route:clear

# Maintenance mode (503 branded page)
php artisan down
php artisan up

# Generate fresh app key
php artisan key:generate

# View all routes
php artisan route:list

# Test sitemap
curl http://localhost:8000/sitemap.xml
```

---

## 🚛 Delivery & Courier Partners

| Region | Charge (per kg) |
|---|---|
| ঢাকার ভিতরে | ৳75–80 |
| ঢাকার বাইরে | ৳90 |

**Partners:** Sundarban Courier • AJR Parcel • Janani Express • SA Paribahan

---

## 🧪 SEO Validation

After deployment, validate with:

| Tool | URL |
|---|---|
| Google Rich Results | https://search.google.com/test/rich-results |
| Facebook Sharing Debugger | https://developers.facebook.com/tools/debug/ |
| Schema.org Validator | https://validator.schema.org/ |
| PageSpeed Insights | https://pagespeed.web.dev/ |
| Sitemap Validator | https://www.xml-sitemaps.com/validate-xml-sitemap.html |

---

## 🌍 Production Deployment Checklist

- [ ] Set `APP_ENV=production` and `APP_DEBUG=false` in `.env`
- [ ] Set `APP_URL=https://aamghor.com` (real domain — for canonical URLs)
- [ ] Configure live SSLCommerz credentials (`SSLCZ_IS_LIVE=true`)
- [ ] Enable HTTPS (SEO ranking factor)
- [ ] Run `php artisan config:cache && php artisan route:cache && php artisan view:cache`
- [ ] Convert `og-image.svg` → `og-image.png` for social platforms that don't render SVG
- [ ] Submit `/sitemap.xml` to Google Search Console + Bing Webmaster Tools
- [ ] Save the 5 gallery images to `public/images/gallery/`
- [ ] Set proper file permissions on `storage/` and `bootstrap/cache/`

---

## 📞 Contact

| Channel | Value |
|---|---|
| 📞 Hotline | [01329335577](tel:01329335577) |
| 💬 WhatsApp | [01797384242](https://wa.me/8801797384242) |
| ✉️ Email | info@aamghor.com |
| 📍 Location | রাজশাহী, বাংলাদেশ |

---

## 📜 License

Built on [Laravel](https://laravel.com) (MIT). Project content, branding, and seed data © AamGhor.

---

<p align="center">
  Made with 🥭 in Rajshahi • <strong>AamGhor</strong> — Taste of Rajshahi
</p>
