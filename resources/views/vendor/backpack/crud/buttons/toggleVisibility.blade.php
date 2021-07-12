    <a href="{{ backpack_url('materialToggleVisibility/'.$entry->getKey()) }}" class="btn btn-sm btn-danger ">
        @if($entry->is_visible)
            <i class="fa fa-times" aria-hidden="true"></i>
            إخفاء
        @else
            <i class="la la-check" aria-hidden="true"></i>
            إظهار
        @endif
    </a>

