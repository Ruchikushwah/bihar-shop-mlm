<div class="p-8 bg-white  shadow rounded-2xl max-w-xl mx-auto">
    <h2 class="text-3xl font-semibold mb-6 text-gray-600">User Details</h2>

    <div class="space-y-4">
        <p class="text-lg"><strong>Name:</strong> {{ $user->name }}</p>
        <p class="text-lg"><strong>Email:</strong> {{ $user->email }}</p>

        <!-- Toggle Button for Approval -->
        <div>
            <p class="text-lg font-semibold">Approval Status:</p>
            <label class="flex items-center mt-2 cursor-pointer">
                <input
                    type="checkbox"
                    class="sr-only"
                    wire:model="user.is_approved"
                    wire:change="toggleApproval">

                <div class="relative w-14 h-8 rounded-full transition {{ $user->is_approved ? 'bg-green-500' : 'bg-gray-300' }}">
                    <div class="absolute top-1 left-1 w-6 h-6 bg-white rounded-full shadow-md transition-transform transform translate: {{ $user->is_approved ? '1.5rem' : '0' }}"></div>
                </div>
                <span class="ml-4 text-lg text-gray-700">{{ $user->is_approved ? 'Approved' : 'Not Approved' }}</span>
            </label>
        </div>

        <p class="text-lg"><strong>Referral ID:</strong> {{ optional($user->membership)->referal_id ?? 'N/A' }}</p>

        @if(session()->has('message'))
            <div class="mt-4 p-3 bg-green-100 text-green-800 rounded-lg">
                {{ session('message') }}
            </div>
        @endif

        <a href="{{ route('admin.manageUser') }}" class="mt-6 inline-block px-4 py-2 bg-gray-700 text-white text-lg font-light rounded-lg hover:bg-gray-800 transition">Back to Users</a>
    </div>
</div>
