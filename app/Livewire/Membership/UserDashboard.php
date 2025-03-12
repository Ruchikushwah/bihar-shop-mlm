<?php
// app/Livewire/Membership/UserDashboard.php

namespace App\Livewire\Membership;

use Livewire\Component;
use App\Models\Membership;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Layout;

#[Layout('components.layouts.member-layout')]
class UserDashboard extends Component
{
    public $memberships;
    public $rootMember;

    public function mount()
    {
        $this->rootMember = Membership::with(['leftMember', 'rightMember'])
            ->where('id', Auth::id())
            ->first();
    }
    public function render()
    {
        return view('livewire.membership.user-dashboard', [
            'rootMember' => $this->rootMember
        ]);
    }
}
