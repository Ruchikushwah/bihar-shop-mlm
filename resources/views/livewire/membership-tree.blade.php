<div class="container text-center">
    <h2 class="text-2xl font-bold mb-4">Binary MLM Tree</h2>

    @if ($rootMember)
        <div class="tree">
            <ul>
                <li>
                    <a href="#">{{ $rootMember->name }} <br> ({{ $rootMember->referal_id }})</a>
                    @if ($rootMember->leftMember || $rootMember->rightMember)
                        <ul>
                            @include('livewire.tree-node', ['member' => $rootMember->leftMember])
                            @include('livewire.tree-node', ['member' => $rootMember->rightMember])
                        </ul>
                    @endif
                </li>
            </ul>
        </div>
    @else
        <p>No members found in the tree.</p>
    @endif
</div>
