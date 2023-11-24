<?php

namespace App\Http\Controllers;

use App\Exports\ExportViewReport;
use App\Exports\ExportSalesReport;
use App\Exports\ExportCashflowReport;
use Illuminate\Http\Request;
use App\Models\Penjual;
use App\Models\Pembelian;
use App\Models\Tiket;
use Barryvdh\DomPDF\Facade\Pdf; //untuk export pdf
use Maatwebsite\Excel\Facades\Excel; //untuk export excel
class PenjualController extends Controller
{
    public function upgrade($id){ 
        Penjual::where('id_penjual',$id)->update(["premium_status"=>1]);
        $penjual = Penjual::where('id_penjual',$id)->first();
        //update session so that the membership status on the sidebar will be updated
        session(['user'=>$penjual]);
        
        return redirect('/dashboard');
    }

    public function show(){
        $title = "Seller Dashboard";
        //count total views of all tickets owned by this seller
        $allTickets = Tiket::where('id_penjual',session('user')->id_penjual)->get();
        $totalView = 0;
        foreach ($allTickets as $ticket) {
            $totalView += $ticket->jumlah_view;
        }
        $totalRevenue = 0;
        $ticketSold = 0;
        $allPurchase = Pembelian::all();
        foreach ($allPurchase as $purchase) {
            foreach ($allTickets as $ticket){
                if ($purchase->id_tiket == $ticket->id_tiket){
                    $totalRevenue  += $purchase->total;
                    $ticketSold += $purchase->quantity;
                    break;
                }
            }
        }
        return view('sellerDashboard',compact('title', 'totalView','totalRevenue','ticketSold'));
    }

    public function viewReport(){
        //show view report of currently logged in seller
        $title = "Laporan View Tiket";
        //get all tickets that belong to this seller
        $allTickets = Tiket::where('id_penjual',session('user')->id_penjual)->get();

        return view('viewReport',compact('title','allTickets'));
    }

    //export to pdf
    public function exportpdf($id){
        $allTickets = Tiket::where('id_penjual',session('user')->id_penjual)->get();
        $purchases = Pembelian::all();
        $groupedInvoices = $purchases->groupBy(function ($invoice) {
            return $invoice->tanggal_pembelian;
        });
        $sortedGroupedInvoices = $groupedInvoices->sortBy(function ($invoicesPerDate, $createdDate) {
            return strtotime($createdDate); // Convert date string to timestamp for sorting
        });
        $tempCashflows = [];
        foreach($sortedGroupedInvoices as $invoiceDate => $invoicesPerDate){
            $tanggal = $invoiceDate;
            $total=0; //total pemasukan di tiap tanggal
            $ticketSold=0;
            foreach($invoicesPerDate as $i){
                //kumpulan dari invoice di tiap tanggal
                //sebelum di increment, pastikan dulu invoice ini adalah dari tiket milik penjual yg login
                foreach($allTickets as $a){
                    if ($a->id_tiket == $i->id_tiket){
                        $total+=$i->total; //increment total pemasukan
                        $ticketSold+=$i->quantity; //total tiket yang terjual di tanggal tertentu      
                        break;          
                    }
                }
            }
            if ($total>0 && $ticketSold>0){
                $tempData = [
                    "tanggal"=>$tanggal,
                    "total_pemasukan"=>$total,
                    "tiket_terjual"=>$ticketSold,
                ];
                array_push($tempCashflows,$tempData);
            }
        }
        $tempTickets = [];
        foreach($purchases as $p){
            foreach ($allTickets as $ticket) {
                if ($p->id_tiket == $ticket->id_tiket){
                    //buat object dengan attribute yang diperlukan untuk ditampilkan di report
                    $tempData = [
                        'id_invoice'=>$p->id_invoice,
                        'nama'=>$ticket->nama,
                        'total'=>$p->total,
                        'tanggal_pembelian'=>$p->tanggal_pembelian,
                    ];                    
                    array_push($tempTickets,$tempData);
                    //cara akses elemennya di salesReport.blade tidak bisa pake $ticket->id_tiket, tapi harus $ticket['id_tiket']
                }                
            }
        }
        // dd($data);
        if($id == 3){
            $data=[
                'allTickets' => $allTickets
            ];
            //export laporan view ticket
            $pdf = Pdf::loadView('exportpage',$data); //exportpage == laporan view ticket
            return $pdf->download('laporan-view-tiket.pdf');
        }else if ($id ==1){
            //export laporan penjualan
            $data=[
                'tempTickets' => $tempTickets
            ];
            $pdf = Pdf::loadView('exportpage2',$data); //exportpage2 == laporan penjualan
            return $pdf->download('laporan-penjualan.pdf');
        }else if ($id ==2){
            //export pdf laporan cashflow
            $data = [
                'tempCashflows' =>$tempCashflows
            ];
            $pdf = Pdf::loadView('exportpage3',$data); //exportpage3 == laporan cashflow
            return $pdf->download('laporan-cashflow.pdf');
        }
    }

