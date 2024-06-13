<?php

namespace App\Console\Commands;

use App\Models\Page;
use Illuminate\Console\Command;
use Spatie\Sitemap\Sitemap;
use Spatie\Sitemap\Tags\Url;

class GenerateSitemap extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'sitemap:generate';
    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Automatically Generate an XML Sitemap';
    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $pageSiteMap = Sitemap::create();

        $pageSiteMap->add(Url::create('/')->setPriority(0.9)->setChangeFrequency(Url::CHANGE_FREQUENCY_MONTHLY));

        Page::get()->each(function (Page $page) use ($pageSiteMap) {
            if ($page->slug === 'home') return;
            $pageSiteMap->add(Url::create("/{$page->slug}")->setPriority(0.9)->setChangeFrequency(Url::CHANGE_FREQUENCY_MONTHLY));
        });
        $pageSiteMap->writeToFile(public_path('sitemap.xml'));
    }
}
