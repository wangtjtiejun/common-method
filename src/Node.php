<?php
/**
 * Created by PhpStorm.
 * User: wangtiejun
 * Date: 2019/10/26
 * Time: 15:09
 */
namespace Wangtiejun;

class Node
{
    public $value;
    public $left;
    public $right;

    // 非递归
    // 前序遍历 根节点→左子树→右子树
    // 先访问根节点，再遍历左子树，最后遍历右子树；并且在遍历左右子树时，仍需先遍历根节点，然后访问左子树，最后遍历右子树
    public function preOrder($root) {
        $stack = array();
        array_push($stack, $root);
        while (!empty($stack)) {
            $center_node = array_pop($stack);
            echo $center_node->value . "  "; // 先输出根节点
            if ($center_node->right != null) {
                array_push($stack, $center_node->right); // 压入左子树
            }
            if ($center_node->left != null) {
                array_push($stack, $center_node->left);
            }
        }
    }

    // 递归
    // 前序遍历
    public function pre_order($root) {
        if ($root != null) {
            echo $root->value . " ";        // 根
            if ($root->left != null) {
                $this->pre_order($root->left);     //递归遍历左树
            }
            if ($root->right != null) {
                $this->pre_order($root->right);    //递归遍历右树
            }
        }
    }

    // 非递归
    // 中序遍历
    // 左子树→根节点→右子树
    public function inOrder($root) {
        $stack = array();
        $current_node = $root;
        while (!empty($stack) || $current_node != null) {
            while ($current_node != null) {
                array_push($stack, $current_node);
                $current_node = $current_node->left;
            }
            $current_node = array_pop($stack);
            echo $current_node->value . " ";
            $current_node = $current_node->right;
        }
    }

    // 递归
    // 中序遍历
    public function in_order($root) {
        if ($root != null) {
            if ($root->left != null) {
                $this->in_order($root->left);  // 递归遍历左树
            }
            echo $root->value . " ";
            if ($root->right != null) {
                $this->in_order($root->right); // 递归遍历右树
            }
        }
    }

    // 非递归
    // 后序遍历 左子树→右子树→根节点
    // 先遍历左子树，然后遍历右子树，最后访问根节点；同样，在遍历左右子树的时候同样要先遍历左子树，然后遍历右子树，最后访问根节点
    public function postOrder($root) {
        $stack = array();
        $out_stack = array();
        array_push($stack, $root);
        while (!empty($stack)) {
            $center_node = array_pop($stack);
            array_push($out_stack, $center_node); // 最先压入根节点，最后输出
            if ($center_node->left != null) {
                array_push($stack, $center_node->left);
            }
            if ($center_node->right != null) {
                array_push($stack, $center_node->right);
            }
        }
        while (!empty($out_stack)) {
            $center_node = array_pop($out_stack);
            echo $center_node->value . "  ";
        }
    }

    // 递归
    // 后序遍历
    public function post_order($root) {
        if ($root != null) {
            if ($root->left != null) {
                $this->post_order($root->left);  // 递归遍历左树
            }
            if ($root->right != null) {
                $this->post_order($root->right); // 递归遍历右树
            }
            echo $root->value . " ";    // 根
        }
    }

    // PHP用递归、非递归方式实现广度优先遍历二叉树
    // 非递归
    public function levelOrder($root) {
        if ($root == null) {
            return;
        }
        $node = $root;
        $queue = array();
        array_push($queue, $node);  // 根节点入队
        while (!empty($queue)) {    // 持续输出节点，直到队列为空
            $node = array_shift($queue);    // 队首元素出队
            echo $node->value . " ";
            // 左节点先入队
            if ($node->left != null) {
                array_push($queue, $node->left);
            }
            // 然后右节点入队
            if ($node->right != null) {
                array_push($queue, $node->right);
            }
        }
    }

    // 递归
    // 获取树的层数（最大深度）
    function getDepth($root) {
        if ($root == null) { // 节点为空
            return 0;
        }
        if ($root->left == null && $root->right == null) { // 只有根节点
            return 1;
        }

        $left_depth = $this->getDepth($root->left);
        $right_depth = $this->getDepth($root->right);

        return ($left_depth > $right_depth ? $left_depth : $right_depth) + 1;
//        return $left_depth > $right_depth ? ($left_depth + 1) : ($right_depth + 1);
    }

    public function level_order($root) {
        // 空树或层级不合理
        $depth = $this->getDepth($root);
        if ($root == null || $depth < 1) {
            return;
        }
        for ($i = 1; $i <= $depth; $i++) {
            $this->printTree($root, $i);
        }
    }

    public function printTree($root, $level) {
        // 空树或层级不合理
        if ($root == null || $level < 1) {
            return;
        }
        if ($level == 1) {
            echo $root->value;
        }
        $this->printTree($root->left, $level - 1);
        $this->printTree($root->right, $level - 1);
    }
}