<?php

namespace App\Livewire\Membership;

use App\Models\Membership as ModelsMembership;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Attributes\Validate;
use Livewire\Component;
use Livewire\WithFileUploads;

#[Layout('components.layouts.member-layout')]
class Membership extends Component
{
    use WithFileUploads;

    #[Title('Membership | Bihar-shopmlm')]
    public $activeSection = 1;

    public $membershipId;
    public $referal_id, $email;
    public $name, $date_of_birth, $nationality = "", $marital_status = "", $religion = "";
    public $father_name, $mother_name, $gender = "", $home_address, $city, $state, $pincode, $mobile, $whatsapp;
    public $nominee_name, $nominee_relation = "";
    public $ifsc, $bank_name, $branch_name, $account_no, $pancard, $aadhar_card;
    public $image;

    public $completedSections = [];
    public $showConfirmation = false;

    protected $validationAttributes = [
        'referal_id' => 'Referral ID',
        'name' => 'Full Name',
        'date_of_birth' => 'Date of Birth',
        'nationality' => 'Nationality',
        'marital_status' => 'Marital Status',
        'religion' => 'Religion',
        'father_name' => 'Father\'s Name',
        'mother_name' => 'Mother\'s Name',
        'gender' => 'Gender',
        'home_address' => 'Home Address',
        'city' => 'City',
        'state' => 'State',
        'pincode' => 'Pincode',
        'mobile' => 'Mobile Number',
        'whatsapp' => 'WhatsApp Number',
        'nominee_name' => 'Nominee Name',
        'nominee_relation' => 'Nominee Relation',
        'ifsc' => 'IFSC Code',
        'bank_name' => 'Bank Name',
        'branch_name' => 'Branch Name',
        'account_no' => 'Account Number',
        'pancard' => 'PAN Card',
        'aadhar_card' => 'Aadhar Card',
        'image' => 'Profile Image',
    ];

    public function openSection($section)
    {
        if ($this->validateSection($this->activeSection)) {
            $this->activeSection = $section;
            $this->resetFormFields($section);
        }
    }

    public function updatedIfsc($value)
    {
        $this->fetchBankDetails($value);
    }

    public function fetchBankDetails($ifsc)
    {
        $response = Http::get("https://ifsc.razorpay.com/{$ifsc}");

        if ($response->successful()) {
            $bankData = $response->json();
            $this->bank_name = $bankData['BANK'] ?? 'Not Found';
            $this->branch_name = $bankData['BRANCH'] ?? 'Not Found';
        } else {
            $this->bank_name = 'Invalid IFSC';
            $this->branch_name = 'Invalid IFSC';
        }
    }

    public function validateSection($section)
    {
        $rules = [
            1 => [
                'referal_id' => ['required', 'exists:memberships,referal_id'],
            ],
            2 => [
                'name' => 'required|string|max:255',
                'date_of_birth' => 'required|date|before_or_equal:today',
                'nationality' => 'required|string|max:255',
                'marital_status' => 'required|string|max:255',
                'religion' => 'required|string|max:255',
            ],
            3 => [
                'father_name' => 'required|string|max:255',
                'mother_name' => 'required|string|max:255',
                'gender' => 'required|string|max:255',
                'home_address' => 'required|string|max:255',
                'city' => 'required|string|max:255',
                'state' => 'required|string|max:255',
                'pincode' => 'required|digits:6',
                'mobile' => 'required|regex:/^[6-9]\d{9}$/',
                'whatsapp' => 'required|regex:/^[6-9]\d{9}$/',
            ],
            4 => [
                'nominee_name' => 'required|string|max:255',
                'nominee_relation' => 'required|string|max:255',
            ],
            5 => [
                'ifsc' => 'required|string|max:255',
                'bank_name' => 'required|string|max:255',
                'branch_name' => 'required|string|max:255',
                'account_no' => 'required|digits_between:9,18',
                'pancard' => ['required', 'regex:/^[A-Z]{5}[0-9]{4}[A-Z]{1}$/'],
                'aadhar_card' => 'required|regex:/^\d{12}$/',
            ],
            6 => [
                'image' => 'required|image|max:1024',
            ],
        ];

        $messages = [
            'mobile.regex' => 'The mobile number must start with 6, 7, 8, or 9 and must be 10 digits long.',
            'whatsapp.regex' => 'The WhatsApp number must start with 6, 7, 8, or 9 and must be 10 digits long.',
            'pincode.digits' => 'Pincode must be exactly 6 digits.',
            'account_no.digits_between' => 'Account number must be between 9 and 18 digits.',
            'pancard.regex' => 'PAN card must be in the format: AAAAA9999A.',
            'aadhar_card.regex' => 'Aadhar card must be exactly 12 digits.',
        ];

        $this->validate($rules[$section] ?? [], $messages);
        return true;
    }