    //export excel
    public function exportexcel($id){
        if ($id ==3){
            //export laporan view ticket
            return Excel::download(new ExportViewReport,"laporan-view-tiket.xlsx");
        }else if ($id == 1){
            //export laporan penjualan
            return Excel::download(new ExportSalesReport,"laporan-penjualan.xlsx");
        }else if ($id == 2){
            //export laporan cashflow
            return Excel::download(new ExportCashflowReport,"laporan-cashflow.xlsx");
        }
    }

    public function salesReport(){
        $title = "Laporan Penjualan";
        //ambil semua tiket milik penjual ini
        $allTickets = Tiket::where('id_penjual',session('user')->id_penjual)->get();
        $purchases = Pembelian::all();
        $tempTickets = [];
        foreach($purchases as $p){
            foreach ($allTickets as $ticket) {
                if ($p->id_tiket == $ticket->id_tiket){
                    //buat object dengan attribute yang diperlukan untuk ditampilkan di report
                    $tempData = [
                        'id_invoice'=>$p->id_invoice,
                        'nama'=>$ticket->nama,
                        'total'=>$p->total,
                        'tanggal_pembelian'=>$p->tanggal_pembelian,
                    ];                    
                    array_push($tempTickets,$tempData);
                    //cara akses elemennya di salesReport.blade tidak bisa pake $ticket->id_tiket, tapi harus $ticket['id_tiket']
                }                
            }
        }
        return view('salesReport',compact('title','tempTickets'));
    }

    public function cashflowReport(){
        $title = "Laporan Cashflow";
        $allTickets = Tiket::where('id_penjual',session('user')->id_penjual)->get();
        $purchases = Pembelian::all();
        //kelompokkan berdasarkan tanggal
        $groupedInvoices = $purchases->groupBy(function ($invoice) {
            return $invoice->tanggal_pembelian;
        });
        //hasil grouping berupa :
        /*"23-11-2023 : [
            {
                invoice1
            },
            {
                invoice2
            }
        ]" */
        // Sort the grouped tickets by date
        $sortedGroupedInvoices = $groupedInvoices->sortBy(function ($invoicesPerDate, $createdDate) {
            return strtotime($createdDate); // Convert date string to timestamp for sorting
        });
        $tempCashflows = [];
        foreach($sortedGroupedInvoices as $invoiceDate => $invoicesPerDate){
            $tanggal = $invoiceDate;
            $total=0; //total pemasukan di tiap tanggal
            $ticketSold=0;
            foreach($invoicesPerDate as $i){
                //kumpulan dari invoice di tiap tanggal
                //sebelum di increment, pastikan dulu invoice ini adalah dari tiket milik penjual yg login
                foreach($allTickets as $a){
                    if ($a->id_tiket == $i->id_tiket){
                        $total+=$i->total; //increment total pemasukan
                        $ticketSold+=$i->quantity; //total tiket yang terjual di tanggal tertentu      
                        break;          
                    }
                }
            }
            if ($total>0 && $ticketSold>0){
                $tempData = [
                    "tanggal"=>$tanggal,
                    "total_pemasukan"=>$total,
                    "tiket_terjual"=>$ticketSold,
                ];
                array_push($tempCashflows,$tempData);
            }
        }
        //filter cashflows yang menjadi milik penjual yg sedang login

        return view('cashflowReport',compact('title','tempCashflows'));
    }
}
