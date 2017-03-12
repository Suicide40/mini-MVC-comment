$('#comments-container').comments({
    enableUpvoting: false,
    currentUserIsAdmin: true,
    enableNavigation: false,
    fieldMappings: {
        id: 'id',
        parent: 'parent_id',
        created: 'created_at',
        modified: 'updated_at',
        content: 'body',
        creator: 'creator',
        fullname: 'username'
    },
    getComments: function(success, error) {
        $.ajax({
            url: "/api/comments/all",
            dataType:'json'
        }).done(function(data) {
            var items = data.data;
            items.forEach(function(part, index) {
                if (items[index]['parent_id'] == "0") {
                    items[index]['parent_id'] = null;
                }
            });
            success(data.data);
        }).error(function() {
            error();
        });
    },

    postComment: function(commentJSON, success, error) {
        $.ajax({
            type: 'post',
            url: '/api/comments/insert',
            dataType:'json',
            data: commentJSON,
            success: function(response) {
                commentJSON.id = response.data;
                success(commentJSON);
            },
            error: error
        });
    },

    deleteComment: function(commentJSON, success, error) {
        $.ajax({
            type: 'post',
            url: '/api/comments/delete',
            dataType:'json',
            data: commentJSON,
            success: function(comment) {
                success(commentJSON);
            },
            error: error
        });
    },

    putComment: function(commentJSON, success, error) {
        $.ajax({
            type: 'post',
            url: '/api/comments/update',
            dataType:'json',
            data: commentJSON,
            success: function() {
                success(commentJSON)
            },
            error: error
        });
    }
});