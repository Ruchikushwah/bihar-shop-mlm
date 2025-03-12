@if ($member)
<li class="relative">
    <div class="flex flex-col items-center">
        <a href="#" class="block rounded-lg border border-gray-300 px-6 py-3 shadow-md hover:bg-gray-100">
            {{ $member->name ?? 'Empty' }} <br> ({{ $member->referal_id }})
        </a>
    </div>

    @if ($member->leftMember || $member->rightMember)
    <ul class="flex justify-center mt-8 space-x-12">
        @include('livewire.tree-node', ['member' => $member->leftMember])
        @include('livewire.tree-node', ['member' => $member->rightMember])
    </ul>
    @endif

    {{-- Line connecting to children --}}
    @if ($member->leftMember || $member->rightMember)
    <div class="absolute left-1/2 top-0 h-8 w-px bg-gray-400"></div>
    @endif
</li>
@endif