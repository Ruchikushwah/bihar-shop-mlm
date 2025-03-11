<div>
    <h1 class="text-xl font-bold mb-4">Manage Users</h1>

    <!-- Flash Messages -->
    @if (session()->has('message'))
    <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
        {{ session('message') }}
    </div>
    @endif

    @if (session()->has('error'))
    <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
        {{ session('error') }}
    </div>
    @endif

    <div class="overflow-x-auto border rounded-lg">
        <table class="w-full border-collapse">
            <thead class="bg-gray-200 dark:bg-gray-700">
                <tr>
                    <th class="p-3 text-left">#</th>
                    <th class="p-3 text-left">Name</th>
                    <th class="p-3 text-left">Email</th>
                    <th class="p-3 text-left">Approval Status</th>
                    <th class="p-3 text-left">Referal ID</th>
                    <th class="p-3 text-left">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($users as $index => $user)

                <tr class="hover:bg-gray-100 dark:hover:bg-gray-800">
                    <td class="p-3">{{ $index + 1 }}</td>
                    <td class="p-3">{{ $user->name }}</td>
                    <td class="p-3">{{ $user->email }}</td>
                    <td class="p-3">
                        <!-- Toggle Switch -->
                        <label class="inline-flex items-center cursor-pointer">
                            <input
                                type="checkbox"
                                class="sr-only peer"
                                wire:click="toggleApproval({{ $user->id }})"
                                {{ $user->is_approved ? 'checked' : '' }}>

                            <span class="ms-3 text-sm font-medium text-gray-900 dark:text-gray-300">
                                {{ $user->is_approved ? 'Approved' : 'Not Approved' }}
                            </span>
                        </label>
                    </td>
                    <td class="p-3">
                        {{ $user->membership->referal_id ?? 'N/A' }}
                    </td>

                    <td class="p-3">
                        <button wire:click="viewUser({{$user->id}})" class="px-3 py-1 text-white bg-teal-600 rounded hover:bg-teal-700">
                            view
                        </button>
                        <button
                            wire:click="deleteUser({{ $user->id }})"
                            class="px-3 py-1 text-white bg-red-500 rounded hover:bg-red-600">
                            Delete
                        </button>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="6" class="p-3 text-center">No users found.</td>
                </tr>
                @endforelse
            </tbody>
        </table>

    </div>

    <!-- Pagination Links -->
    <div class="mt-4">
        {{ $users->links() }}
    </div>
</div>