<?php

namespace App\Helpers;

class Helper
{
    public static function menu($menus, $parent_id = 0, $char = '')
    {
        $html = '';
        foreach ($menus as $key => $menu) {
            if (is_object($menu)) {
                if ($menu->parent_id == $parent_id) {
                    $html .= '
                <tr>
                    <td>' . $menu->id . '</td>
                    <td>' . $char.$menu->name . '</td>
                    <td>' . self::active($menu->active) . '</td>
                    <td>' . $menu->updated_at . '</td>
                    <td>
                    <a href="/admin/menus/edit/' . $menu->id . '" class="btn btn-primary btn-sm"><i class="fas fa-edit"></i></a>
                    <a href="#" class="btn btn-danger btn-sm" onclick="removeRow(' . $menu->id . ',\'/admin/menus/destroy\')"><i class="fa fa-trash" aria-hidden="true"></i></a>
                    </td>
                </tr>';

                    unset($menus[$key]);
                    $html .= self::menu($menus, $menu->id, $char . '--');
                }
            }
        }

        return $html;
    }
    public static function active($active = 0): string{
        
        return $active == 0 ? '<span class="btn btn-danger btn-xs">NO</span>': '<span class="btn btn-success btn-xs">YES</span>';
}
    public static function menus($data,$parent_id=0){
        dd(1);
    }
}
