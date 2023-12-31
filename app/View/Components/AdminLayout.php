<?php

namespace App\View\Components;

use Illuminate\View\View;
use Illuminate\View\Component;
use Illuminate\Support\Facades\Auth;

class AdminLayout extends Component
{
    /**
     * Get the view / contents that represents the component.
     */
    public function render(): View
    {
        return view('layouts.admin', [
            'notifications' => Auth::user()->notifications()->with('notifiable:uuid,first_name,last_name')->get(),
        ]);
    }
}
