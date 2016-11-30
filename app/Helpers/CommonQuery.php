<?php 
namespace App\Helpers;

use DB;

class CommonQuery
{
    static function getAllWithStatus($table, $status = ACTIVE, $orderByPosition = null)
    {
        $data = DB::table($table)->where('status', $status);
        //if has softdelete
        // if(in_array($table, ['posts'])) {
        //     $data = $data->whereNull('deleted_at');
        // }
        if($orderByPosition != null) {
            $data = $data->orderByRaw(DB::raw("position = '0', position"))->get();
        } else {
            $data = $data->get();
        }
        if(count($data) > 0) {
            return $data;
        }
        return null;
    }
    static function getArrayWithStatus($table, $status = ACTIVE)
    {
        $data = DB::table($table)->where('status', $status);
        //if has softdelete
        // if(in_array($table, ['posts'])) {
        //     $data = $data->whereNull('deleted_at');
        // }
        $data = $data->pluck('name', 'id');
        if(count($data) > 0) {
            return $data;
        }
        return null;
    }
    static function getFieldById($table, $id, $field, $fieldIsNumber = null)
    {
        $data = DB::table($table)->where('id', $id);
        //if has softdelete
        // if(in_array($table, ['posts'])) {
        //     $data = $data->whereNull('deleted_at');
        // }
        $data = $data->first();
        if($data) {
            return $data->$field;
        }
        if(isset($fieldIsNumber)) {
            return 0;
        }
        return '';
    }
    static function getAdByPosition($position=null)
    {
        if($position == null) {
            return '';
        }
        $data = DB::table('ads')
            ->where('position', $position)
            ->where('status', ACTIVE)
            ->first();
        if($data) {
            return '<div class="row column"><div class="gooo">'.$data->code.'</div></div>';
        }
        return '';
    }
    static function getArrayParentZero($table, $currentId=0)
    {
        $data = DB::table($table)
            ->select('id', 'name', 'parent_id')
            ->where('status', ACTIVE)
            ->where('parent_id', 0)
            ->where('id', '!=', $currentId);
        //if has softdelete
        // if(in_array($table, ['posts'])) {
        //     $data = $data->whereNull('deleted_at');
        // }
        $data = $data->pluck('name', 'id');
        $firstValue = ($currentId!=0)?0:'';
        return array_add($data, $firstValue, '-- Chọn');
    }
    static function getArrayWithParent($table, $currentId=0)
    {
        $data = DB::table($table)
            ->select('id', 'name', 'parent_id')
            ->where('status', ACTIVE)
            ->where('id', '!=', $currentId);
        //if has softdelete
        // if(in_array($table, ['posts'])) {
        //     $data = $data->whereNull('deleted_at');
        // }
        $data = $data->get();
        $firstValue = ($currentId!=0)?0:'';
        $output = self::_visit($data);
        return array_add($output, $firstValue, '-- Chọn');
    }
    static function _visit($data, $parentId=0, $prefix='')
    {
        $output = [];
        $current = self::_current($data, $parentId);
        $sub = self::_sub($data, $parentId);
        if(isset($current)) {
            $output[$current->id] = $prefix . $current->name;
            $prefix .= '-- ';
        }
        if(count($sub) > 0) {
            foreach($sub as $value) {
                $o = self::_visit($data, $value->id, $prefix);
                foreach($o as $k => $v) {
                    $output[$k] = $v;
                }
            }
        }
        return $output;
    }
    private static function _current($data, $parentId)
    {
        if(isset($data)) {
            foreach($data as $value) {
                if ($value->id == $parentId) {return $value;}
            }
        }
        return null;
    }
    private static function _sub($data, $parentId)
    {
        $sub = array();
        if(isset($data)) {
            foreach($data as $key => $value) {
                if ($value->parent_id == $parentId) {$sub[$key] = $value;}
            }
        }
        return $sub;
    }

}