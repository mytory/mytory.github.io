function loadComments(data) {
    for (var i = 0; i < data.length; i++) {
        var cuser = data[i].user.login;
        var cuserlink = data[i].user.html_url;
        var clink = data[i].html_url;
        var cbody = data[i].body_html;
        var cavatarlink = data[i].user.avatar_url;
        var cdate = new Date(data[i].created_at);
        $("#comments").append(
            "<div class='comment'>" +
            "<div class='comment__header'>" +
            '<img class="comment_img" src="' + cavatarlink + '" alt="" width="50" height="50">' +
            "<a class='comment__username' href=\"" + cuserlink + "\">" +
            cuser +
            "</a>" +
            "<a class='comment__date' href=\"" + clink + "\">" +
            cdate.toLocaleDateString("ko") +
            "</a>" +
            "</div>" +
            "<div class='comment__body'>" +
            cbody +
            "</div>" +
            "</div>"
        );
    }
}

var issueId = $('[data-comment-issue-id]').data('comment-issue-id');

if (issueId) {
    $.ajax("https://api.github.com/repos/mytory/marx/issues/" + issueId + "/comments", {
        headers: {Accept: "application/vnd.github.v3.html+json"},
        dataType: "json",
        success: function (msg) {
            loadComments(msg);
        }
    });
}