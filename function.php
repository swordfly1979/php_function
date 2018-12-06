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
/**
 * 对查询结果集进行排序
 * @access public
 * @param array $list 查询结果
 * @param string $field 排序的字段名
 * @param array $sortby 排序类型
 * asc正向排序 desc逆向排序 nat自然排序
 * @return array
 */
function tree_to_list($tree, $child = '_child', &$list = array()) {
  if (is_array($tree)) {
      foreach ($tree as $key => $value) {
          $refer = $value;
          if($refer[$child]){
              unset($refer[$child]);
          }
          $list[] = $refer;
          if (isset($value[$child])) {
              tree_to_list($value[$child], $child,$list);
          }
      }
  }
  return $list;
}