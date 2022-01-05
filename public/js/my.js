$(document).ready(function (){
    let url = location.origin;

    function showPostHtml(res) {
        let posts = res.data;
        let html = "";
        for (let i = 0; i < posts.length; i++) {
            html += "<tr>";
            html += "<td>";
            html += '<input type="checkbox" class="checkbox-delete-posts" name="checkbox-delete-posts[]" value="' + posts[i].id + '">';
            html += "</td>";
            html += "<td>";
            html += posts[i].title
            html += "</td>";
            html += "<td>";
            html += '<img width="100" src="' + origin + '/storage/' + posts[i].image + '">'
            html += "</td>";
            html += "<td>";
            html += posts[i].created_at
            html += "</td>";
            html += "</tr>";
        }
        $('#list-post').html(html)
    }

    function getListPosts() {
        $.ajax({
            url: url + "/admin/posts/list",
            method: "GET",
            type: 'json',
            success: function (res) {
                showPostHtml(res);
            }
        })
    }

    getListPosts();

    $('#delete-post').click(function (){
        let inputChecked = $('.checkbox-delete-posts');
        let idPostDelete = []
        inputChecked.each(function (){
            if (this.checked) {
                idPostDelete.push(this.value)
            }
        });

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $.ajax({
            url: url + "/admin/posts/delete.html",
            method: "POST",
            type: 'json',
            data: {
                idPost: idPostDelete
            },
            success: function (res) {
                getListPosts();
            },
            error: function () {

            }
        })

    })

    $('#search-post').keyup(function () {
        let keyword = $(this).val();
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $.ajax({
            url: url + "/admin/posts/search.html",
            method: "POST",
            type: 'json',
            data: {
                keyword: keyword
            },
            success: function (res) {
                showPostHtml(res)
            }
        })
    })

})
