@extends('admin.main')

@section('head')
    <script src="/ckeditor5-build-classic/ckeditor.js"></script>
@endsection

@section('content')
<form action="" method="post">
        @csrf
        <div class="card-body">
            <div class="form-group">
                <label for="menu">Tên danh mục</label>
                <input type="text" name="name" value="{{ $menu->name }}" class="form-control" placeholder="Nhập tên danh mục">
            </div> 

            <div class="form-group">
                <label for="">Danh mục</label>
                <select class="form-control" name="parent_id">
                    <option value="0"  {{$menu ->parent_id === 0 ? 'selected':''}} >Danh mục cha</option>
                    @foreach ($menus as $menuParent)
                    <option value=" {{$menuParent->id}} 
                        {{$menu ->parent_id === $menuParent->id ? 'selected':''}} "> {{ $menuParent->name}}</option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <label for="">Mô tả</label>
                <textarea class="form-control" name="description"> {{$menu->description}}</textarea>
            </div>

            <div class="form-group">
                <label for="">Mô tả chi tiết</label>
                <textarea class="form-control" name="content" id="content"> {{$menu->content}}</textarea>
            </div>

            <div class="form-group">
                <label for="">Kích hoat</label>
                <div class="custom-control custom-radio">
                    <input class="custom-control-input" type="radio" value="1" id="active" name="active" {{$menu->active == 1 ? 'checked=""': ''}} >
                    <label for="active" class="custom-control-label">Có</label>
                </div>
                <div class="custom-control custom-radio">
                    <input class="custom-control-input" type="radio" value="0" id="no_active" name="active" {{$menu->active == 0 ? 'checked=""': ''}} >
                    <label for="no_active"  class="custom-control-label">Không</label>
                </div>
            </div>

        </div>
        <!-- /.card-body -->

        <div class="card-footer">
            <button type="submit" class="btn btn-primary">Cập nhật danh mục</button>
        </div>
    </form>
@endsection

@section('footer')
    <script>
        ClassicEditor
            .create(document.querySelector('#content'))
            .catch(error => {
                console.error(error);
            });
    </script>
@endsection
