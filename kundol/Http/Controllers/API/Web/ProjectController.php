<?php

namespace App\Http\Controllers\API\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Web\Project;
use App\Models\Web\ProjectProduct;
use App\Models\Web\ProjectProductTag;
use App\Models\Web\ProjectShare;
use App\Models\Admin\ProjectTag;
use Illuminate\Support\Str;
use Illuminate\Datebase\Eloquent\Builder;

class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
        //
        if(!auth()->user()){
            return response()->json(['status'=>'error', "code" => 'auth_error', 200]);
        }

        $request->validate([
            'title' => 'string|required',
            "parent_id" => 'numeric|required',
            'expire_at' => 'date|required'
        ]);

        $data = [
            'title' => $request->title,
            'parent_id' => $request->parent_id,
            'expired_at' => $request->expire_at,
            'user_id' => auth()->user()->id
        ];

        Project::create($data);

        return response()->json(['status' =>'success'], 200);

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    private function getChildren($parent_id, $target = []){
        $projects = Project::where("is_active", 1)->where("parent_id", $parent_id)->get()->toArray();
        if(count($projects) === 0){
            return $target;
        }

        foreach($projects as $key => $project){
            $data = [
                'project' => $project,
                'children' => []
            ];
            $target[$key] = $data;
            $this->getChildren($project['id'], $target[$key]['children']);
        }
    }

    public function getProjects(Request $request){
        $customerId = $request->customerId;
        $projects = [];
        $parents = Project::where('is_active', 1)->where("user_id", $customerId)->where("parent_id", 0)->get();

        foreach($parents as $key => $p){
            $data = [
                'project' => $p,
                'children' => []
            ];
            $secondLevel = Project::where('is_active', 1)->where("parent_id", $p->id)->get();
            foreach($secondLevel as $sk => $sp){
                $schild = [
                    'project' => $sp,
                    'children' => []
                ];
                $lastLevel = Project::where("is_active", 1)->where("parent_id", $sp->id) -> get();
                foreach($lastLevel as $lk => $lp){
                    $lchild = [
                        'project' => $lp,
                        'children' => []
                    ];
                    $schild['children'][] = $lchild;
                }

                $data['children'][] = $schild;
            }

            $projects[] = $data;
        }

        return response()->json(['projects' => $projects, "status" => "success"], 200);
    }

    public function getProjectsWithProducts(Request $request, $customerId){

        $projects = [];
        $parents = Project::where('is_active', 1)->where("parent_id", 0)->where("user_id", $customerId)->get();

        foreach($parents as $key => $p){
            $data = [
                'project' => $p,
                'children' => [],
                'products' => []
            ];
            $data['products'] = ProjectProduct::where("project_id", $p->id)->where("active", 1)->with('product')->with('tags')->get();
            $secondLevel = Project::where('is_active', 1)->where("parent_id", $p->id)->get();
            foreach($secondLevel as $sk => $sp){
                $schild = [
                    'project' => $sp,
                    'children' => [],
                    'products' => []
                ];
                $schild['products'] = ProjectProduct::where("project_id", $sp->id)->where("active", 1)->with('product')->with('tags')->get();
                $lastLevel = Project::where("is_active", 1)->where("parent_id", $sp->id) -> get();
                foreach($lastLevel as $lk => $lp){
                    $lchild = [
                        'project' => $lp,
                        'children' => [],
                        'products' => []
                    ];
                    $lchild['products'] = ProjectProduct::where("project_id", $lp->id)->where("active", 1)->with('product')->with('tags')->get();
                    $schild['children'][] = $lchild;
                }

                $data['children'][] = $schild;
            }

            $projects[] = $data;
        }

        return response()->json(['data' => $projects], 200);
    }

    public function addProductToProject(Request $request){

        $request->validate([
            'project_id' => 'required',
            'product_id' => 'required',
        ]);

        $data = [
            'product_id' => $request->product_id,
            'project_id' => $request->project_id,
        ];

        $m = ProjectProduct::create($data);

        $tags = $request->tags;
        if(!$tags){
            $tags = [];
        }
        $newTag = [];
        foreach($tags as $tag){
            ProjectProductTag::create([
                'project_product_id' => $m->id,
                "tag" => $tag
            ]);
            $newTag[] = ['title' => $tag, 'is_active' => 1]; 
        }

        ProjectTag::insertOrIgnore($newTag);

        return response()->json(["status" => "success"], 200);
    }

    public function removeProductFromProject(Request $request){

        $pid = $request->projectProductId;

        // ProjectProductTag::where('project_product_id', $pid)->update(['active']);
        $product = ProjectProduct::find($pid);
        $product->active = 0;
        $product->save();

        return response()->json(['status' => 'success'], 200);

    }

    public function removeProject(Request $request){
        $id = $request->project_id;
        $project = Project::find($id);
        $project->is_active = 0;
        $project->save();
        return response()->json(['status' => 'success'], 200);
    }

    public function updateTree(Request $request){
        // die(print_r($request->data));
        $data = $request->data;
        foreach($data as $item){
            $parent_id = isset($item['parentId']) ? $item['parentId'] : 0;
            $id = $item['id'];
            if($item['value'] === "project") {
                $project = Project::find($id);
                $project->parent_id = $parent_id;
                $project->save();
            } else if($item['value'] === "product" && $parent_id !== 0){
                $product = ProjectProduct::find($id);
                $product->project_id = $parent_id;
                $product->save();
            }
        }
        return response()->json(['status' => "success"], 200);
    }

    public function shareProject(Request $request){

        $project_id = $request->project_id;
        $code = Str::random(23);

        $share = new ProjectShare;

        $share->project_id = $project_id;
        $share->code = $code;
        $share->expired_at = Date("y-m-d", strtotime('+30 days'));

        $share->save();

        return response()->json(['code' => $code, 'status' => "success"], 200);

    }

    public function getRecylebinItems(Request $request, $customerId){
        // get removed project
        $projects = Project::where('user_id', $customerId)->where("is_active", 0)->with('parent')->orderBy("updated_at")->get()->toArray();
        $products = ProjectProduct::where("active", 0)->with('project')->with('product')
                        ->whereHas('project', function ($query) use ($customerId)
                        {
                            $query->where('user_id', $customerId);                           
                        })->orderBy('updated_at')->get()->toArray();
        
        $projectItems = [];
        $productItems = [];
        foreach($projects as $project){
            $data = [
                'type' => 'project',
                'title' => $project['title'],
                'parentTitle' => $project['parent']['title'],
                'parent_id' => $project['parent_id'],
                'id' => $project['id'],
                'image' => '',
                'updated_at' => $project['updated_at']
            ];

            $projectItems[] = $data;
        }

        foreach($products as $product){
            $data = [
                'type' => 'product',
                'title' => $product['product']['detail'][0]['title'],
                'parentTitle' => $product['project']['title'],
                'parent_id' => $product['project']['id'],
                'id' => $product['id'],
                'image' => $product['product']['gallary']['detail'][0]['path'],
                'updated_at' => $product['updated_at'],
                "product" => $product['product']
            ];

            $productItems[] = $data;
        }

        
        $items = array_merge($projectItems, $productItems);

        usort($items, function($a, $b){
            return $a['updated_at'] > $b['updated_at'];
        });

        return response()->json(['items' => $items], 200);
    }

    public function restoreItemRecylebin(Request $request){
        $type = $request->type;
        $id = $request->id;

        if($type == "project"){
            $project = Project::find($id);
            $project->is_active = 1;
            $project->save();
        } else if( $type == 'product'){
            $product = ProjectProduct::find($id);
            $product->active = 1;
            $product->save();
        }
        return response()->json(['status' => 'success'], 200);
    }

    public function deleteItemRecylebin( Request $request){
        $type = $request->type;
        $id = $request->id;

        if($type == "project"){
            $project = Project::find($id);
            $project->delete();
        } else if( $type == 'product'){
            $product = ProjectProduct::find($id);
            $product->delete();
        }
        return response()->json(['status' => 'success'], 200);
    }

    public function getTags($id){
        $tags = ProjectProductTag::where("project_product_id", $id)->get();
        return response()->json(['status' => 'success', 'tags' => $tags], 200);
    }

    public function updateTags(Request $request, $id){
        $tags = $request->tags;
        if(count($tags) === 0) {
            return response()->json(['status' => 'error'], 500);
        }

        ProjectProductTag::where("project_product_id", $id)->delete();
        $newTags = [];
        foreach($tags as $tag){
            ProjectProductTag::create([
                'project_product_id' => $id,
                'tag' => $tag        
            ]);

            $newTags[] = ['title' => $tag, 'is_active' => 1];
        }

        ProjectTag::insertOrIgnore($newTags);

        return response()->json(['status' => 'success'], 200);

    }

    public function getAllTags(Request $request){
        $tags = ProjectTag::where("is_active", 1)->get();
        return response()->json(['tags' => $tags], 200);
    }

    public function cloneProduct(Request $request, $id){

        $request->validate([
            'project' => 'required|string'
        ]);
        $new_project_id = $request->project;

        $product = ProjectProduct::find($id);

        $newRecord = new ProjectProduct;
        $newRecord->product_id = $product->product_id;
        $newRecord->project_id = $new_project_id;
        $newRecord->active = $product->active;

        $newRecord->save();

        $tags = ProjectProductTag::where("project_product_id", $product->id)->get();

        foreach($tags as $tag){
            ProjectProductTag::create([
                'project_product_id' => $newRecord->id,
                'tag' => $tag->tag
            ]);
        }

        return response()->json(['status' => 'success', "id" => $newRecord->id], 200);

    }

}
