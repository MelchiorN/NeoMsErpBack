<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DeliveryNote;
use App\Models\DeliveryNoteItem;
use Illuminate\Support\Facades\DB;


class DeliveryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return response()->json(DeliveryNote::with(['order','order.client','order.articles','items'])->get(),200);
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validation des données reçues
        $validated = $request->validate([
            'order_id' => 'required|uuid|exists:orders,id',
            'delivery_date' => 'required|date',
            'delivery_address' => 'required|string|max:255',
            'delivery_type' => 'required|in:complete,partial',
            'items' => 'required|array|min:1',
            'items.*.article_id' => 'required|uuid|exists:articles,id',
            'items.*.product_code' => 'required|string',
            'items.*.designation' => 'nullable|string',
            'items.*.serial_number' => 'nullable|string',
            'items.*.quantity_ordered' => 'required|integer|min:1',
            'items.*.quantity_delivered' => 'required|integer|min:0',
        ]);

        // On utilise une transaction pour garantir la cohérence
        DB::beginTransaction();

        try {
            // Création du bordereau de livraison avec UUID
            $deliveryNote = DeliveryNote::create([
                'order_id' => $validated['order_id'],
                'delivery_date' => $validated['delivery_date'],
                'delivery_address' => $validated['delivery_address'],
                'delivery_type' => $validated['delivery_type'],
            ]);

            // Création des items liés
            foreach ($validated['items'] as $item) {
                DeliveryNoteItem::create([
                    'delivery_note_id' => $deliveryNote->id,
                    'article_id' => $item['article_id'],
                    'product_code' => $item['product_code'],
                    'designation' => $item['designation'] ?? null,
                    'serial_number' => $item['serial_number'] ?? null,
                    'quantity_ordered' => $item['quantity_ordered'],
                    'quantity_delivered' => $item['quantity_delivered'],
                ]);
            }

            DB::commit();

            return response()->json([
                'message' => 'Bordereau de livraison créé avec succès',
                'delivery_note' => $deliveryNote->load('items')
            ], 201);

        } catch (\Exception $e) {
            DB::rollback();

            return response()->json([
                'message' => "Erreur lors de la création : " . $e->getMessage()
            ], 500);
        }
    }
    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
