<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\RateingRequest;
use App\Models\Rateing;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Yajra\DataTables\Facades\DataTables;

class RateingController extends Controller
{
    public function index()
    {
        return view('admin.rateing.index');
    }

    public function data()
    {
        $rateings = Rateing::orderBy('created_at', 'desc')->get();

        return DataTables::of($rateings)
            ->addColumn('name', function ($rateing) {
                return $rateing->name;
            })
            ->addColumn('review', function ($rateing) {
                return $rateing->review ?? '';
            })
            ->addColumn('rate', function ($rateing) {
                return $rateing->rate;
            })
            ->addColumn('photo', function ($rateing) {
                return $rateing->photo;
            })
            ->make(true);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.rateing.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(RateingRequest $request)
    {
        try {
            $rateing = Rateing::create($request->except('photo'));
            
            if ($request->hasFile('photo')) {
                $rateing->setImageAttribute([$request->file('photo'), 'photo']);
                $rateing->save();
            }

            session()->flash('success', __('admin.Created Successfully'));
            return redirect()->route('rateing.index');
        } catch (\Exception $e) {
            session()->flash('error', __('admin.Error occurred while creating rating'));
            return redirect()->back()->withInput();
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $rateing = Rateing::findOrFail($id);
        return view('admin.rateing.edit', compact('rateing'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(RateingRequest $request, $id)
    {
        try {
            $rateing = Rateing::findOrFail($id);
            
            $rateing->update($request->except('photo'));
            
            if ($request->hasFile('photo')) {
                // Delete old photo if exists
                if ($rateing->photo) {
                    Storage::disk('rateing')->delete($rateing->photo);
                }
                
                $rateing->setImageAttribute([$request->file('photo'), 'photo']);
                $rateing->save();
            }

            session()->flash('success', __('admin.Updated Successfully'));
            return redirect()->route('rateing.index');
        } catch (\Exception $e) {
            session()->flash('error', __('admin.Error occurred while updating rating'));
            return redirect()->back()->withInput();
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        try {
            $ex = explode(',', $request->id);

            foreach ($ex as $value) {
                $rateing = Rateing::findOrFail($value);
                
                if ($rateing->photo) {
                    Storage::disk('rateing')->delete($rateing->photo);
                }
                
                $rateing->delete();
            }

            session()->flash('success', __('admin.Deleted Successfully'));
            return redirect()->route('rateing.index');
        } catch (\Exception $e) {
            session()->flash('error', __('admin.Error occurred while deleting rating'));
            return redirect()->back();
        }
    }
}
