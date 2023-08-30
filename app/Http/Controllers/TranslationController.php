<?php

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class TranslationController extends Controller
{
    public function changeLocale(Request $request, $locale)
    {
        if(in_array($locale, admLanguageKeys())) {
            app()->setLocale($locale);
            session()->put('locale', $locale);
        }

        return response()->redirectToRoute('home');
    }

    public function localeSwitcher(Request $request): RedirectResponse
    {
        $params = $request->all();
        $locale = $params['locale'];
        $routeName = $params['name'];
        $slug = $params['slug'] ?? '';
        $routeModel = config('adm.route_model');
        $model = $routeModel[$routeName] ?? '';

        if(in_array($locale, admLanguageKeys())) {
            app()->setLocale($locale);
            session()->put('locale', $locale);
        }

        if(empty($slug) && !empty(route($routeName))) {
            return redirect()->route($routeName);
        }

        if(empty($model)) {
            return redirect()->route('home');
        }

        $record = $model::query()->where('slug', $slug)->first();

        if(empty($record->translations())) {
            return redirect()->route('home');
        }

        $translation = $record->translations()->where('locale', $locale)->first();

        if(!$translation) {
            return redirect()->route('home');
        }

        $newRecord = $model::query()->select('slug')->where('id', $translation->model_id)->first();

        if(!$newRecord) {
            return redirect()->route('home', $locale);
        }

        return redirect()->route($routeName, ['slug' => $newRecord->slug]);
    }
}
