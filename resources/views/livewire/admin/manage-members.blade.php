<div>
    <h1 class="text-2xl font-semibold text-gray-800 mb-6">Manage Memberships</h1>
    <!-- Table Container -->
    <div class="overflow-x-auto bg-white rounded-lg shadow-lg">
        <!-- Table Header -->
        <table class="w-full table-auto border-collapse text-sm">
            <thead class="bg-gray-100 text-gray-700">
                <tr>
                    <th class="p-4 text-left font-medium">#</th>
                    <th class="p-4 text-left font-medium">Referral ID</th>
                    <th class="p-4 text-left font-medium">Name</th>
                    <th class="p-4 text-left font-medium">Email</th>
                    <th class="p-4 text-left font-medium">Joined Date</th>
                    <th class="p-4 text-left font-medium">Actions</th>
                </tr>
            </thead>      
            <tbody>
                @forelse($members as $index => $member)
                <tr class="hover:bg-gray-100 transition-colors duration-200">
                    <td class="p-4">{{ ($members->currentPage() - 1) * $members->perPage() + $index + 1 }}</td>
                    <td class="p-4">{{ $member->referal_id }}</td>
                    <td class="p-4">{{ $member->name }}</td>
                    <td class="p-4">{{ $member->email }}</td>
                    <td class="p-4">{{ $member->created_at->format('d M Y') }}</td>
                    <td class="p-4 space-x-2">
                        <!-- View Button -->
                        <button class="px-4 py-2 bg-sky-600 text-white rounded-lg hover:bg-sky-700 transition duration-150 ease-in-out">
                            View
                        </button>
                        <!-- Delete Button -->
                        <button wire:click="deleteMember({{ $member->id }})"
                            class="px-4 py-2 bg-red-600 text-white rounded-lg hover:bg-red-700 transition duration-150 ease-in-out">
                            Delete
                        </button>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="6" class="p-4 text-center text-gray-500">No members found.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="mt-6">
        {{ $members->links() }}
    </div>
</div>