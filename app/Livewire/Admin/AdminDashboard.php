<?php

namespace App\Livewire\Admin;

use App\Http\Middleware\AdminMiddleware;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class AdminDashboard extends Component
{
    public function mount()
    {
        // Use the middleware directly
        (new AdminMiddleware())->handle(request(), function () {});

        // Or directly check with Auth facade
        if (!Auth::check() || !Auth::user()->is_admin) {
            abort(403, 'Unauthorized Access');
        }
    }
    public function render()
    {
        return view('livewire.admin.admin-dashboard');
    }
}
