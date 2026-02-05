<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\InertiaTest;

class InertiaTest extends Model
{
    use HasFactory;

    public function store(Request $request)
    {
        $inertiaTest = new InertiaTest();
        $inertiaTest->title = $request->input('title');
        $inertiaTest->content = $request->input('content');
        $inertiaTest->save();

        return redirect()->route('inertia.index');
    }
}
