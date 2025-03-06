@if ($member)
    <li>
        <a href="#">{{ $member->name }} <br> ({{ $member->referal_id }})</a>
        @if ($member->leftMember || $member->rightMember)
            <ul>
                @include('livewire.tree-node', ['member' => $member->leftMember])
                @include('livewire.tree-node', ['member' => $member->rightMember])
            </ul>
        @endif
    </li>
@endif
