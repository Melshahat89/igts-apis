<?php

namespace App\Application\Controllers\Website;

use App\Application\Controllers\AbstractController;
use App\Application\Model\Categories;
use App\Application\Model\Courses;
use App\Application\Model\Events;
use App\Application\Model\Talklikes;
use App\Application\Model\Talks;
use App\Application\Requests\Website\Talks\AddRequestTalks;
use App\Application\Requests\Website\Talks\UpdateRequestTalks;
use Illuminate\Support\Facades\Auth;

class TalksController extends AbstractController
{

    public function __construct(Talks $model)
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

        if (request()->has("title") && request()->get("title") != "") {
            $items = $items->where("title", "like", "%" . request()->get("title") . "%");
        }

        if (request()->has("slug") && request()->get("slug") != "") {
            $items = $items->where("slug", "=", request()->get("slug"));
        }

        if (request()->has("subtitle") && request()->get("subtitle") != "") {
            $items = $items->where("subtitle", "like", "%" . request()->get("subtitle") . "%");
        }

        if (request()->has("description") && request()->get("description") != "") {
            $items = $items->where("description", "like", "%" . request()->get("description") . "%");
        }

        if (request()->has("language_id") && request()->get("language_id") != "") {
            $items = $items->where("language_id", "=", request()->get("language_id"));
        }

        if (request()->has("length") && request()->get("length") != "") {
            $items = $items->where("length", "=", request()->get("length"));
        }

        if (request()->has("featured") && request()->get("featured") != "") {
            $items = $items->where("featured", "=", request()->get("featured"));
        }

        if (request()->has("published") && request()->get("published") != "") {
            $items = $items->where("published", "=", request()->get("published"));
        }

        if (request()->has("visits") && request()->get("visits") != "") {
            $items = $items->where("visits", "=", request()->get("visits"));
        }

        if (request()->has("video_file") && request()->get("video_file") != "") {
            $items = $items->where("video_file", "=", request()->get("video_file"));
        }

        if (request()->has("sort") && request()->get("sort") != "") {
            $items = $items->where("sort", "=", request()->get("sort"));
        }

        if (request()->has("doctor_name") && request()->get("doctor_name") != "") {
            $items = $items->where("doctor_name", "like", "%" . request()->get("doctor_name") . "%");
        }

        if (request()->has("seo_desc") && request()->get("seo_desc") != "") {
            $items = $items->where("seo_desc", "like", "%" . request()->get("seo_desc") . "%");
        }

        if (request()->has("seo_keys") && request()->get("seo_keys") != "") {
            $items = $items->where("seo_keys", "like", "%" . request()->get("seo_keys") . "%");
        }

        if (request()->has("search_keys") && request()->get("search_keys") != "") {
            $items = $items->where("search_keys", "like", "%" . request()->get("search_keys") . "%");
        }

