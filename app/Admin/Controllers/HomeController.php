<?php

namespace App\Admin\Controllers;

use App\Http\Controllers\Controller;
use Encore\Admin\Layout\Content;

class HomeController extends Controller
{
    public function index(Content $content)
    {
        return $content
            ->title('Dashboard')
            ->row(('Selamat Datang di Aplikasi E-bank Sampah TPS 3r Sido Makmur'));
    }
}
