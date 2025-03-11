<?php

namespace App\Livewire\Membership;

use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Layout;
use Livewire\Component;

#[Layout('components.layouts.member-layout')]
class UserDashboard extends Component
{
    public function render()
    {
        $user = Auth::user();
        return view('livewire.membership.user-dashboard',compact('user'));
    }
}
