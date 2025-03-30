<?php

namespace Modules\Page\Http\Controllers;

use Illuminate\Http\Request;
use Modules\Page\Models\Page;
use App\Http\Controllers\Controller;
use Modules\Page\Models\PageSection;
use Modules\Page\Models\SectionData;

class PageController extends Controller
{
          /**
     * Display a listing of pages for the admin.
     */
    public function index(Request $request)
    {
        $search = $request->get('search');
        $pages = Page::query()
            ->when($search, function ($query, $search) {
                $query->where('name', 'like', "%{$search}%")
                      ->orWhere('slug', 'like', "%{$search}%");
            })
            ->orderBy('created_at', 'asc')
            ->paginate(10);

        return view('page::admin.pages.index', compact('pages'));
    }

    /**
     * Store a newly created page.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            // Ensure the slug is unique in the pages table.
            'slug' => 'required|string|max:255|unique:pages,slug',
        ]);

        Page::create($validated);

        sweetalert()->success('Page created successfully!');
        return redirect()->route('admin.pages.index');
    }

    /**
     * Remove the specified page from storage.
     */
    public function destroy($id)
    {
        $page = Page::findOrFail($id);

        // Prevent deletion if the page is marked as the homepage.
        if ($page->is_closed) {
            sweetalert()->error('The homepage cannot be deleted!');
            return redirect()->route('admin.pages.index');
        }

        $page->delete();
        sweetalert()->success('Page deleted successfully!');
        return redirect()->route('admin.pages.index');
    }




        /**
     * Display a list of all sections loaded from the JSON configuration.
     */
    public function sectionsIndex(Request $request)
    {
        // Adjust the path as needed; here we assume the file is in the config directory.
        $sectionsPath = config_path('sections.json');
        if (!file_exists($sectionsPath)) {
            abort(500, 'Sections configuration file not found.');
        }

        $sections = json_decode(file_get_contents($sectionsPath), true);
        if (!$sections) {
            abort(500, 'Invalid sections configuration.');
        }

        return view('page::admin.sections.index', compact('sections'));
    }



        /**
     * Show the edit page for a given section.
     *
     * If the section is CRUD (crud: true), then load a view that lists its items with create/edit modals.
     * Otherwise, load a simple form to update the section’s data.
     */
    public function editSection($sectionKey)
    {
        $sectionsPath = config_path('sections.json'); // or your module path if different
        if (!file_exists($sectionsPath)) {
            abort(500, 'Sections configuration file not found.');
        }
    
        $sections = json_decode(file_get_contents($sectionsPath), true);
        if (!isset($sections[$sectionKey])) {
            abort(404, 'Section not found.');
        }
    
        $section = $sections[$sectionKey];
    
        if (isset($section['crud']) && $section['crud'] === true) {
            // Load items for this CRUD section from the database (using SectionData model)
            $items = SectionData::where('section_key', $sectionKey)->get();
    
            return view('page::admin.sections.crud', compact('section', 'sectionKey', 'items'));
        } else {
            // For a non-CRUD (static) section, load its current setting from the SectionData model.
            $data = SectionData::where('section_key', $sectionKey)->first();
            return view('page::admin.sections.edit', compact('section', 'sectionKey', 'data'));
        }
    }
    


        /**
     * Update non-CRUD section settings.
     *
     * This method updates the settings for a non-CRUD section.
     */
    public function updateSection(Request $request, $sectionKey)
    {
        // Collect all inputs except token and method.
        $data = $request->except(['_token', '_method']);

        // Update or create the section setting record.
        SectionData::updateOrCreate(
            ['section_key' => $sectionKey],
            ['content' => json_encode($data)]
        );

        sweetalert()->success('Section updated successfully!');
        return redirect()->route('admin.sections.edit', $sectionKey);
    }

    /**
     * Store a new item for a CRUD section.
     *
     * This method creates a new item for a section that supports CRUD operations.
     */
    public function storeSectionItem(Request $request, $sectionKey)
    {
        // You might add field-specific validation here based on your JSON config.
        $data = $request->except(['_token']);

        // Create a new section item.
        SectionData::create([
            'section_key' => $sectionKey,
            'content'     => json_encode($data),
        ]);

        sweetalert()->success('Item created successfully!');
        return redirect()->route('admin.sections.edit', $sectionKey);
    }

    /**
     * Update an existing CRUD section item.
     */
    public function updateSectionItem(Request $request, $sectionKey, $itemId)
    {
        $item = SectionData::findOrFail($itemId);
        $data = $request->except(['_token', '_method']);

        $item->update([
            'content' => json_encode($data),
        ]);

        sweetalert()->success('Item updated successfully!');
        return redirect()->route('admin.sections.edit', $sectionKey);
    }

    /**
     * Delete a CRUD section item.
     */
    public function destroySectionItem($sectionKey, $itemId)
    {
        $item = SectionData::findOrFail($itemId);
        $item->delete();

        sweetalert()->success('Item deleted successfully!');
        return redirect()->route('admin.sections.edit', $sectionKey);
    }

    public function manageSections($pageId)
    {
        // Load the page along with its assigned sections, ordered by the position field.
        $page = Page::with(['sections' => function($query) {
            $query->orderBy('position');
        }])->findOrFail($pageId);
    
        return view('page::admin.pages.manage_sections', compact('page'));
    }
    
    public function updateSections(Request $request, $pageId)
    {
        // Validate that the input "sections" is an array (it may be empty).
        $request->validate([
            'sections' => 'nullable|array',
        ]);
    
        // Find the page.
        $page = Page::findOrFail($pageId);
    
        // Delete all current section assignments for this page.
        $page->sections()->delete();
    
        // Re-create the PageSection records in the order provided.
        if ($request->has('sections')) {
            foreach ($request->sections as $position => $sectionKey) {
               PageSection::create([
                    'page_id'     => $page->id,
                    'section_key' => $sectionKey,
                    'position'    => $position + 1,
                ]);
            }
        }
    
        return redirect()->back()->with('success', 'Page sections updated successfully.');
    }
    


}
