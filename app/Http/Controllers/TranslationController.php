<?php

namespace App\Http\Controllers;

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
}
