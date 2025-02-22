<?php
require_once '../admin/model/Comment.php';

class commentController {
    public $comment;
    public function __construct() {
        $this->comment = new Comment();
    }
    public function listCommentsController() {
        $comments = $this->comment->listCommentsModel();
        require_once '../admin/view/pagines/comment/listComments.php';
    }
}
