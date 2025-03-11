<div class="w-full min-h-screen flex bg-gray-100">

    <!-- Sidebar for User Information -->
   

    <!-- Main Content Area -->
    <div class=" flex  justify-between flex-1 p-8">
        <div>
        <h2 class="text-3xl font-semibold text-gray-800">Welcome, {{ auth()->user()->name }}</h2>
        <p class="mt-2 text-gray-600">Manage your account and explore membership benefits.</p>

        </div>
        
        <!-- Button to Become a Membership -->
        <div class="mt-8">
            <a href="{{ route('membership')}}" class="px-6 py-3 bg-[#3282B8] text-white text-lg rounded-lg hover:bg-[#3282B8] transition">Become a Member</a>
        </div>
    </div>

</div>
