<li class="<!--list-group-item-->">
    <span>
        @if($cg->childrenRecursive->isNotEmpty())
            <span class="toggle-btn">➕</span>
        @endif
        {{ str_repeat('--', $level) }} {{ $cg->title }}
    </span>

    <span>
        (  <a href="{{ route('course_group.edit', ['id' => $cg->id]) }}"><i onclick="" class="bi bi-pencil-square"></i></a> | <a href="{{ route('course_group.destroy', ['id' => $cg->id]) }}"><i class="bi bi-trash-fill"></i></a> )
    </span>

    @if($cg->childrenRecursive->isNotEmpty())
        <ul class="submenu">
            @foreach($cg->childrenRecursive as $child)
                @include('course_group.coursegroup-tree', ['cg' => $child, 'level' => $level + 1])
            @endforeach
        </ul>
    @endif
</li>
