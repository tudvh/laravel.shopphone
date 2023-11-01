const _token = $('input[name="_token"]').val();
const userID = $('input[name="user-id"]').val();

function showElement(element) {
    element.removeClass("hidden");
}

function hideElement(element) {
    element.addClass("hidden");
}

// Comment
const commentWriteElement = $(".write-comment textarea");
const sendComment = $(".write-comment button");
const commentViewElement = $(".view-comment");
const iconSpinner = $(".icon-spinner");

sendComment.click(function () {
    if (userID) {
        showElement(iconSpinner);

        $.ajax({
            url: `${rootUrl}/comment/create`,
            type: "POST",
            data: {
                _token,
                user_id: userID,
                product_id: productID,
                content: commentWriteElement.val(),
            },
            success: (response) => {
                setTimeout(() => {
                    hideElement(iconSpinner);
                    commentViewElement.html(response);
                    commentWriteElement.val("");
                    declareVariable();
                }, 1000);
            },
            error: console.log,
        });
    } else {
        alert("Vui lòng đăng nhập");
    }
});

declareVariable();

function declareVariable() {
    // Comment reply
    const listCommentParent = commentViewElement.find(".comment-parent");

    listCommentParent.each(function () {
        const commentParent = $(this);

        const commentID = commentParent.data("commentid");
        const iconSpinnerReply = commentParent.find(".icon-spinner-reply");
        const btnShowReply = commentParent.find(".btn-show-reply");
        const commentWriteReplyWrapper = commentParent.find(
            ".write-comment-reply"
        );
        const commentWriteReplyContent =
            commentWriteReplyWrapper.find("textarea");
        const sendCommentReply = commentWriteReplyWrapper.find("button");

        btnShowReply.click(function (e) {
            e.preventDefault();

            showElement(commentWriteReplyWrapper);
        });

        // Add comment reply
        sendCommentReply.click(function () {
            if (userID) {
                showElement(iconSpinnerReply);

                $.ajax({
                    url: `${rootUrl}/comment/create-reply`,
                    type: "POST",
                    data: {
                        _token,
                        user_id: userID,
                        product_id: productID,
                        content: commentWriteReplyContent.val(),
                        reply_id: commentID,
                    },
                    success: (response) => {
                        setTimeout(() => {
                            hideElement(iconSpinnerReply);
                            commentViewElement.html(response);
                            declareVariable();
                        }, 1000);
                    },
                    error: console.log,
                });
            } else {
                alert("Vui lòng đăng nhập");
            }
        });
    });

    // Comment Management
    const listComment = commentViewElement.find(".comment-wrapper");

    listComment.each(function () {
        const comment = $(this);

        const commentID = comment.data("commentid");
        const icon = comment.find(".icon-spinner-item").first();
        const btnDeleteComment = comment
            .find("> div > div > .btn-delete")
            .first();

        // Delete comment
        btnDeleteComment.click(function (e) {
            e.preventDefault();

            if (userID) {
                if (confirm("Bạn có chắc chắn muốn xóa bình luận này không?")) {
                    showElement(icon);

                    $.ajax({
                        url: `${rootUrl}/comment/delete`,
                        type: "POST",
                        data: {
                            _token,
                            id: commentID,
                            user_id: userID,
                            product_id: productID,
                        },
                        success: (response) => {
                            setTimeout(() => {
                                hideElement(icon);

                                if (response == "error") {
                                    alert(
                                        "Có lỗi trong lúc xóa bình luận, vui lòng thử lại sau!"
                                    );
                                } else {
                                    commentViewElement.html(response);
                                    declareVariable();
                                }
                            }, 1000);
                        },
                        error: console.log,
                    });
                }
            } else {
                alert("Vui lòng đăng nhập");
            }
        });
    });
}
