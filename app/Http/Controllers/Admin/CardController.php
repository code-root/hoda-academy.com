<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\CardRequest;
use App\Models\Card;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Yajra\DataTables\Facades\DataTables;

class CardController extends Controller
{
    public function index()
    {


        return view('admin.card.index');
    }


    public function data()
    {
        $card = Card::orderBy('created_at', 'desc')->get() ;

        return DataTables::of($card)

            ->make(true);
    }
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.card.create');

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CardRequest $request)
    {


        if (Card::all()->count() >= 6) {
            // إذا كان العدد 3 أو أكثر، أرسل رسالة خطأ
            session()->flash('error', __('admin.You cannot add more than 4 items!'));
            return redirect()->route('card.index');
        }
        $card = Card::create($request->all());
        if ($request->hasFile('photo')) {

            $card->setImageAttribute([$request->file('photo')]);
            $card->save();
        }




        session()->flash('success', __('admin.Created Successfully'));
        return redirect()->route('card.index');



    }


    public function edit( $id)
    {

        $card = Card::findOrFail($id);
        return view('admin.card.edit',get_defined_vars());

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(CardRequest  $request,$id)
    {
        $card = Card::findOrFail($id);

        $card->update($request->except('photo'));
        if ($request->hasFile('photo')) {
            $card = Card::findOrFail($id);

            if ($card->photo) {
                Storage::disk('card')->delete($card->photo);
            }
            $card->setImageAttribute([$request->file('photo')]);
            $card->save();
        }


        session()->flash('success',  __('admin.Updated Successfully'));
        return redirect()->route('card.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        $ex = explode(',', $request->id);



foreach ($ex as $key => $value) {
    $card = Card::findOrFail($value);
    if ($card->photo) {
        Storage::disk('card')->delete($card->photo);
    }
    $card->delete();
}



session()->flash('success', __('admin.Deleted Successfully'));

        return redirect()->route('card.index');
    }
}
