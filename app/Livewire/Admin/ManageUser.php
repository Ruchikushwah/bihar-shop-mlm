<?php

namespace App\Livewire\Admin;

use App\Models\Membership;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithPagination;



class ManageUser extends Component
{
    use WithPagination;

  

    public function viewUser($userId)
    {
        return redirect()->route('admin.view-user', ['userId' => $userId]);
    }
    
    public function render()
    {
        $users = User::paginate(10);
        return view('livewire.admin.manage-user', [
            'users' => $users,
        ]);
    }
}