        $items = $items->paginate(env('PAGINATE'));
        return view('website.talks.index', compact('items'));
    }

    public function show($id = null)
    {
        return $this->createOrEdit('website.talks.edit', $id);
    }

    public function store(AddRequestTalks $request)
    {
        $item = $this->storeOrUpdate($request, null, true);
        return redirect('talks');
    }

    public function update($id, UpdateRequestTalks $request)
    {
        $item = $this->storeOrUpdate($request, $id, true);
        return redirect()->back();

    }

    public function getById($id)
    {
        $fields = $this->model->findOrFail($id);
        return $this->createOrEdit('website.talks.show', $id, ['fields' => $fields]);
    }

    public function destroy($id)
    {
        return $this->deleteItem($id, 'talks')->with('sucess', 'Done Delete Talks From system');
    }

    public function page($slug)
    {
        $talk = $this->model->where('slug', $slug)->firstOrFail();
        $this->data['model'] = $talk;

        $this->data['relatedTalks'] = $talk->talksrelated;
        $this->data['relatedCourses'] = Courses::where('type', Courses::TYPE_COURSE)->where('categories_id', $talk->categories_id)->limit(10)->get();

        return view('website.talks.page', $this->data);
    }

    public function category()
    {
        $items = $this->model;

        if (request()->has("category") && request()->get("category") != "") {

            $items = $items->whereHas('categories', function ($query) {
                return $query->where('slug', '=', request()->get("category"));
            });

            $category = Categories::where('slug', request()->get("category"))->first();
            $this->data['category'] = $category;
        }

        if (request()->has('key') && request()->get('key') != '') {
            // $items = $items->where("title", "like", "%" . request()->get("key") . "%");

            $items = $items->where(function ($query) {
                $query->where("title", "like", "%" . request()->get("key") . "%")
                    ->orWhere("search_keys", "like", "%" . request()->get("key") . "%")
                    ->orWhere("doctor_name", "like", "%" . request()->get("key") . "%")

                ;
            });

            $this->data['key'] = $_GET['key'];
        }

        if (isset($category)) {
            // Most Viewed talks
            $mostViewedPerCategory = Talks::where('categories_id', $category->id)->orderBy('visits', 'DESC')->limit(10)->get();

        } else {
            // Most Viewed talks
            $mostViewedPerCategory = Talks::orderBy('visits', 'DESC')->limit(10)->get();
        }

        // // $items = $items->where('published', 1)->get();

        // $items = $items->where('published', 1)->paginate(8);


        if(request()->has('rating') or request()->has('duration')){
            $items = $items->where('published', 1)->get();
        }else{
            $items = $items->where('published', 1)->paginate(8);

        }



        if (request()->has('rating') && request()->get('rating') != '') {
            $this->data['rating'] = $_GET['rating'];
            $items = $items->filter(function ($item) {
                if ($item->TalkRating > ((int) $this->data['rating'] - 1) and $item->TalkRating <= (int) $this->data['rating']) {
                    return $item;
                }
            });
        } else {
            $this->data['rating'] = '';
        }


        // $items = $items->paginate(env('PAGINATE'));

        $this->data['items'] = $items;
        $this->data['mostViewedPerCategory'] = $mostViewedPerCategory;

        $bundles = Courses::where('type', Courses::TYPE_BUNDLES)->get();

        $masters = Courses::where('type', Courses::TYPE_MASTERS)->get();

        $events = Events::get();

        $this->data['Bundles'] = $bundles;
        $this->data['Masters'] = $masters;
        $this->data['Events'] = $events;

        return view('website.talks.category', $this->data);
    }

    public function like($talkID ,$status){

        $talk = $this->model->findOrFail($talkID);
        $talklikes = Talklikes::where('user_id',Auth::user()->id)->where('talks_id',$talk->id)->first();

        if($talklikes){
            $talklikes->status = $status ;
        }else{
            $talklikes = new Talklikes();
            $talklikes->user_id = Auth::user()->id;
            $talklikes->talks_id = $talk->id;
            $talklikes->status = $status;
        }
        $talklikes->save();


        alert()->success(trans('website.Thank you! Your request was successfully submitted!'), trans('website.Success'));

        return redirect()->back();
    
    }

    public function likeAjax($talkID ,$status){

        $talk = $this->model->findOrFail($talkID);
        $talklikes = Talklikes::where('user_id',Auth::user()->id)->where('talks_id',$talk->id)->first();

        if($talklikes){
            $talklikes->status = $status ;
        }else{
            $talklikes = new Talklikes();
            $talklikes->user_id = Auth::user()->id;
            $talklikes->talks_id = $talk->id;
            $talklikes->status = $status;
        }
        $talklikes->save();

        $talkLikes0 = Talklikes::where('talks_id', $talk->id)->where('status', 0)->get()->toArray();
        $talkLikes1 = Talklikes::where('talks_id', $talk->id)->where('status', 1)->get()->toArray();

        return response()->json(['success' => true, 'talkLikes0' => count($talkLikes0), 'talkLikes1' => count($talkLikes1)], 200);

    }

}
