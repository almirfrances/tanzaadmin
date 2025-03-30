@props(['items' => [], 'style' => 'style2'])

<nav aria-label="breadcrumb">
    <ol class="breadcrumb
        @if($style === 'style1')
            breadcrumb-style1
        @elseif($style === 'style2')
            breadcrumb-style2
        @else
            {{-- Default to no extra styling if style is unknown --}}
        @endif
    ">
        @foreach($items as $index => $item)
            @if(!empty($item['url']))
                <li class="breadcrumb-item">
                    <a href="{{ $item['url'] }}">{{ $item['name'] }}</a>
                </li>
            @else
                <li class="breadcrumb-item active" aria-current="page">
                    {{ $item['name'] }}
                </li>
            @endif
        @endforeach
    </ol>
</nav>
