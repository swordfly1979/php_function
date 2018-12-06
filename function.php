<?php
/*
 * 把返回的数据集转换成Tree
 * @param array $list 要转换的数据集
 * @param string $pk 数组主键
 * @param string $pid 父id名
 * @param string $child 子数组键名
 * @return array
 * @author 道法自然
 */
    function list_to_tree($list = '', $pk = 'id', $pid = 'pid', $child = '_child', $root = 0)
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