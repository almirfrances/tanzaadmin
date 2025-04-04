@php
    // Load all items for the 'homebanner2' section, ordered by position.
    $items = \Modules\Page\Models\SectionData::where('section_key', 'whyus')->get();
@endphp

<div class="homebanner2-section py-5">
    <div class="container">
        @if($items->count())
            @foreach($items as $item)
                <div class="banner-item mb-4">
                    <h2>{{ data_get($item->content, 'title') }}</h2>
                    
                    <p class="fw-bold">{{ data_get($item->content, 'description') }}</p>
                </div>
            @endforeach
        @else
            <p>No banner items available.</p>
        @endif
    </div>
</div>
