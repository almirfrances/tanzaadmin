@php
    // Retrieve the SectionData record for the "about" section.
    // Make sure the SectionData model is autoloaded.
    $sectionData = \Modules\Page\Models\SectionData::where('section_key', 'about')->first();
@endphp

<div class="about-section py-5">
    <div class="container">
        <!-- Section Title -->
        <h2 class="mb-4">{{ data_get($sectionData, 'content.title', 'About Us') }}</h2>
        
        <!-- Section Description -->
        <p class="mb-4">{{ data_get($sectionData, 'content.description', 'This is our default about section description.') }}</p>
        
        <!-- Section Image -->
        @if(data_get($sectionData, 'content.image'))
            <div class="mb-4">
                <img src="{{ asset('storage/' . data_get($sectionData, 'content.image')) }}" alt="{{ data_get($sectionData, 'content.title', 'About Us') }}" class="img-fluid">
            </div>
        @endif
    </div>
</div>
