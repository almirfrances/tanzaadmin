@php
    // Load all items for the 'homebanner2' section, ordered by position.
    $items = \Modules\Page\Models\SectionData::where('section_key', 'homebanner2')->get();
@endphp

<div class="homebanner2-section py-5">
    <div class="container">
        @if($items->count())
            @foreach($items as $item)
                <div class="banner-item mb-4">
                    <h2>{{ data_get($item->content, 'heading') }}</h2>
                    <h4>{{ data_get($item->content, 'subheading') }}</h4>
                    <p>{{ data_get($item->content, 'guarantee') }}</p>
                    <p class="fw-bold">{{ data_get($item->content, 'customer_name') }}</p>
                </div>
            @endforeach
        @else
            <p>No banner items available.</p>
        @endif
    </div>
</div>
