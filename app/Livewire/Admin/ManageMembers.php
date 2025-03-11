<?php

namespace App\Livewire\Admin;

use App\Livewire\Membership\Membership as MembershipMembership;
use App\Models\Membership;
use Livewire\Component;
use Livewire\WithPagination;

class ManageMembers extends Component
{
    use WithPagination;

    public function deleteMembers(Membership $members)
    {
        $members->delete();
        $this->render();
    }
    public function render()
    {

        $members = Membership::paginate(15);
        return view('livewire.admin.manage-members', [
            'members' => $members,
        ]);
    }
}
