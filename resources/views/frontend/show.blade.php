<x-layouts.main>
    @section('title', $page->name)

    <div class="container my-5">
        <h1>{{ $page->name }}</h1>

        @php
            $addedSections = $page->sections->sortBy('position');
            $blueprint = config('sections');
        @endphp

        @if($addedSections->count())
            @foreach($addedSections as $section)
                @php
                    $sectionKey = $section->section_key;
                    $sectionConfig = $blueprint[$sectionKey] ?? null;
                    $isCrud = $sectionConfig['crud'] ?? false;
                    
                    // Load section data
                    $content = $isCrud 
                        ? \Modules\Page\Models\SectionData::where('section_key', $sectionKey)->get()->pluck('content')
                        : \Modules\Page\Models\SectionData::where('section_key', $sectionKey)->first()->content ?? [];
                @endphp

                @if(view()->exists("page::frontend.sections.{$sectionKey}"))
                    @include("page::frontend.sections.{$sectionKey}", [
                        'content' => $content,
                        'isCrud' => $isCrud
                    ])
                @else
                    <div class="mb-4">
                        <p>Section View Not Found: {{ $sectionKey }}</p>
                        <pre>{{ json_encode($content, JSON_PRETTY_PRINT) }}</pre>
                    </div>
                @endif
            @endforeach
        @else
            {{-- Default sections fallback --}}
            @foreach($blueprint as $key => $config)
                @include("page::frontend.sections.{$key}", ['content' => [], 'isCrud' => $config['crud'] ?? false])
            @endforeach
        @endif
    </div>
</x-layouts.main>