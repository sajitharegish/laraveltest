<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\listingModel;

class UserController extends Controller
{
   
    public function create()
    {
        return view('create');
    }

    public function store(Request $request)
    {
        ListingModel::create([
            'listing' => $request->listing
        ]);
        return redirect()->to('listing')->with('success', 'Data inserted successfully');
    }
    public function listing()
    {
        $data = ListingModel::all(); // fetch all records

        return view('listing', ['data' => $data]);
    }
    public function edit($id)
    {
        $data = ListingModel::findOrFail($id);
        return view('edit', compact('data'));
    }

    public function update(Request $request, $id)
    {
        $data = ListingModel::findOrFail($id);

        $data->update([
            'listing' => $request->listing
        ]);
        return redirect()->to('listing')->with('success', 'Updated successfully');
    }

    // 🔹 Delete data
    public function delete($id)
    {
        ListingModel::findOrFail($id)->delete();
        return redirect('/listing')->with('success', 'Deleted successfully');
    }

    
}
