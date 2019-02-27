<?php
// 节点类
Class BTNode                         
{
    public $data;
    public $lChild;
    public $rChild;

    public function __construct($data = null)
    {
        $this->data = $data;
    }
}

Class BinaryTree                   // 二叉树类
{
    public $btData;

    public function __construct($data = null)
    {
        $this->btData = $data;
    }

    public function CreateBT(&$root = null)      //创建二叉树
    {
        $elem = array_shift($this->btData);
        if ($elem == null) {
            return 0;
        } else if ($elem == '#') {
            $root = null;
        } else {
            $root = new BTNode();
            $root->data = $elem;
            $this->CreateBT($root->lChild);
            $this->CreateBT($root->rChild);
        }
        return $root;
    }


    public function PreOrder($root)      //前序遍历二叉树
    {
        if ($root != null) {
            echo $root->data . " ";
            $this->PreOrder($root->lChild);
            $this->PreOrder($root->rChild);

        } else {
            return;
        }
    }


    public function InOrder($root)      //中序遍历二叉树
    {
        if ($root != null) {
            $this->InOrder($root->lChild);
            echo $root->data . " ";
            $this->InOrder($root->rChild);

        } else {
            return;
        }
    }


    public function PosOrder($root)     //后序遍历二叉树
    {
        if ($root != null) {
            $this->PosOrder($root->lChild);
            $this->PosOrder($root->rChild);
            echo $root->data . " ";

        } else {
            return;
        }
    }


    function LeverOrder($root)           //层序遍历二叉树
    {
        $queue = new SplQueue();
        if ($root == null)
            return;
        else
            $queue->enqueue($root);
        while (!$queue->isEmpty()) {
            $node = $queue->bottom();
            $queue->dequeue();
            echo $node->data . " ";
            if ($node->lChild)
                $queue->enqueue($node->lChild);
            if ($node->rChild)
                $queue->enqueue($node->rChild);
        }
    }

}


$data = [1, 2, 4, '#', '#', 5, '#', '#', 3, '#', 6, '#', '#'];


$tree = new BinaryTree($data);

$root = $tree->CreateBT();

var_dump($root);

$tree->PreOrder($root);
echo "<br>";
$tree->InOrder($root);
echo "<br>";
$tree->PosOrder($root);
echo "<br>";
$tree->LeverOrder($root);