<?php

namespace App\Http\Controllers;

use App\Constants\AppConstant;
use App\Http\Requests\CreateBillRequest;
use App\Models\Bill;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class BillController extends Controller
{

    public function index(Request $request)
    {
        $tab = 'order';
        $orderBy = $request['order_by'];
        $status = $request['status'];
        $list = Bill::when(isset($status), function($q) use($status){
            $q->where('status', $status);
        })
        ->when(isset($orderBy), function($q) use($orderBy){
            $arrOrderBy = explode("|", $orderBy);
            $q->orderBy($arrOrderBy[0], $arrOrderBy[1]);
        })
        ->with(['town.district.province'])
        ->paginate(AppConstant::PAGINATE_ORDER);

        return view('admin/order', compact([
            'tab', 
            'list',
            'orderBy',
            'status'
        ]));
    }

    public function createBill(CreateBillRequest $request)
    {
        DB::beginTransaction();
        try {
            $createdBill = Bill::create([
                'code' => date('HisdmY'),
                'note' => $request['note'],
                'town_id' => $request['town_id'],
                'address' => $request['address'],
                'phone' => $request['phone'],
                'name' => $request['name']
            ]);
    
            foreach($request['cart'] as $productItem){
                $createdBill->products()->attach($productItem['id'], [
                    'amount' => $productItem['total'],
                    'price_sale' => $productItem['price'],
                    'color_code' => $productItem['colorName'],
                    'size' => $productItem['sizeName'],
                    'created_at' => date('Y-m-d H:i:s'),
                    'updated_at' => date('Y-m-d H:i:s'),
                ]);
            }

            DB::commit();
            return $this->success("Tạo đơn hàng thành công !");
        } catch (\Throwable $th) {
            DB::rollBack();
            throw $th;
        }
    }

    public function updateStatus(Request $request)
    {
        $status = Bill::where('id', $request['id'])->update(['status' => $request['status']]);
        return $this->success($status);
    }

    public function detailOrder($id)
    {
        $detail = Bill::where('id', $id)
        ->with(['products'])
        ->first();

        return $this->success($detail);
    }
}
