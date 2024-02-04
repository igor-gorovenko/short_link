<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\LinkIndexRequest;
use App\Http\Requests\LinkStatisticsRequest;
use App\Http\Requests\LinkStoreRequest;
use App\Http\Requests\LinkUpdateRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Inertia\Inertia;
use AshAllenDesign\ShortURL\Classes\Builder as ShortUrlBuilder;
use AshAllenDesign\ShortURL\Models\ShortURL;
use AshAllenDesign\ShortURL\Models\ShortURLVisit;

class ShortLinkController extends Controller
{
    public function __construct()
    {
        $this->middleware('can:link list', ['only' => ['index', 'show']]);
        $this->middleware('can:link create', ['only' => ['create', 'store']]);
        $this->middleware('can:link edit', ['only' => ['edit', 'update']]);
        $this->middleware('can:link delete', ['only' => ['destroy']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Inertia\Response
     */
    public function index(LinkIndexRequest $request)
    {
        // Validated Data
        $validatedData = $request->validated();

        $links = ShortURL::query();

        // Search
        if ($request->has('search')) {
            $links->where('default_short_url', 'like', '%' . $validatedData['search'] . '%');
        }

        // Sort
        if ($request->query('sort')) {
            $attribute = $validatedData['sort'];
            $sort_order = $attribute[0] === '-' ? 'DESC' : 'ASC';
            $attribute = ltrim($attribute, '-');
            $links->orderBy($attribute, $sort_order);
        } else {
            $links->latest();
        }

        // Pagination
        $links = $links->paginate(5)->onEachSide(2)->appends($validatedData);

        // Render
        return Inertia::render('Admin/Link/Index', [
            'links' => $links,
            'filters' => $validatedData,
            'can' => [
                'create' => Auth::user()->can('link create'),
                'edit' => Auth::user()->can('link edit'),
                'delete' => Auth::user()->can('link delete'),
            ]
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Inertia\Response
     */
    public function create()
    {
        return Inertia::render('Admin/Link/Create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(LinkStoreRequest $request)
    {
        $destination_url = $request->destination_url;
        $url_key = $request->url_key;
        $http_check = 'http';
        $http_url = 'https://';

        $builder = new ShortUrlBuilder();

        if (!str_starts_with($destination_url, $http_check)) {
            $destination_url = $http_url . $destination_url;
        }

        // Generate url_key if empty
        if (empty($url_key)) {
            $url_key = Str::random(8);
        }

        // Create short link
        $builder->destinationUrl($destination_url)->urlKey($url_key)->make();

        return redirect()->route('admin.shortlink.index')
            ->with('message', __('Link created successfully.'));
    }

    /**
     * Display the specified resource.
     *
     * @return \Inertia\Response
     */
    public function show($id)
    {
        $link = ShortURL::findOrFail($id);

        return Inertia::render('Admin/Link/Show', [
            'link' => $link,
        ]);
    }

    public function statistics(LinkStatisticsRequest $request, $id)
    {
        // Validated Data
        $validatedData = $request->validated();

        $link = ShortURL::findOrFail($id);
        $visits = ShortURLVisit::query();

        $visits->where('short_url_id', $id);

        // Sort
        if ($request->query('sort')) {
            $attribute = $validatedData['sort'];
            $sort_order = $attribute[0] === '-' ? 'DESC' : 'ASC';
            $attribute = ltrim($attribute, '-');
            $visits->orderBy($attribute, $sort_order);
        } else {
            $visits->latest();
        }

        // Pagination
        $visits = $visits->paginate(5)->onEachSide(2)->appends($validatedData);

        // Render
        return Inertia::render('Admin/Link/Statistics', [
            'link' => $link,
            'visits' => $visits,
            'filters' => $validatedData,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @return \Inertia\Response
     */
    public function edit($id)
    {
        $link = ShortURL::findOrFail($id);

        return Inertia::render('Admin/Link/Edit', [
            'link' => $link
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(LinkUpdateRequest $request, $id)
    {
        $validatedData = $request->validated();

        $link = ShortURL::findOrFail($id);
        $link->update($validatedData);

        return redirect()->route('admin.shortlink.index')
            ->with('message', __('Link updated successfully.'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($id)
    {
        $link = ShortURL::findOrFail($id);
        $link->delete();

        return redirect()->route('admin.shortlink.index')
            ->with('message', __('Link deleted successfully.'));
    }
}
