<option {{ $selected }} value="{{ $cg->id }}">{{ str_repeat('----', $level) }} {{ $cg->title }}</option>

@if($cg->childrenRecursive->isNotEmpty())
    @foreach($cg->childrenRecursive as $child)
        @include('admin.course_group.coursegroup-option', ['cg' => $child, 'level' => $level + 1,'selected' => $selected])
    @endforeach
@endif
