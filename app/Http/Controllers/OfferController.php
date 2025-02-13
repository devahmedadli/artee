<?php

namespace App\Http\Controllers;

use App\Models\Chat;
use App\Models\User;
use App\Models\Offer;
use Illuminate\Http\Request;
use App\Http\Requests\StoreOfferRequest;
use App\Http\Requests\UpdateOfferRequest;

class OfferController extends Controller
{
    public function index()
    {
        $offers = Offer::where('admin_archived', false)->with('order')->get();
        // dd($offers);
        return view('admin.offers.index', compact('offers'));
    }
    // freelancer
    public function freelancerIndex()
    {
        $offers = Offer::with('order')->where('freelancer_id', auth()->user()->id)->where('freelancer_archived', false)->get();
        return view('freelancer.offers.index', compact('offers'));
    }

    public function create()
    {
        $customers = User::all();
        return view('admin.offers.create', compact('customers'));
    }

    public function store(StoreOfferRequest $request)
    {
        $offer = Offer::create($request->validated());
        flash()->success('تم ارسال العرض بنجاح');
        return to_route('offers.index');
    }

    public function show(Offer $offer)
    {
        return view('admin.offers.show', compact('offer'));
    }

    public function edit(offer $offer)
    {
        $customers = User::all();
        return view('admin.offers.edit', compact('offer', 'customers'));
    }

    public function update(UpdateOfferRequest $request, Offer $offer)
    {
        $offer->update($request->validated());
        flash()->success('تم تعديل العرض بنجاح');
        return to_route('offers.index');
    }

    public function sendPrice(Request $request, Offer $offer)
    {
        $request->validate(
            [
                'freelancer_price' => 'required|numeric|min:0',
            ],
            [
                'freelancer_price.required' => 'يجب تحديد السعر',
                'freelancer_price.numeric'  => 'يجب أن يكون السعر رقمًا',
                'freelancer_price.min'      => 'يجب أن يكون السعر أكثر من 0',
            ]
        );
        $offer->update(['freelancer_price' => $request->freelancer_price, 'status' => 'negotiating']);
        flash()->success('تم إرسال السعر بنجاح');
        return to_route('freelancer.offers.index');
    }

    public function destroy(Offer $offer)
    {
        $offer->delete();
        flash()->success('تم حذف العرض بنجاح');
        return to_route('offers.index');
    }

    public function accept(Offer $offer)
    {
        $offer->update([
            'status'            => 'accepted',
            'freelancer_price'  => $offer->admin_price,
        ]);

        $offer->order->update(
            [
                'status'        => 'in_progress',
                'freelancer_id' => $offer->freelancer_id,
            ]
        );
        $offer->order->progress()->create([
            'note' => 'بداية العمل على الطلب',
            'admin_accepted' => true,
        ]);

        flash()->success('تم قبول العرض بنجاح');
        return to_route('freelancer.offers.index');
    }

    public function cancel(Offer $offer)
    {
        $offer->update(['status' => 'canceled']);
        flash()->success('تم إلغاء العرض بنجاح');
        return to_route('offers.index');
    }

    public function reject(Offer $offer)
    {
        $offer->update(['status' => 'rejected']);
        flash()->success('تم رفض العرض بنجاح');
        return to_route('freelancer.offers.index');
    }
}
