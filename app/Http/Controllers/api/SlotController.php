<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\Slot;
use App\Http\Requests\StoreSlotRequest;
use App\Http\Requests\UpdateSlotRequest;

class SlotController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // No need to implement this, since noone should be able to see all slots.
        abort(404);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreSlotRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreSlotRequest $request)
    {
        // No need to implement this, since noone should be able to create a slot.
        abort(404);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Slot  $slot
     * @return \Illuminate\Http\Response
     */
    public function show(Slot $slot)
    {
        // No need to implement this, since noone should be able to get a slot.
        abort(404);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateSlotRequest  $request
     * @param  \App\Models\Slot  $slot
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateSlotRequest $request, Slot $slot)
    {
        // If game is over, noone should be able to update a slot.
        if ($slot->row->game->lost || $slot->row->game->won) {
            abort(404);
        }
        // Update the slot with validated data.
        $slot->update($request->validated());
        return response()->json($slot);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Slot  $slot
     * @return \Illuminate\Http\Response
     */
    public function destroy(Slot $slot)
    {
        // No need to implement this, since noone should be able to delete a slot.
        abort(404);
    }
}
