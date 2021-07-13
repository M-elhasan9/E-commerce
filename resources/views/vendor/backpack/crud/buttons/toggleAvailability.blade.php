<a href="{{ backpack_url('materialToggleAvailability/'.$entry->getKey()) }}" class="btn btn-sm btn-primary ">
    @if($entry->is_available)
        <i class="fa fa-times" aria-hidden="true"></i>
        منع
    @else
        <i class="la la-check" aria-hidden="true"></i>
        إتاحة
    @endif
</a>
