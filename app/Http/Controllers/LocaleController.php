<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class LocaleController extends Controller
{
    /**
     * Set the application locale in the session.
     */
    public function setLocale($locale)
    {
        if (!in_array($locale, ['en', 'vi'])) {
            return response()->json(['error' => 'Invalid locale'], 400);
        }

        Session::put('locale', $locale);
        
        return response()->json([
            'status' => 'success',
            'locale' => $locale
        ]);
    }
}
