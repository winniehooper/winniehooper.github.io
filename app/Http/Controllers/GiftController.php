<?php

namespace App\Http\Controllers;

use App\Models\Gift;
use Carbon\Carbon;
use Illuminate\Http\Request;

class GiftController extends Controller
{
    public function store() {
        $data = request()->only(['projectId', 'sum', 'description', 'count']);
        $gift = Gift::create($data);
        $gift->save();
        $ret = [
          'status' => 'success',
          'content' => view('projects.gift.item', ['model' => $gift])->render(),
        ];
        return $ret;
    }

    public function update() {
        $gift = Gift::find(request('giftId'));
        $data = request()->only(['sum', 'description', 'count']);
        $gift->fill($data);
        $gift->save();
        $ret = [
          'status' => 'success',
          'content' => Carbon::now()->format('H:i:s'),
        ];
        return $ret;
    }

    public function delete() {
        $gift = Gift::find(request('giftId'));
        $gift->delete();
        $ret = [
          'status' => 'success',
          'message' => 'Лот удалён успешно',
        ];
        return $ret;
    }
}
