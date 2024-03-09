<?php
namespace App\Http\Services\Menu;

use App\Models\menu;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;
class MenuService {
    public function getParent(){
            return Menu::where('parent_id',0)->get();
    }
    public function getAll(){
       
        return Menu::orderbyDesc('id')->paginate(20);
    }
    public function create($request){
        
        try {
            Menu::create([
                'name'=>(string) $request->input('name'),
                'parent_id'=>(int) $request->input('parent_id'),
                'description'=>(string) $request->input('description'),
                'content'=>(string) $request->input('content'),
                'active'=>(string) $request->input('active'),
            ]);
            Session::flash('success','Tạo danh mục thành công');
        } catch (\Throwable $th) {
            //throw $th;
            Session::flash('error',$th->getMessage());
            return false;
        }
        return true;
    }
    public function destroy($request){
        
        $id = (int) $request->input('id');

        $menu = Menu::where( 'id' , $id )->first();

        if($menu){
            return Menu::where('id', $id)->orWhere('parent_id', $id)->delete();
        }
        return false;
    }
    public function update($request,$menu):bool{
        // $menu->fill($request->input());
        if($request->parent_id !== $menu->id){
            $menu->parent_id=(int) $request->input('parent_id');
        }

        $menu->name=(string) $request->input('name');
        $menu->description=(string) $request->input('description');
        $menu->content=(string) $request->input('content');
        $menu->active=(string) $request->input('active');
        $menu->save();

        Session::flash('success','Cập nhât danh mục thành công');
        return true;
    }
}
 ?>