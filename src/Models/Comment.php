<?php

namespace TestProject\Models;


class Comment extends BaseModel
{
    /**
     * Load all comments
     *
     * @return array
     */
    public function getAll()
    {
        $comments = $this->getOrmManager()->fetchAll('SELECT * FROM comments');
        return $comments;
    }

    /**
     * Update comment
     *
     * @param $comment
     * @return mixed
     */
    public function update($comment)
    {
        $result = $this->getOrmManager()->execute('
              UPDATE comments  
              SET body=:body, updated_at=NOW()
              WHERE id=:id
            ',
            [
                'id' => $comment->id,
                'body' => $comment->body
            ]
        );
        return $result;
    }

    /**
     * Delete comment
     *
     * @param int $id
     * @return mixed
     */
    public function delete($id)
    {
        $result = $this->getOrmManager()->execute('DELETE FROM comments WHERE id=:id', ['id' => $id]);
        return $result;
    }

    /**
     * Get comment by id
     *
     * @param integer $id
     * @return mixed
     */
    public function getById($id)
    {
        $result = $this->getOrmManager()->fetch('SELECT * FROM comments WHERE id=:id', ['id' => $id]);
        return $result;
    }

    /**
     * Create new comment
     *
     * @param $comment
     * @return mixed
     */
    public function insert($comment)
    {
        $result = $this->getOrmManager()->execute(
            'INSERT INTO comments(username, body, parent_id) VALUES(:username, :body, :parent_id);',
            [
                'username' =>$comment->username,
                'body' => $comment->body,
                'parent_id' => $comment->parent_id
            ]
        );

        if (!$result) {
            return false;
        }

        $id = $this->getOrmManager()->getLastInsertId();
        $comment->id = $id;
        return $id;
    }

    /**
     * Validate comment
     *
     * @param $comment
     * @return array
     */
    public function validate($comment)
    {
        $errors = [];

        if (empty($comment->body)) {
            $errors[] = 'Body can not be empty';
        }
        // some extra validation here

        return $errors;
    }


}