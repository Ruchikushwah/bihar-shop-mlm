<div class="w-full min-h-screen bg-gray-50 flex flex-col">
    <!-- Top Section -->
    <div class="flex justify-between items-center bg-white p-8">
        <div>
            <h2 class="text-3xl font-semibold text-gray-800">Welcome, {{ auth()->user()->name }}</h2>
            <p class="mt-2 text-gray-600">Manage your account and explore membership benefits.</p>
        </div>
        <div>
            <a href="{{ route('membership') }}" class="px-6 py-3 bg-[#3282B8] text-white text-lg rounded-lg hover:bg-[#2f6f8f] transition ease-in-out duration-200">
                Become a Member
            </a>
        </div>
    </div>
    <!-- Memberships Section -->
    <div class="container mx-auto text-center py-8">
        <h2 class="text-2xl font-bold mb-8">Binary MLM Tree</h2>

        @if ($rootMember)
        <div class="tree flex justify-center">
            <ul class="relative space-y-8">
                <li>
                    <a href="#" class="block rounded-lg border border-gray-300 px-6 py-3 shadow-md hover:bg-gray-100">
                        {{ $rootMember->name }} <br> ({{ $rootMember->referal_id }})
                    </a>
                    @if ($rootMember->leftMember || $rootMember->rightMember)
                    <ul class="flex justify-center mt-8 space-x-12">
                        @include('livewire.tree-node', ['member' => $rootMember->leftMember])
                        @include('livewire.tree-node', ['member' => $rootMember->rightMember])
                    </ul>
                    @endif
                </li>
            </ul>
        </div>
        @else
        <p class="text-gray-600">No members found in the tree.</p>
        @endif
    </div>

</div>