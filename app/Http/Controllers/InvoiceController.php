<?php

namespace App\Http\Controllers;

use App\Models\Invoice;
use Illuminate\Database\QueryException; // Importa la excepción QueryException
use App\Models\Medicine;
use App\Models\Patient;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\PDF;
class InvoiceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $invoices=Invoice::all();
        $patients=Patient::all();
        return view('invoice.index',
        ['invoices'=>$invoices,
        'patients'=>$patients]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $input=$request->all();
        Invoice::create($input);
        return redirect('Facturas')->with('flash_message', 'Addedd!');

    }
    public function editAjax(Invoice $invoice)
    {
        $nameP=$invoice->patients->dni.'||'.$invoice->patients->name.'|'.$invoice->patients->lastname;

        return response()->json([
            'nameP'=>$nameP,
            'fecha'=>$invoice->date_issue
        ]);
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Invoice $invoice)
    {
        $input=$request->all();
        $invoice->update($input);

        return redirect()->route('invoice.index')->with('flash_message', 'Updated!');

    }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Invoice $invoice)
    {
        $medicenes=Medicine::whereDoesntHave('invoiceDetails',function($query) use ($invoice){
            $query->where('id_invoice',$invoice->id);
        })->get();

        $invoiceDets=$invoice->invoiceDetails;

        return view('invoice.show', [
            'invoiceDet' => $invoiceDets,
            'invoice' => $invoice,
            'medicenes'=>$medicenes,
        ]);
    }
    public function registerMedicines(Request $request, Invoice $invoice)
    {
        try {
            $amount = $request['amount'];
            $medicenes = Medicine::findOrFail($request['id_medicine']);
            $invoice->invoiceDetails()->attach($medicenes, [
                'amount' => $amount,
            ]);
    
            return redirect()->route('invoice.show', $invoice)->with('flash_message', 'Added!');
        } catch (QueryException $e) {  
            return redirect()->back()->with('error_message', 'Ha ocurrido un error al registrar el medicamento.');
        } catch (\Exception $e) {

            return redirect()->back()->with('error_message', 'Ha ocurrido un error inesperado.');
        }
    }

    public function invDetUpdateAjax(Invoice $invoice, Medicine $medicine)
    {
        $amount = $medicine->invoiceDetails()
        ->wherePivot('id_invoice', $invoice->id)
        ->first()->pivot->amount;

        $mediName=$medicine->product.' || '.$medicine->price;

        return response()->json([
            'mediName'=>$mediName,
            'amount'=>$amount
        ]);
    }
    public function invDetUpdate(Request $request,Invoice $invoice, Medicine $medicine)
    {

        $medicine->invoiceDetails()->updateExistingPivot($invoice,[
            'amount'=>$request['amount']
        ]);

        return redirect()->route('invoice.show',$invoice)->with('flash_message', 'Updated!');

    }

    public function DetInvoiceDelete(Invoice $invoice, Medicine $medicine)
    {
        $medicine->invoiceDetails()->detach($invoice);

        return redirect()->route('invoice.show', $invoice)->with('flash_message', 'deleted!');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
   

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Invoice $invoice)
    {
        $invoice->delete();
        return redirect('Facturas')->with('flash_message', 'deleted!');  
    }


    public function factura(Invoice $invoice)
    {
        $invoiceDets=$invoice->invoiceDetails;
        $medicines = Medicine::all(); 
        $preciT=0;

        foreach ($invoiceDets as $detalle) {
            foreach($medicines as $medicine){
               if ($detalle->id === $medicine->id) {
                $precio = $detalle->price;
                $cantidad = $detalle->pivot->amount;
                $preciXcant = $precio * $cantidad;
                $preciT += $preciXcant;
             } 
    
            }
            
        }
        $igv=$preciT*0.18;
        $grav=$preciT-$igv;
        

        $pdf = \PDF::loadView('invoice.factura', compact('invoice', 'invoiceDets','preciT','igv','grav'));
        $pdf_name='factura.pdf';
        return $pdf->stream($pdf_name);

    }
}
