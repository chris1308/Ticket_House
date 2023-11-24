<?php

namespace App\Http\Controllers;

use App\Exports\ExportViewReport;
use App\Exports\ExportSalesReport;
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
        }
    }

    //export excel
    public function exportexcel($id){
        if ($id ==3){
            //export laporan view ticket
            return Excel::download(new ExportViewReport,"laporan-view-tiket.xlsx");
        }else if ($id == 1){
            //export laporan penjualan
            return Excel::download(new ExportSalesReport,"laporan-penjualan-tiket.xlsx");
        }else if ($id == 2){
            //export laporan cashflow
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
}
