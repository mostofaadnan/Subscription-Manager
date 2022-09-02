<?php

namespace App\Http\Controllers\PaymentType;

use App\Http\Controllers\Controller;
use App\Models\PaymentType\PaymentType;
use Illuminate\Http\Request;

class PaymentTypeController extends Controller
{
    
    //__Fucntion for Payment Type__//
    public function index()
    {
        $paytype = PaymentType::orderBy('id', 'DESC')->get();

        return view('admin.pages.pay-type.index', compact('paytype'));
    }

    //__Function for create Payment Type__//
    public function create()
    {
        return view('admin.pages.pay-type.create');
    } 

    //__Function for Save Payment Type__//
    public function store(Request $request)
    {
        $validation = $request->validate([
            'name' => 'required | unique:payment_types|max:20',
        ]);

        $paytype = new PaymentType();

        $paytype->name = $request->input('name');
        $paytype->description = $request->input('description');

        $paytype->save();

        return redirect()->route('admin.pay-type')->with('message', 'Payment Type Saved Successfully');
    }

    //__Function for Edit Payment Type info__//
    public function edit($id)
    {
        $paytype = PaymentType::find($id);

        return view('admin.pages.pay-type.edit', compact('paytype'));
    }

    //__Fucntion for Update Payment Type info__//
    public function update(Request $request, $id)
    {
        $paytype = PaymentType::find($id);

        $paytype->name = $request->input('name');
        $paytype->description = $request->input('description');

        $paytype->update();

        return redirect()->route('admin.pay-type')->with('message', 'Payment Type Updated Successfully');
    }

    //__function for Delete Payment Type__//
    public function destroy($id)
    {
        $paytype = PaymentType::find($id);

        $paytype->delete();

        return redirect()->back()->with('message', 'Payment Type info deleted Successfully');
    }

}
