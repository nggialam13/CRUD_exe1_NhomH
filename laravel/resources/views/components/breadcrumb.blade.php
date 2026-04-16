<nav aria-label="breadcrumb">
    <ol class="breadcrumb breadcrumb-custom">
        <li class="breadcrumb-item">
            <a href="{{ route('users.index') }}">
                <i class="fas fa-home"></i> Home
            </a>
        </li>
        @if(isset($breadcrumbs))
            @foreach($breadcrumbs as $breadcrumb)
                @if($loop->last)
                    <li class="breadcrumb-item active" aria-current="page">
                        {{ $breadcrumb }}
                    </li>
                @else
                    <li class="breadcrumb-item">
                        <a href="{{ $breadcrumb }}">{{ $breadcrumb }}</a>
                    </li>
                @endif
            @endforeach
        @endif
    </ol>
</nav>
