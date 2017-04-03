<?php

namespace App\Http\Controllers;

use App\Models\FAQ;
use Carbon\Carbon;
use Illuminate\Http\Request;

class FaqController extends Controller
{
    public function store() {
        $data = request()->only(['projectId', 'question', 'answer']);
        $faq = FAQ::create($data);
        $faq->save();
        $ret = [
          'status' => 'success',
            'content' => view('projects.faq.item', ['model' => $faq])->render(),
        ];
        return $ret;
    }

    public function update() {
        $faq = FAQ::find(request('faqId'));
        $data = request()->only(['question', 'answer']);
        $faq->fill($data);
        $faq->save();
        $ret = [
          'status' => 'success',
          'content' => Carbon::now()->format('H:i:s'),
        ];
        return $ret;
    }

    public function delete() {
        $faq = FAQ::find(request('faqId'));
        $faq->delete();
        $ret = [
          'status' => 'success',
          'message' => 'Вопрос удалён успешно',
        ];
        return $ret;
    }
}
