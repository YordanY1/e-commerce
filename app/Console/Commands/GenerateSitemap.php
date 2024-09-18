<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Spatie\Sitemap\Sitemap;
use Spatie\Sitemap\Tags\Url;
use Carbon\Carbon;
use App\Models\Product;
use App\Models\Category;
use App\Models\Manufacturer;

class GenerateSitemap extends Command
{
    protected $signature = 'sitemap:generate';
    protected $description = 'Generate the sitemap for the website';

    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        $baseUrl = config('app.url');

        try {
            $sitemap = Sitemap::create();

            // Add static pages
            $this->addStaticPages($sitemap, $baseUrl);

            // Add dynamic product pages
            $this->addProductPages($sitemap, $baseUrl);

            // Add dynamic category pages
            $this->addCategoryPages($sitemap, $baseUrl);

            // Add manufacturer pages
            $this->addManufacturerPages($sitemap, $baseUrl);

            // Write to file
            $sitemap->writeToFile(public_path('sitemap.xml'));

            $this->info('Sitemap generated successfully.');
        } catch (\Exception $e) {
            $this->error('An error occurred while generating the sitemap: ' . $e->getMessage());
        }
    }

    private function addStaticPages($sitemap, $baseUrl)
    {
        $staticPages = [
            ['url' => '/', 'changeFreq' => Url::CHANGE_FREQUENCY_DAILY, 'priority' => 1.0],
            ['url' => '/about', 'changeFreq' => Url::CHANGE_FREQUENCY_WEEKLY, 'priority' => 0.8],
            ['url' => '/services', 'changeFreq' => Url::CHANGE_FREQUENCY_WEEKLY, 'priority' => 0.8],
            ['url' => '/contact', 'changeFreq' => Url::CHANGE_FREQUENCY_MONTHLY, 'priority' => 0.7],
            ['url' => '/products', 'changeFreq' => Url::CHANGE_FREQUENCY_DAILY, 'priority' => 0.9],
            ['url' => '/terms', 'changeFreq' => Url::CHANGE_FREQUENCY_MONTHLY, 'priority' => 0.5],
            ['url' => '/cart', 'changeFreq' => Url::CHANGE_FREQUENCY_DAILY, 'priority' => 0.7],
            ['url' => '/checkout', 'changeFreq' => Url::CHANGE_FREQUENCY_DAILY, 'priority' => 0.9],
        ];

        foreach ($staticPages as $page) {
            $sitemap->add(Url::create($baseUrl . $page['url'])
                ->setLastModificationDate(Carbon::yesterday())
                ->setChangeFrequency($page['changeFreq'])
                ->setPriority($page['priority']));
        }
    }

    private function addProductPages($sitemap, $baseUrl)
    {
        Product::chunk(100, function ($products) use ($sitemap, $baseUrl) {
            foreach ($products as $product) {
                $sitemap->add(Url::create($baseUrl . "/product/{$product->slug}")
                    ->setLastModificationDate($product->updated_at)
                    ->setChangeFrequency(Url::CHANGE_FREQUENCY_WEEKLY)
                    ->setPriority(0.9));
            }
        });
    }

    private function addCategoryPages($sitemap, $baseUrl)
    {
        Category::chunk(100, function ($categories) use ($sitemap, $baseUrl) {
            foreach ($categories as $category) {
                $sitemap->add(Url::create($baseUrl . "/category/{$category->slug}")
                    ->setLastModificationDate($category->updated_at)
                    ->setChangeFrequency(Url::CHANGE_FREQUENCY_WEEKLY)
                    ->setPriority(0.8));
            }
        });
    }

    private function addManufacturerPages($sitemap, $baseUrl)
    {
        Manufacturer::chunk(100, function ($manufacturers) use ($sitemap, $baseUrl) {
            foreach ($manufacturers as $manufacturer) {
                $sitemap->add(Url::create($baseUrl . "/manufacturers/{$manufacturer->slug}")
                    ->setLastModificationDate($manufacturer->updated_at)
                    ->setChangeFrequency(Url::CHANGE_FREQUENCY_WEEKLY)
                    ->setPriority(0.8));
            }
        });
    }
}
