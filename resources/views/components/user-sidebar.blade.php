<div class="w-1/4 bg-white p-6  h-screen border-r  border-slate-200 flex flex-col items-center">

    <!-- User Avatar -->
    <div class="w-20 h-20 rounded-full bg-blue-100 flex items-center justify-center mb-4">
        <img src="{{ auth()->user()->profile_image ?? '\user-circles-set_78370-4704.avif' }}" alt="User Avatar" class="w-20 h-20 " />
    </div>

    <!-- User Info -->
    <p class="text-gray-600">Hello!</p>
    <p class="text-lg font-semibold text-gray-800">{{ auth()->user()->name }}</p>

    <!-- Navigation Links -->
    <div class="mt-8 w-full">
        <a href="#" class="block px-4 py-2 text-gray-700 hover:text-sky-600 font-semibold">Personal Info</a>
        <a href="#" class="block px-4 py-2 text-gray-700 hover:text-blue-600">{{ auth()->user()->email }}</a>
        <!-- <a href="#" class="block px-4 py-2 text-gray-700 hover:text-blue-600"></a>
    <a href="#" class="block px-4 py-2 text-white bg-blue-600 rounded-lg">Membership</a> -->

    </div>

</div>