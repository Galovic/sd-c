<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Requests;
use Flash;
use Auth;

class DashboardController extends AdminController
{
    public function index() {
        $this->setTitleDescription('Dashboard', 'Přehled');
        return view('admin.dashboard.index');
    }
}