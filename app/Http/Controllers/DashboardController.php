<?php

namespace App\Http\Controllers;

use App\Models\Rusunawa;
use App\Models\Retribution;
use App\Models\User;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function show(){
        return view('admin.dashboard', [
            'totalRusun' => $this->totalRusun(),
            'totalRetribution' => $this->totalRetribution(),
            'totalUser' => $this->totalUser(),
        ]);
    }

    public function totalRusun(){
        $res = Rusunawa::count();
        return $res;
    }

    public function totalRetribution(){
        $res = Retribution::count();
        return $res;
    }

    public function totalUser(){
        $res = User::count();
        return $res;
    }
}
