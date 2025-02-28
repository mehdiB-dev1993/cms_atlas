<li class="<!--list-group-item-->">
    <span >
        @if($menu->childrenRecursive->isNotEmpty())
            <span class="toggle-btn">➕</span>
        @endif
        {{ str_repeat('--', $level) }} {{ $menu->title }}
    </span>

    <span>
        (  <a href="{{ route('menu.edit',['id' => $menu->id]) }}"><i onclick="" class="bi bi-pencil-square"></i></a> | <a href="{{ route('menu.destroy',['id' => $menu->id]) }}"><i class="bi bi-trash-fill"></i></a> )
    </span>

    @if($menu->childrenRecursive->isNotEmpty())
        <ul class="submenu">
            @foreach($menu->childrenRecursive as $child)
                @include('admin.menu.menu-tree', ['menu' => $child, 'level' => $level + 1])
            @endforeach
        </ul>
    @endif
</li>



