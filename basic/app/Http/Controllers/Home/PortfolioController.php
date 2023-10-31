<?php

namespace App\Http\Controllers\Home;

use App\Http\Controllers\Controller;
use App\Models\Porfolio;
use Illuminate\Http\Request;

class PortfolioController extends Controller
{
    public function allPortfolio()
    {
        $portfolio = Porfolio::latest()->get();
        return view('admin.portfolio.portfolio_all',compact('portfolio'));
    }
}