    public function save()
    {
        if (!$this->membershipId) {
            $this->validateSection(1);
    
            $membership = ModelsMembership::where('referal_id', $this->referal_id)->first();
    
            if ($membership) {
                $this->membershipId = $membership->id;
                $this->name = $membership->name;
    
                // Get the last referral_id, extract the number, and increment by 1
                $lastReferalId = ModelsMembership::latest('id')->value('referal_id');
                $lastNumber = intval(str_replace('BSE', '', $lastReferalId));
                $newReferalId = 'BSE' . ($lastNumber + 1);
    
                // Check if the parent is already full (both left and right are occupied)
                if ($membership->left_id && $membership->right_id) {
                    session()->flash('error', 'Both left and right positions are already filled for this parent.');
                    $this->assignToNextAvailableParent($newReferalId);
                    return;
                }
    
                // Determine whether to place the new member in the left or right position
                $position = !$membership->left_id ? 'left_id' : 'right_id';
    
                // Create a new membership with the new referral ID
                $newMembership = ModelsMembership::create([
                    'name' => $this->name,
                    'referal_id' => $newReferalId,
                    'parent_id' => $this->membershipId,
                ]);
    
                // Update the parent with the new member
                $membership->update([$position => $newMembership->id]);
    
            } else {
                session()->flash('error', 'No membership found with the provided referral ID.');
                return;
            }
        } else {
            $this->updateMembership();
        }
    
        if ($this->activeSection === 6) {
            $this->showConfirmation = true;
        } else {
            $this->activeSection++;
            $this->resetFormFields($this->activeSection);
        }
    }
    
    // Assign the new member to the next available parent if the current parent is full
    public function assignToNextAvailableParent($newReferalId)
    {
        $availableParent = ModelsMembership::whereNull('left_id')
            ->orWhereNull('right_id')
            ->first();
    
        if ($availableParent) {
            // Create a new membership under the available parent
            $newMembership = ModelsMembership::create([
                'name' => $this->name,
                'referal_id' => $newReferalId,
                'parent_id' => $availableParent->id,
            ]);
    
            // Determine left or right position and update the parent
            $position = !$availableParent->left_id ? 'left_id' : 'right_id';
            $availableParent->update([$position => $newMembership->id]);
    
            session()->flash('success', 'New member assigned to the next available parent.');
        } else {
            session()->flash('error', 'No available parent found to assign the new member.');
        }
    }
    
    // Automatically update the name when the referral ID is updated
    public function updatedReferalId($value)
    {
        $membership = ModelsMembership::where('referal_id', $value)->first();
    
        if ($membership) {
            $user = User::find($membership->user_id);
            $this->name = $user ? $user->name : '';
        } else {
            $this->name = '';
            session()->flash('error', 'No membership found with the provided referral ID.');
        }
    }
    
    // public function updatedReferalId($value)
    // {
    //     $membership = ModelsMembership::where('referal_id', $value)->first();

    //     if ($membership) {
    //         $user = User::find($membership->user_id);
    //         if ($user) {
    //             $this->name = $user->name;
    //         } else {
    //             $this->name = '';
    //         }
    //     } else {
    //         $this->name = '';
    //         session()->flash('error', 'No membership found with the provided referral ID.');
    //     }
    // }
    public function updateMembership()
    {
        $membership = ModelsMembership::find($this->membershipId);

        if (!$membership) {
            session()->flash('error', 'Membership not found.');
            return;
        }

        $data = [];
        switch ($this->activeSection) {
            case 2:
                $this->validateSection(2);
                $data = [
                    'name' => $this->name ?: Auth::user()->name,
                    'date_of_birth' => $this->date_of_birth,
                    'nationality' => $this->nationality,
                    'marital_status' => $this->marital_status,
                    'religion' => $this->religion,
                ];
                break;
            case 3:
                $this->validateSection(3);
                $data = [
                    'father_name' => $this->father_name,
                    'mother_name' => $this->mother_name,
                    'gender' => $this->gender,
                    'home_address' => $this->home_address,
                    'city' => $this->city,
                    'state' => $this->state,
                    'pincode' => $this->pincode,
                    'mobile' => $this->mobile,
                    'whatsapp' => $this->whatsapp,
                ];
                break;
            case 4:
                $this->validateSection(4);
                $data = [
                    'nominee_name' => $this->nominee_name,
                    'nominee_relation' => $this->nominee_relation,
                ];
                break;
            case 5:
                $this->validateSection(5);
                $data = [
                    'ifsc' => $this->ifsc,
                    'bank_name' => $this->bank_name,
                    'branch_name' => $this->branch_name,
                    'account_no' => $this->account_no,
                    'pancard' => $this->pancard,
                    'aadhar_card' => $this->aadhar_card,
                ];
                break;
            case 6:
                $this->validateSection(6);
                $data = [
                    'image' => $this->image->store('images', 'public'),
                ];
                break;
        }
        $membership->update($data);
        $this->completedSections[] = $this->activeSection;

        $this->activeSection++;
    }

    public function showConfirmationModal(){
        $this->showConfirmation;
    }
    public function finalSubmit()
    {
        $this->showConfirmation = true;
        $this->updateMembership();

        session()->flash('success', 'Membership form submitted successfully!');

        $this->reset();
       
        $this->activeSection = 1;
    }

    public function resetFormFields($section)
    {
        switch ($section) {
            case 1:
                $this->referal_id = '';
                break;
            case 2:
                $this->name = $this->date_of_birth = $this->nationality = $this->marital_status = $this->religion = '';
                break;
            case 3:
                $this->father_name = $this->mother_name = $this->gender = $this->home_address = $this->city = $this->state = $this->pincode = $this->mobile = $this->whatsapp = '';
                break;
            case 4:
                $this->nominee_name = $this->nominee_relation = '';
                break;
            case 5:
                $this->ifsc = $this->bank_name = $this->branch_name = $this->account_no  = $this->pancard = $this->aadhar_card = '';
                break;
            case 6:
                $this->image = null;
                break;
        }
    }

    public function render()
    {
        return view('livewire.membership.membership');
    }
}
