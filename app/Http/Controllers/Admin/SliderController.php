<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Slider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class SliderController extends Controller
{
    public function index()
    {
        $sliders = Slider::orderBy('sort_order')->get();
        return view('admin.sliders.index', compact('sliders'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'image' => 'required|image|mimes:jpeg,png,jpg,webp|max:2048',
            'title' => 'nullable|string|max:255',
            'subtitle' => 'nullable|string|max:255',
        ]);

        $path = $request->file('image')->store('sliders', 'public');

        Slider::create([
            'image' => $path,
            'title' => $request->title,
            'subtitle' => $request->subtitle,
            'sort_order' => Slider::max('sort_order') + 1,
        ]);

        return back()->with('success', 'اسلایدر با موفقیت اضافه شد');
    }

    public function destroy(Slider $slider)
    {
        Storage::disk('public')->delete($slider->image);
        $slider->delete();

        return back()->with('success', 'اسلایدر حذف شد');
    }

    public function updateOrder(Request $request)
    {
        $order = $request->order;
        foreach ($order as $index => $id) {
            Slider::where('id', $id)->update(['sort_order' => $index + 1]);
        }

        return response()->json(['success' => true]);
    }
}