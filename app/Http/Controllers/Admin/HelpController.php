<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Help\HelpStoreRequest;
use App\Models\Help;
use Illuminate\Support\Facades\Session;

class HelpController extends Controller
{
    public function help()
    {
        $helpModel = Help::where('id', 1)->first();
        return view('admin.help', [
            'helpText' => html_entity_decode($helpModel->text ?? "")
        ]);
    }

    public function helpStore(HelpStoreRequest $request)
    {

        $helpModel = Help::where('id', 1)->first();

        if (!$helpModel) {
            $helpModel = new Help();
        }

        $cleaned = rtrim(substr($request['help-text'], 1), '"');

        // for adding images
        $cleaned = str_replace('\"', '', $cleaned);

        $helpModel->text = htmlentities($cleaned);


        if ($helpModel->save()) {
            Session::flash('help_text_saved', 'Изменения сохранены');
        }

        return redirect('admin/help');
    }
}
