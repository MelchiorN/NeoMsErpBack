<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Invoice;
use App\Models\InvoiceItem;
use App\Models\InvoiceType;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class ProformaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $proformas=Invoice::whereHas('invoiceType',function($q){
            $q->where('label','Facture Proforma');
        })->with(['items','client'])->get();
        return response()->json($proformas,200);
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        
        $validated = $request->validate([
            'clientId' => 'required|exists:clients,id',
            'items' => 'required|array|min:1',
            'items.*.productName' => 'required|string',
            'items.*.quantity' => 'required|integer|min:1',
            'items.*.unitPrice' => 'required|numeric|min:0',
        ]);
        DB::beginTransaction();
        try{
            $month=date('m');
            $year=date('Y');
            $count = Invoice::whereMonth('date', $month)->whereYear('date', $year)->whereHas('invoiceType', function ($q) {
                $q->where('label', 'Facture Proforma');
            })->count();
            $num = str_pad($count + 1, 3, '0', STR_PAD_LEFT);
            $ref = "PF/{$num}-{$month}/{$year}";
        

            $proformaType = InvoiceType::firstOrCreate(
            ['label' => 'Facture Proforma'],
            ['description' => 'Facture provisoire avant commande']
);

            // Creation de la facture
            $invoice= Invoice::create([
                'id' => (string) Str::uuid(),
                'ref'=> $ref,
                'date' => now(),
                'total' => collect($validated['items'])->sum(fn ($item) => $item['quantity'] * $item['unitPrice']),
                'invoice_type_id' => $proformaType->id,
                'order_id' => 2,
                'user_id' => 1, // Valeur par défaut, à modifier selon gestion utilisateur
                'client_id' => $validated['clientId'],
            ]);
            foreach ($validated['items'] as $item) {
                    InvoiceItem::create([
                        'invoice_id' => $invoice->id,
                        'product_name' => $item['productName'],
                        'quantity' => $item['quantity'],
                        'unit_price' => $item['unitPrice'],
                    ]);
                }
            DB::commit();  // Validation transaction

            return response()->json([
                'message' => 'Proforma créée avec succès',
                'invoice' => $invoice->load('items'), // Charge les lignes pour la réponse
            ], 201);

        } catch (\Exception $e) {
            DB::rollBack();  // Annule tout si erreur

            return response()->json([
                'error' => 'Erreur lors de la création de la proforma',
                'details' => $e->getMessage(),
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
