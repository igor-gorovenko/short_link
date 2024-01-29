<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Link;
use App\Http\Requests\StoreLinkRequest;
use App\Http\Requests\UpdateLinkRequest;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

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
    public function index()
    {
        $links = (new Link)->newQuery();

        if (request()->has('search')) {
            $links->where('name', 'Like', '%' . request()->input('search') . '%');
        }

        if (request()->query('sort')) {
            $attribute = request()->query('sort');
            $sort_order = 'ASC';
            if (strncmp($attribute, '-', 1) === 0) {
                $sort_order = 'DESC';
                $attribute = substr($attribute, 1);
            }
            $links->orderBy($attribute, $sort_order);
        } else {
            $links->latest();
        }

        $links = $links->paginate(5)->onEachSide(2)->appends(request()->query());

        return Inertia::render('Admin/Link/Index', [
            'links' => $links,
            'filters' => request()->all('search'),
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
    public function store(StoreLinkRequest $request)
    {
        Link::create($request->all());

        return redirect()->route('admin.link.index')
            ->with('message', __('Link created successfully.'));
    }

    /**
     * Display the specified resource.
     *
     * @return \Inertia\Response
     */
    public function show($id)
    {
        $link = Link::findOrFail($id);

        return Inertia::render('Admin/Link/Show', [
            'link' => $link,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @return \Inertia\Response
     */
    public function edit(Link $link)
    {
        return Inertia::render('Admin/Link/Edit', [
            'link' => $link
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(UpdateLinkRequest $request, Link $link)
    {
        $link->update($request->all());

        return redirect()->route('admin.link.index')
            ->with('message', __('Link updated successfully.'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Link $link)
    {
        $link->delete();

        return redirect()->route('admin.link.index')
            ->with('message', __('Link deleted successfully.'));
    }
}
