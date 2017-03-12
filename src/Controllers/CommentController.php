<?php

namespace TestProject\Controllers;


class CommentController extends BaseController
{
    /**
     * Get all comments
     *
     * @return string
     */
    public function actionAll()
    {
        $commentModel = $this->getContainer()->get('commentModel');
        $comments = $commentModel->getAll();

        $ormMapper = $this->getContainer()->get('ormMapper');

        $data = [];
        foreach ($comments as $comment) {
            $data[] = $ormMapper->convertToArray($comment);
        }

        return $this->renderJSON([
            'status' => 'success',
            'data' => $data
        ]);
    }

    /**
     * Create comment
     *
     * @return string
     */
    public function actionInsert()
    {
        $comment = new \stdClass();
        $comment->username = isset($_POST['username']) ? $_POST['username'] : '';
        $comment->body = isset($_POST['body']) ? $_POST['body'] : '';
        $comment->parent_id = isset($_POST['parent_id']) ? intval($_POST['parent_id']) : 0;

        $commentModel = $this->getContainer()->get('commentModel');
        $errors = $commentModel->validate($comment);

        if (count($errors) > 0) {
            return $this->renderJSON([
                'status' => 'fail',
                'errors' => $errors
            ]);
        }

        $id = $commentModel->insert($comment);

        if ($id === false) {
            return $this->renderJSON([
                'status' => 'fail',
                'errors' => 'Comment can not be inserted'
            ]);
        }

        return $this->renderJSON([
            'status' => 'success',
            'data' => $id
        ]);
    }

    /**
     * Update comment
     *
     * @return string
     */
    public function actionUpdate()
    {
        $id = isset($_REQUEST['id']) ? $_REQUEST['id'] : null;

        if ($id === null) {
            return $this->renderJSON([
                'status' => 'fail',
                'error' => 'Id is not provided'
            ]);
        }

        $commentModel = $this->getContainer()->get('commentModel');
        $comment = $commentModel->getById($id);

        if (!$comment) {
            return $this->renderJSON([
                'status' => 'fail',
                'error' => "Comment with id=$id is not found"
            ]);
        }

        $comment->body = isset($_POST['body']) ? $_POST['body'] : '';
        $errors = $commentModel->validate($comment);

        if (count($errors) > 0) {
            return $this->renderJSON([
                'status' => 'fail',
                'errors' => $errors
            ]);
        }

        $result = $commentModel->update($comment);

        if ($result === false) {
            return $this->renderJSON([
                'status' => 'fail',
                'errors' => 'Comment can not be inserted'
            ]);
        }

        return $this->renderJSON([
            'status' => 'success'
        ]);
    }

    /**
     * Delete comment
     *
     * @return string
     */
    public function actionDelete()
    {
        $id = isset($_POST['id']) ? $_POST['id'] : null;

        if ($id === null) {
            return $this->renderJSON([
                'status' => 'fail',
                'errors' => 'Please, provide id of comment'
            ]);
        }

        $commentModel = $this->getContainer()->get('commentModel');
        $res = $commentModel->delete($id);

        if ($res === false) {
            return $this->renderJSON([
                'status' => 'fail',
                'errors' => 'Comment can not be deleted'
            ]);
        }

        return $this->renderJSON([
            'status' => 'success'
        ]);
    }
}