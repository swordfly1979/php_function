<?php
    protected function list_to_tree($list = '', $pk = 'id', $pid = 'pid', $child = '_child', $root = 0)
    {
        $list = array_combine(array_column($list, $pk), $list);
        $tree = [];
        foreach ($list as $key => $val) {
            if ($val[$pid] == $root) {
                $tree[] =  & $list[$key];
            } else {
                if ($list[$val[$pid]]) {
                    $list[$val[$pid]][$child][] = $list[$key];
                }
            }
        }
        return $tree;
    }