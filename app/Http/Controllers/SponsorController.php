<?php

namespace App\Http\Controllers;

use App\Models\Sponsor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class SponsorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index()
    {
        $sponsors = Sponsor::all();
        return view('dashboard.sponsor.index', compact('sponsors'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function create()
    {
        return view('dashboard.sponsor.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        try {
            $sponsor = new Sponsor;
            if ($request->hasfile('logo')) {
                $file = $request->file('logo');
                $extension = $file->getClientOriginalExtension();
                $filename = 'sponsor_' . time() . '.' . $extension;
                $file->move('storage/images/sponsors/', $filename);
                $sponsor->logo = $filename;
            }
            $sponsor->save();
            return redirect()->route('sponsor.index')->with('success', 'Sponsor Added successfully');
        } catch (\Exception $exception) {
            return redirect()->route('sponsor.index')->with('danger', 'Error While Sponsor Adding');
            // return dd($exception);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Models\Sponsor $sponsor
     * @return \Illuminate\Http\Response
     */
    public function show(Sponsor $sponsor)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Models\Sponsor $sponsor
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function edit($id)
    {
        $sponsor = Sponsor::find($id);
        return view('dashboard.sponsor.edit', compact('sponsor'));
    }
    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Sponsor $sponsor
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, $id)
    {
        try {
            $sponsor = Sponsor::find($id);
            if ($request->hasfile('logo')) {
                $destination = 'storage/images/sponsors/' . $sponsor->image;
                if (File::exists($destination)) {
                    File::delete($destination);
                }
                $file = $request->file('logo');
                $extension = $file->getClientOriginalExtension();
                $filename = time() . '.' . $extension;
                $file->move('storage/images/sponsors/', $filename);
                $sponsor->logo = $filename;
            }
            $sponsor->update();
            return redirect()->route('sponsor.index')->with('success', 'Sponsor Updated successfully');
        } catch (\Exception $exception) {
            return redirect()->route('sponsor.index')->with('danger', 'Error While Sponsor Updating');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\Sponsor $sponsor
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($id)
    {
        $sponsor = Sponsor::find($id);
        $destination = 'storage/images/sponsors/' . $sponsor->logo;
        if (File::exists($destination)) {
            File::delete($destination);
        }
        if ($sponsor) {
            $sponsor->delete();
            return redirect()->route('sponsor.index')->with('success', 'Sponsor Deleted successfully');
        } else {
            return redirect()->route('sponsor.index')->with('danger', 'Error while deleting Sponsor');
        }
    }
}
