<?php

namespace App\Application\Controllers\Website;

use App\Application\Controllers\AbstractController;
use App\Application\Model\Masterrequest;
use App\Application\Requests\Website\Masterrequest\AddRequestMasterrequest;
use App\Application\Requests\Website\Masterrequest\UpdateRequestMasterrequest;
use Illuminate\Support\Facades\Auth;

class MasterrequestController extends AbstractController
{

    public function __construct(Masterrequest $model)
    {
        parent::__construct($model);
    }

    public function index()
    {
        $items = $this->model;

        if (request()->has('from') && request()->get('from') != '') {
            $items = $items->whereDate('created_at', '>=', request()->get('from'));
        }

        if (request()->has('to') && request()->get('to') != '') {
            $items = $items->whereDate('created_at', '<=', request()->get('to'));
        }

        if (request()->has("collage_name") && request()->get("collage_name") != "") {
            $items = $items->where("collage_name", "=", request()->get("collage_name"));
        }

        if (request()->has("section") && request()->get("section") != "") {
            $items = $items->where("section", "=", request()->get("section"));
        }

        if (request()->has("g_year") && request()->get("g_year") != "") {
            $items = $items->where("g_year", "=", request()->get("g_year"));
        }

        if (request()->has("address") && request()->get("address") != "") {
            $items = $items->where("address", "=", request()->get("address"));
        }

        $items = $items->paginate(env('PAGINATE'));
        return view('website.masterrequest.index', compact('items'));
    }

    public function show($id = null)
    {
        return $this->createOrEdit('website.masterrequest.edit', $id);
    }

    public function store(AddRequestMasterrequest $request)
    {

        $request->request->add(['user_id' => Auth::user()->id]);
        $item = $this->storeOrUpdate($request, null, true);
        return redirect()->back();
    }

    public function update($id, UpdateRequestMasterrequest $request)
    {

        if ($request->has("oldFiles_documentation") && $request->oldFiles_documentation != "") {
            $oldImage_documentation = $request->oldFiles_documentation;
            $request->request->remove("oldFiles_documentation");
        } else {
            $oldImage_documentation = json_encode([]);
        }

        // dd($request);
        $item = $this->storeOrUpdate($request, $id, true);
        if ($item) {
            $image = json_decode($item->documentation) ?? [];
            $newIamge = json_decode($oldImage_documentation) ?? [];
            $item_image = array_unique(array_merge($image, $newIamge));
            $item->documentation = json_encode($item_image);
            $item->save();
        }
        return redirect()->back();

    }

    public function getById($id)
    {
        $fields = $this->model->findOrFail($id);
        return $this->createOrEdit('website.masterrequest.show', $id, ['fields' => $fields]);
    }

    public function destroy($id)
    {
        return $this->deleteItem($id, 'masterrequest')->with('sucess', 'Done Delete Masterrequest From system');
    }

}
