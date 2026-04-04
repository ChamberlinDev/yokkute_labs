<?php

namespace App\Http\Controllers;

use App\Models\Partner;
use App\Models\Service;
use App\Models\TeamMember;
use Illuminate\View\View;

class PageController extends Controller
{
    public function home(): View
    {
        return view('home', [
            'partners' => Partner::query()->where('is_active', true)->orderBy('order_column')->get(),
        ]);
    }

    public function contact(): View
    {
        return view('contact');
    }

    public function about(): View
    {
        return view('propos', [
            'teamMembers' => TeamMember::query()
                ->where('is_active', true)
                ->whereNotNull('name')
                ->where('name', '!=', '')
                ->whereNotNull('role')
                ->where('role', '!=', '')
                ->whereNotNull('image_path')
                ->where('image_path', '!=', '')
                ->orderBy('order_column')
                ->get(),
            'partners' => Partner::query()->where('is_active', true)->orderBy('order_column')->get(),
        ]);
    }

    public function services(): View
    {
        return view('service', [
            'services' => Service::query()
                ->where('is_published', true)
                ->orderBy('order_column')
                ->get(),
        ]);
    }

    public function rejoindre(): View
    {
        return view('rejoindre');
    }

    public function faq(): View
    {
        return view('faq');
    }

    public function rgpd(): View
    {
        return view('rgpd');
    }
}