<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use App\Models\Invoice;
use App\Models\InvoiceItem;
use App\Models\InvoiceType;



class InvoiceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
          $def=Invoice::whereHas('invoiceType',function($query){
            $query->where('label','Facture Definitive');
        })->with(['client','invoiceType','order','order.articles'])->get();
        
        return response()->json($def,200);
        //
    }
//      public function index(Request $request)
    // {
        // $type = $request->query('type'); // "definitive" ou "acompte"
        // $query = Invoice::with(['items', 'client', 'invoiceType']);
        // if ($type === 'definitive') {
        //     $query->whereHas('invoiceType', fn($q) => $q->where('label', 'Facture Définitive'));
        // } elseif ($type === 'acompte') {
        //     $query->whereHas('invoiceType', fn($q) => $q->where('label', 'Facture Acompte'));
        // }
        // $invoices = $query->get();
        // return response()->json($invoices, 200);
    // }


    // public function index()
    // {
    //       $def=Invoice::whereHas('invoiceType',function($query){
    //         $query->where('label','Facture Definitive');
    //     })->with(['items','client','invoiceType'])->get();
    //     $acompte=Invoice::whereHas('invoiceType',function($query){
    //         $query->where('label','Facture Acompte');
    //     })->with(['items','client','invoiceType'])->get();
    //     return response()->json([
    //         'definitive'=>$def,
    //         'acompte'=>$acompte
    //     ],200);
    //     //
    // }

    /**
     * Store a newly created resource in storage.
     */
   public function store(Request $request)
{
    $validated = $request->validate([
        'clientId' => 'required|exists:clients,id',
        'orderId' => 'required|exists:orders,id',
        'items' => 'required|array|min:1',
        'items.*.productName' => 'required|string',
        'items.*.quantity' => 'required|integer|min:1',
        'items.*.unitPrice' => 'required|numeric|min:0',
        'invoiceType' => 'required|string|in:definitive,acompte',
        'remisePercent' => 'nullable|numeric|min:0|max:100',
    ]);

    DB::beginTransaction();

    try {
        // ✅ Type et préfixe
        $type = $validated['invoiceType'];
        $label = $type === 'definitive' ? 'Facture Définitive' : 'Facture Acompte';
        $prefix = $type === 'definitive' ? 'F' : 'AC';

        // ✅ Création ou récupération du type de facture
        $invoiceType = InvoiceType::firstOrCreate(
            ['label' => $label],
            ['description' => 'Facture '.$label]
        );

        // ✅ Numérotation
        $month = date('m');
        $year = date('Y');
        $count = Invoice::whereMonth('date', $month)
            ->whereYear('date', $year)
            ->whereHas('invoiceType', fn($q) => $q->where('label', $label))
            ->count();
        $num = str_pad($count + 1, 3, '0', STR_PAD_LEFT);
        $ref = "{$prefix}/{$num}-{$month}/{$year}";

        // ✅ Calcul des totaux
        $subtotal = collect($validated['items'])->sum(fn($i) => $i['quantity'] * $i['unitPrice']);
        $remisePercent = $validated['remisePercent'] ?? 0;
        $remiseMontant = ($subtotal * $remisePercent) / 100;
        $totalNet = $subtotal - $remiseMontant;
        $tvaRate = 18;
        $tvaMontant = ($totalNet * $tvaRate) / 100;
        $totalTTC = $totalNet + $tvaMontant;

        // ✅ Création de la facture
        $invoice = Invoice::create([
            'ref' => $ref,
            'date' => now(),
            'total' => $totalTTC,
            'invoice_type_id' => $invoiceType->id,
            'order_id' => $validated['orderId'],
            'client_id' => $validated['clientId'],
            'user_id' => auth()->id() ?? 1,
        ]);

        // // ✅ Insertion des items
        // foreach ($validated['items'] as $item) {
        //     InvoiceItem::create([
        //         'invoice_id' => $invoice->id,
        //         'product_name' => $item['productName'],
        //         'quantity' => $item['quantity'],
        //         'unit_price' => $item['unitPrice'],
        //     ]);
        // }

        DB::commit();
        return response()->json([
            'message' => "Facture $label créée avec succès",
            'invoice' => $invoice->load('items'),
        ], 201);

    } catch (\Exception $e) {
        DB::rollBack();
        return response()->json(['error' => $e->getMessage()], 500);
    }
}



//Enregistrer facture d'acompte
public function storeAcompte(Request $request){
         $validated = $request->validate([
        'clientId' => 'required|exists:clients,id',
        'orderId' => 'required|exists:orders,id',
        'items' => 'required|array|min:1',
        'items.*.productName' => 'required|string',
        'items.*.quantity' => 'required|integer|min:1',
        'items.*.unitPrice' => 'required|numeric|min:0',
        'acomptePercent' => 'required|numeric|min:1|max:100',
        'acompteRemisePercent' => 'nullable|numeric|min:0|max:100',
    ]);

    DB::beginTransaction();

    try {
        $month = date('m');
        $year = date('Y');
        $count = Invoice::whereMonth('date', $month)
            ->whereYear('date', $year)
            ->whereHas('invoiceType', function ($q) {
                $q->where('label', 'Facture Acompte');
            })->count();

        $num = str_pad($count + 1, 3, '0', STR_PAD_LEFT);
        $ref = "FA/{$num}-{$month}/{$year}";

        // Calcul du subtotal
        $subtotal = collect($validated['items'])->sum(fn($item) => $item['quantity'] * $item['unitPrice']);

        // Remise si existante
        $acompteRemisePercent = $validated['acompteRemisePercent'] ?? 0;
        $acompteRemiseMontant = ($subtotal * $acompteRemisePercent) / 100;

        // Net après remise
        $acompteNet = $subtotal - $acompteRemiseMontant;

        // Calcul acompte HT
        $acompteHT = ($acompteNet * $validated['acomptePercent']) / 100;

        // TVA sur acompte
        $tvaRate = 18;
        $tvaAcompte = ($acompteHT * $tvaRate) / 100;

        // Total TTC acompte
        $totalTTC = $acompteHT + $tvaAcompte;

        // Type facture acompte
        $acompteType = InvoiceType::firstOrCreate(
            ['label' => 'Facture Acompte'],
            ['description' => 'Facture pour acompte sur commande']
        );

        // Création facture acompte
        $invoice = Invoice::create([
            'ref' => $ref,
            'date' => now(),
            'total' => $totalTTC,
            'invoice_type_id' => $acompteType->id,
            'order_id' => $validated['orderId'],
            'client_id' => $validated['clientId'],
            'user_id' => 3, // Utilisateur par defaut (pas d'authentification)
        ]);

        // // Ajout des articles
        // foreach ($validated['items'] as $item) {
        //     InvoiceItem::create([
        //         'invoice_id' => $invoice->id,
        //         'product_name' => $item['productName'],
        //         'quantity' => $item['quantity'],
        //         'unit_price' => $item['unitPrice'],
        //     ]);
        // }

        DB::commit();

        return response()->json([
            'message' => 'Facture acompte créée avec succès',
            'invoice' => $invoice->load('items'),
        ], 201);

    } catch (\Exception $e) {
        DB::rollBack();

        return response()->json([
            'error' => 'Erreur lors de la création de la facture acompte',
            'details' => $e->getMessage(),
        ], 500);
    }

}

//Afficher les factures d'acompte
public function indexAcompte(){

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
