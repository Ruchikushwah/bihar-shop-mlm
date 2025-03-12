<div class=" w-full min-h-screen bg-gray-100 flex items-center justify-center py-5" wire:poll.15s>
    <div class="w-3/4">
        @if (session()->has('success'))
        <div class="p-4 mb-4 text-green-700 bg-green-100 rounded-lg">
            {{ session('success') }}
        </div>
        @endif
        @if(session()->has('error'))
        <div class="text-red-500 text-sm">{{ session('error') }}</div>
        @endif
        

        <div class="mb-4">
            <button wire:click="openSection(1)" class="w-full text-left p-4 mb-2 bg-[#3282b8d2] text-white rounded">
                1. Basic Info
                @if(in_array(1, $completedSections)) <span class="float-right">✔️</span> @endif
            </button>
            @if($activeSection === 1)
            <div class="p-4 bg-white rounded">
                <h2 class="text-xl font-bold mb-4">Basic Info</h2>
                <label class="block mb-2">Referral ID:</label>
                <input
                    type="text" wire:model.live="referal_id"
                    class="border rounded w-full p-2 mb-4"
                    placeholder="Enter your referral ID">
                @error('referal_id')
                <div class="text-red-500 text-sm">{{ $message }}</div>
                @enderror

                <label class="block mb-2">Name:</label>
                <input
                    type="name"
                    wire:model="name"
                    class="border rounded w-full p-2 mb-4" readonly>

                <button wire:click="save" class="bg-[#3282B8] text-white px-4 py-2 rounded">Next</button>
            </div>
            @endif

        </div>

        <div class="mb-4">
            <button wire:click="openSection(2)" class="w-full text-left p-4 mb-2 rounded {{ in_array(2, $completedSections) ? 'bg-green-100' : 'bg-gray-100' }}">
                2. Applicant Info
                @if(in_array(2, $completedSections)) <span class="float-right">✔️</span> @endif
            </button>
            @if($activeSection === 2)
            <div class="p-4 bg-gray-50 rounded">
                <h2 class="text-xl font-bold mb-4">Applicant Info</h2>

                <div class="flex gap-5">
                    <div class="w-1/2">
                        <label class="block mb-2">Name:</label>
                        <input type="text" wire:model="name" value="{{ auth()->user()->name }}" class="border rounded w-full p-2 mb-4">

                    </div>
                    <div class="w-1/2">
                        <label class="block mb-2">DOB:</label>
                        <input type="date" wire:model.blur="date_of_birth" class="border rounded w-full p-2 mb-4" max="<?php echo date('Y-m-d'); ?>">
                        @error('date_of_birth')
                        <div class="text-red-500 text-sm">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="flex gap-5">
                    <div class="w-1/2">
                        <label for="nationality" class="block mb-2">Nationality</label>
                        <select wire:model.blur="nationality" class="border rounded w-full p-2 mb-4">
                            <option value="" disabled selected>Select your nationality</option>
                            <option value="USA">USA</option>
                            <option value="Canada">Canada</option>
                            <option value="India">India</option>
                            <option value="Australia">Australia</option>
                            <option value="UK">UK</option>
                        </select>
                        @error('nationality')
                        <div class="text-red-500 text-sm">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="w-1/2 mb-2">
                        <label for="marital_status" class="block mb-2">Marital Status</label>
                        <select wire:model.blur="marital_status" class="border rounded w-full p-2 mb-4">
                            <option value="" disabled selected>Select your marital status</option>
                            <option value="single">Single</option>
                            <option value="married">Married</option>
                            <option value="divorced">Unmarried</option>
                        </select>
                    </div>
                </div>
                <label class="block mb-2">Religion:</label>
                <select wire:model.blur="religion" class="border rounded w-full p-2 mb-4">
                    <option value="" disabled selected>Select your religion</option>
                    <option value="Christian">Christian</option>
                    <option value="Islam">Islam</option>
                    <option value="Hindu">Hindu</option>

                </select>

                <!-- Next Button -->
                <button wire:click="updateMembership" class="bg-[#3282B8] text-white px-4 py-2 rounded">Next</button>
            </div>
            @endif
        </div>

        <div class="mb-4">
            <button wire:click="openSection(3)" class="w-full text-left p-4 mb-2 rounded {{ in_array(3, $completedSections) ? 'bg-green-100' : 'bg-gray-100' }}">
                3. Personal Info
                @if(in_array(3, $completedSections)) <span class="float-right">✔️</span> @endif
            </button>
            @if($activeSection === 3)

            <div class="p-4 bg-gray-50 rounded">
                <h2 class="text-xl font-bold mb-4">Personal Info</h2>
                <div class="flex gap-4 mb-4">
                    <div class="w-1/2">
                        <label class="block mb-2">Father Name:</label>
                        <input type="text" wire:model.blur="father_name" class="border rounded w-full p-2 mb-4" placeholder="Enter your Father Name">
                    </div>
                    <div class="w-1/2">
                        <label class="block mb-2">Mother Name:</label>
                        <input type="text" wire:model="mother_name" class="border rounded w-full p-2 mb-4" placeholder="Enter your Mother Name">
                    </div>
                </div>
                <div class="mb-4">
                    <label class="block mb-2">Gender:</label>
                    <select wire:model="gender" class="border rounded w-full p-2 mb-4">
                        <option value="" disabled selected>Select Gender</option>
                        <option value="male">Male</option>
                        <option value="female">Female</option>
                        <option value="other">Other</option>
                    </select>
                    @error('gender')
                    <div class="text-red-500 text-sm">{{ $message }}</div>
                    @enderror
                </div>
                <div class="flex gap-4 mb-4">
                    <div class="w-1/2">
                        <label class="block mb-2">Home Address:</label>
                        <input type="text" wire:model.blur="home_address" class="border rounded w-full p-2 mb-4" placeholder="Enter your Home Address">
                        @error('home_address')
                        <div class="text-red-500 text-sm">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="w-1/2">
                        <label class="block mb-2">City:</label>
                        <input type="text" wire:model.blur="city" class="border rounded w-full p-2 mb-4" placeholder="Enter your City">
                        @error('city')
                        <div class="text-red-500 text-sm">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <!-- State and Pincode in Two Columns -->
                <div class="flex gap-4 mb-4">
                    <div class="w-1/2">
                        <label class="block mb-2">State:</label>
                        <input type="text" wire:model.blur="state" class="border rounded w-full p-2 mb-4" placeholder="Enter your State">
                    </div>
                    <div class="w-1/2">
                        <label class="block mb-2">Pincode:</label>
                        <input type="text" wire:model="pincode" class="border rounded w-full p-2 mb-4" placeholder="Enter your Pincode">
                    </div>
                </div>

                <!-- Mobile and Whatsapp in Two Columns -->
                <div class="flex gap-4 mb-4">
                    <div class="w-1/2">
                        <label class="block mb-2">Mobile:</label>
                        <input type="text" wire:model="mobile" class="border rounded w-full p-2 mb-4" placeholder="Enter your Mobile" pattern="^[0-9]{10}$"
                            inputmode="numeric"
                            maxlength="10"
                            pattern="^[6789][0-9]{9}$">
                        @error('mobile')
                        <div class="text-red-500 text-sm">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="w-1/2">
                        <label class="block mb-2">Whatsapp:</label>
                        <input type="text" wire:model="whatsapp" class="border rounded w-full p-2 mb-4" placeholder="Enter your Whatsapp" pattern="^[0-9]{10}$"
                            inputmode="numeric"
                            maxlength="10"
                            pattern="^[6789][0-9]{9}$">
                        @error('whatsapp')
                        <div class="text-red-500 text-sm">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <!-- Next Button -->
                <button wire:click="updateMembership" class="bg-[#3282B8] text-white px-4 py-2 rounded">Next</button>
            </div>

            @endif
        </div>

        <div class="mb-4">
            <button wire:click="openSection(4)" class="w-full text-left p-4 mb-2 rounded {{ in_array(4, $completedSections) ? 'bg-green-100' : 'bg-gray-100' }}">
                4. Nominee Info
                @if(in_array(4, $completedSections)) <span class="float-right">✔️</span> @endif
            </button>
            @if($activeSection === 4)

            <div class="p-4 bg-gray-50 rounded">
                <h2 class="text-xl font-bold mb-4">Nominee Info</h2>
                <label class="block mb-2">Nominee Name:</label>
                <input type="text" wire:model="nominee_name" class="border rounded w-full p-2 mb-4" placeholder="Enter nominee name">

                <label class="block mb-2">Nominee Relation:</label>
                <select wire:model="nominee_relation" class="border rounded w-full p-2 mb-4">
                    <option value="">Select Relationship</option>
                    <option value="Father">Father</option>
                    <option value="Mother">Mother</option>
                    <option value="Spouse">Spouse</option>
                    <option value="Sibling">Sister</option>
                    <option value="Child">Child</option>
                    <option value="Friend">Friend</option>
                    <option value="Other">Other</option>
                </select>

                @error('nominee_relation')
                <span class="text-red-500">{{ $message }}</span>
                @enderror

                <button wire:click="updateMembership" class="bg-[#3282B8] text-white px-4 py-2 rounded">Next</button>
            </div>

            @endif
        </div>
        <div class="mb-4">
            <button wire:click="openSection(5)" class="w-full text-left p-4 mb-2 rounded {{ in_array(5, $completedSections) ? 'bg-green-100' : 'bg-gray-100' }}">
                5. Bank Info
                @if(in_array(5, $completedSections)) <span class="float-right">✔️</span> @endif
            </button>
            @if($activeSection === 5)
            <div class="p-4 bg-gray-50 rounded">
                <h2 class="text-xl font-bold mb-4">Bank Info</h2>
                <label class="block mb-2">IFSC Code:</label>
                <input type="text" wire:model.blur="ifsc" class="border rounded w-full p-2 mb-4" placeholder="Enter bank ifsc">
                <label class="block mb-2">Bank Name:</label>
                <input type="text" wire:model="bank_name" class="border rounded w-full p-2 mb-4" placeholder="Enter bank name" readonly>
                <label class="block mb-2">Branch Name:</label>
                <input type="text" wire:model="branch_name" class="border rounded w-full p-2 mb-4" placeholder="Enter branch name" readonly>
                <label class="block mb-2">Account No:</label>

                <input type="text" wire:model="account_no" class="border rounded w-full p-2 mb-4" placeholder="Enter account no">
                @error('account_no')
                <div class="text-red-500 text-sm">{{ $message }}</div>
                @enderror
                <label class="block mb-2"> PAN Card No:</label>
                <input type="text" wire:model="pancard" class="border rounded w-full p-2 mb-4" placeholder="Enter pancard">
                @error('pancard')
                <div class="text-red-500 text-sm">{{ $message }}</div>
                @enderror
                <label class="block mb-2"> Adhar Card No:</label>
                <input type="text" wire:model="aadhar_card" class="border rounded w-full p-2 mb-4" placeholder="Enter Aadhar Card">
                @error('aadhar_card')
                <div class="text-red-500 text-sm">{{ $message }}</div>
                @enderror
                <button wire:click="updateMembership" class="bg-[#3282B8] text-white px-4 py-2 rounded">Next</button>
            </div>
            @endif
        </div>

        <!-- Step 6: Upload Passport -->
        <div class="mb-4">
            <button wire:click="openSection(6)" class="w-full text-left p-4 mb-2 rounded {{ in_array(6, $completedSections) ? 'bg-green-100' : 'bg-gray-100' }}">
                6. Upload Passport Image
                @if(in_array(6, $completedSections)) <span class="float-right">✔️</span> @endif
            </button>
            @if($activeSection === 6)
            <div class="p-4 bg-gray-50 rounded">
                <h2 class="text-xl font-bold mb-4">Upload Passport</h2>
                <label class="block mb-2">Passport Image:</label>
                <input type="file" wire:model="image" class="border rounded w-full p-2 mb-4">
                @error('image') <p class="text-red-500">{{ $message }}</p> @enderror

                <!-- Image Preview -->
                @if($image)
                <img src="{{ $image->temporaryUrl() }}" alt="Image Preview" class="mt-4 w-40 h-40 object-cover rounded">
                @endif

                <button wire:click="showConfirmationModal" class="bg-teal-600 text-white px-4 py-2 rounded">Confirm</button>
            </div>
            @endif
        </div>
        @if($showConfirmation == true )
        <div class="fixed inset-0 bg-gray-800 bg-opacity-50 flex justify-center items-center z-50">
            <div class="bg-white p-6 rounded-lg shadow-lg w-3/4 md:w-1/2">
                <span class="absolute top-2 right-2 text-xl cursor-pointer" wire:click="$set('showConfirmationModal', false)">&times;</span>
                <h2 class="text-2xl font-bold mb-4">Confirm Submission</h2>
                <p class="mb-4">Please review your details before final submission:</p>
                <ul class="space-y-2">
                    <li><strong>Name:</strong> {{ $name }}</li>
                    <li><strong>Date of Birth:</strong> {{ $date_of_birth }}</li>
                    <li><strong>Nationality:</strong> {{ $nationality }}</li>
                    <li><strong>Marital Status:</strong> {{ $marital_status }}</li>
                    <li><strong>Religion:</strong> {{ $religion }}</li>
                    <li><strong>Father's Name:</strong> {{ $father_name }}</li>
                    <li><strong>Mother's Name:</strong> {{ $mother_name }}</li>
                    <li><strong>Gender:</strong> {{ $gender }}</li>
                    <li><strong>Home Address:</strong> {{ $home_address }}</li>
                    <li><strong>City:</strong> {{ $city }}</li>
                    <li><strong>State:</strong> {{ $state }}</li>
                    <li><strong>Pincode:</strong> {{ $pincode }}</li>
                    <li><strong>Mobile:</strong> {{ $mobile }}</li>
                    <li><strong>WhatsApp:</strong> {{ $whatsapp }}</li>
                    <li><strong>Nominee Name:</strong> {{ $nominee_name }}</li>
                    <li><strong>Nominee Relation:</strong> {{ $nominee_relation }}</li>
                    <li><strong>IFSC:</strong> {{ $ifsc }}</li>
                    <li><strong>Bank Name:</strong> {{ $bank_name }}</li>
                    <li><strong>Branch Name:</strong> {{ $branch_name }}</li>
                    <li><strong>Account Number:</strong> {{ $account_no }}</li>
                    <li><strong>PAN Card:</strong> {{ $pancard }}</li>
                    <li><strong>Aadhar Card:</strong> {{ $aadhar_card }}</li>
                    <li><strong>Profile Image:</strong> <img src="{{ $image->temporaryUrl() }}" alt="Profile Image" class="w-24 h-24 object-cover rounded"></li>
                </ul>
                <div class="mt-4 flex justify-end gap-4">
                    <button wire:click="finalSubmit" class="bg-green-500 text-white px-6 py-2 rounded">Confirm and Submit</button>
                    <button wire:click="$set('showConfirmationModal', false)" class="bg-gray-500 text-white px-6 py-2 rounded">Cancel</button>
                </div>
            </div>
        </div>
        @endif
        <!-- Success Message -->
        @if(session()->has('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
        @endif
    </div>
</div>