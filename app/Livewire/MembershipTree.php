<?php

namespace App\Livewire;

use App\Models\Membership;
use Livewire\Component;

class MembershipTree extends Component
{
    public $rootMember;

    public function mount()
    {
        // Fetch the first root user (Top of the tree)
        $this->rootMember = Membership::whereNull('parent_id')->first();
    }

    public function render()
    {
        return view('livewire.membership-tree', [
            'rootMember' => $this->rootMember
        ]);
    }
}
