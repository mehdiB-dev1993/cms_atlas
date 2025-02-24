<tr>
    <td>{{ str_repeat('----', $level) }} {{ $menu->title }}</td>
    <td>
       {{-- <a href="{{ route('menus.edit', $menu->id) }}">ویرایش</a> |
        <form action="{{ route('menus.destroy', $menu->id) }}" method="POST" style="display:inline;">
            @csrf
            @method('DELETE')
            <button type="submit">حذف</button>
        </form>--}}
    </td>
</tr>

@if($menu->childrenRecursive->isNotEmpty())
    @foreach($menu->childrenRecursive as $child)
        @include('admin.menu.menu-row', ['menu' => $child, 'level' => $level + 1])
    @endforeach
@endif
