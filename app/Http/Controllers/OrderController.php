<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\Article;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        return response()->json(Order::with(['client','articles'])->get(),200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $validated = $request->validate([
        'invoice_id' => 'nullable',
        'client_id' => 'nullable|uuid',
        // 'deliveryDate' => 'nullable|date',
        'items' => 'required|array|min:1',
        'items.*.name' => 'required|string',
        'items.*.qty' => 'required|integer|min:1',
        'items.*.price' => 'required|numeric|min:0'
    ]);

    DB::beginTransaction();
    try {
        // Créer la commande (exemple simple)
        $order = Order::create([
            'invoice_id' => $validated['invoice_id']??null,
            // 'delivery_date' => $validated['deliveryDate'],
            'user_id' => '01986509-dc8b-728e-b130-02e92ba9bc2a',
            'client_id' => $validated['client_id'],
        ]);
        // Préparer les relations pour le pivot
            $attachData = [];

            foreach ($validated['items'] as $item) {
            $article = Article::where('label', $item['name'])->first();

            if (!$article) {
                DB::rollBack();
                return response()->json([
                    'error' => "L'article '{$item['name']}' n'existe pas."
                ], 422);
            }
                // Prépare les données à attacher dans la table pivot
                $attachData[$article->id] = ['quantity' => $item['qty']];
            }
            // Attache les articles à la commande avec la quantité dans la table pivot
            $order->articles()->attach($attachData);
            DB::commit();
            
            return response()->json([
                "message"=>"Commande enregistré avec succès",
                "order" => $order->load('articles') // Charge les articles liés pour retour
            ],201);

        }catch(\Exception $e){
            DB::rollBack();
            return response()->json(['error' => 'Erreur lors de la création : ' . $e->getMessage()], 500);

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
