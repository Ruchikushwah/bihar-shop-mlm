<?php

namespace App\Livewire\Membership;

use Livewire\Attributes\Layout;
use Livewire\Component;

#[Layout('components.layouts.member-layout')]
class OnBoarding extends Component
{
    public function render()
    {
        return view('livewire.membership.on-boarding');
    }
}
