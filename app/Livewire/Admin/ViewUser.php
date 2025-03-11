<?php

namespace App\Livewire\Admin;

use App\Models\Membership;
use App\Models\User;
use Livewire\Component;

class ViewUser extends Component
{
    public $user;

    public function mount($userId)
    {
        // Load the user and its associated membership (if exists)
        $this->user = User::with('membership')->findOrFail($userId);
    }

    // This method will be called when the approval status is toggled
    public function toggleApproval()
    {
        // Toggle the user's approval status (0 to 1, or 1 to 0)
        $this->user->is_approved = !$this->user->is_approved;

        // Save the updated user status to the database
        $this->user->save();

        // If the user is approved, generate and save the referral ID
        if ($this->user->is_approved) {
            $referalId = $this->generateReferralId();
            Membership::updateOrCreate(
                ['user_id' => $this->user->id],
                ['referal_id' => $referalId]
            );
        } else {
            // If the user is not approved, remove their membership
            Membership::where('user_id', $this->user->id)->delete();
        }

        // Refresh the user and its associated membership after the update
        $this->user = $this->user->fresh('membership');

        // Provide a success message
        session()->flash('message', 'User approval status updated successfully.');
    }

    protected function generateReferralId()
    {
        // Generate a referral ID by getting the maximum ID and adding 1100
        $maxReferalId = Membership::max('id') + 1100;
        return 'BSE' . $maxReferalId;
    }

    public function render()
    {
        return view('livewire.admin.view-user');
    }
}
