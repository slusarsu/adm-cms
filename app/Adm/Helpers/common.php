<?php

use App\Adm\Services\AdmService;
use App\Adm\Services\CategoryService;
use App\Adm\Services\GalleryService;
use App\Adm\Services\MenuService;
use App\Adm\Services\PageService;
use App\Adm\Services\PostService;
use App\Adm\Services\TagService;
use App\Models\MenuItem;
use Spatie\Valuestore\Valuestore;

function siteSetting(): Valuestore
{
    return Valuestore::make(config('adm.site_setting_path'));
}

function siteSettingsAll(): array
{
    return siteSetting()->all();
}

function admLogoUrl(?string $logoName = 'logo'): string
{
    return !empty(siteSetting()->get($logoName))
        ?  '/storage/'.siteSetting()->get($logoName)
        : asset('assets/images/'.$logoName.'.png');
}

function globalPaginationCount(): int
{
    $settingCount = siteSetting()->get('paginationCount');
    $configCount = config('adm.paginationCount');

    return !empty($settingCount) ? $settingCount : $configCount;
}

function admFormAction(string $hash): string
{
    return route('adm-form', $hash);
}

function pageLink($slug): string
{
    return route('page', $slug);
}

function homeLink(): string
{
    return route('home');
}

function pageDataBySlug($slug) {
    return resolve(PageService::class)->getOneBySlug($slug);
}

function parentsCategories() {
    return CategoryService::getAllParents();
}

function getAllTags() {
    return TagService::getAll();
}

function getPopularPosts(?int $paginationCount = 5, ?string $categorySlug = '') {
    return PostService::popularPosts($paginationCount, $categorySlug);
}

function admRandomImage(): string
{
    return AdmService::imageRandom();
}

function admMenuBySlug($slug) {
    $menu = MenuService::bySlug($slug);
    return !empty($menu->menu_items) ? MenuItem::tree($menu->id) : $menu->menu_items ?? [];
}

function admMenuByPosition($position) {
    $menu = MenuService::byPosition($position);
    return !empty($menu->menu_items) ? MenuItem::tree($menu->id) : $menu->menu_items ?? [];
}

function admLocales(): array
{
    return config('filament-language-switch.locales');
}

function admLanguages(): array
{
    $languages = [];

    foreach (admLocales() as $key => $locale) {
        $languages[$key] = $locale['native'];
    }

    return $languages;
}

function admLanguageKeys(): array
{
    $keys = [];

    foreach (admLocales() as $key => $locale) {
        $keys[] = $key;
    }

    return $keys;
}

function admDefaultLanguage()
{
    return siteSetting()->get('default_language');
}

function admTranslationEnabled()
{
    return siteSetting()->get('translation_enabled');
}

function admGalleryBySlug(string $slug)
{
    return GalleryService::getOneBySlug($slug);
}

function admImageLink(string $image): string
{
    return '/storage/'.$image;
}

function admRouteName(): string
{
    return request()->route()->getName() ?? '';
}

function admJsonRouteParameters(): string
{
    return json_encode(request()->route()->parameters()) ?? '';
}

function admGetSlugFromUrl() {
    $params = request()->route()->parameters();
    return $params['slug'] ?? [];
}

function admLocaleSwitcherParams(string $locale): array
{
    return [
        'name' => admRouteName(),
        'slug' => admGetSlugFromUrl(),
        'locale' => $locale,
    ];
}
