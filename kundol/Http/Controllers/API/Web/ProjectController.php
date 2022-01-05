<?php

namespace App\Http\Controllers\API\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Web\Project;
use App\Models\Web\ProjectProduct;
use App\Models\Web\ProjectProductTag;

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

    public function getProjects(){
        $projects = [];
        $parents = Project::where('is_active', 1)->where("parent_id", 0)->get();

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
            $data['products'] = ProjectProduct::where("project_id", $p->id)->with('product')->with('tags')->get();
            $secondLevel = Project::where('is_active', 1)->where("parent_id", $p->id)->get();
            foreach($secondLevel as $sk => $sp){
                $schild = [
                    'project' => $sp,
                    'children' => [],
                    'products' => []
                ];
                $schild['products'] = ProjectProduct::where("project_id", $sp->id)->with('product')->with('tags')->get();
                $lastLevel = Project::where("is_active", 1)->where("parent_id", $sp->id) -> get();
                foreach($lastLevel as $lk => $lp){
                    $lchild = [
                        'project' => $lp,
                        'children' => [],
                        'products' => []
                    ];
                    $lchild['products'] = ProjectProduct::where("project_id", $lp->id)->with('product')->with('tags')->get();
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
            'tags' => 'required'
        ]);

        $data = [
            'product_id' => $request->product_id,
            'project_id' => $request->project_id,
        ];

        $m = ProjectProduct::create($data);

        $tags = $request->tags;
        
        foreach($tags as $tag){
            ProjectProductTag::create([
                'project_product_id' => $m->id,
                "tag" => $tag
            ]);
        }

        return response()->json(["status" => "success"], 200);
    }

    public function removeProductFromProject(Request $request){

        $pid = $request->projectProductId;

        ProjectProductTag::where('project_product_id', $pid)->delete();
        ProjectProduct::find($pid)->delete();

        return response()->json(['status' => 'success'], 200);

    }

}
