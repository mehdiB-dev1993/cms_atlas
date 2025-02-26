<option {{ $selected }} value="{{ $menu->id }}">{{ str_repeat('----', $level) }} {{ $menu->title }}</option>

@if($menu->childrenRecursive->isNotEmpty())
    @foreach($menu->childrenRecursive as $child)
        @include('menu.menu-option', ['menu' => $child, 'level' => $level + 1,'selected' => $selected])
    @endforeach
@endif
