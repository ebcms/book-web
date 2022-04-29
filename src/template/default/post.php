<?php
$site = [
    'title' => $post['title'] . ' - ' . $book['title'] . ' - ' . $config->get('site.title@ebcms.web'),
    'keywords' => $post['keywords'],
    'description' => $post['description']
];
?>
{include common/header@ebcms/book-web}
<script>
    $(function() {
        $.each($("a"), function(indexInArray, valueOfElement) {
            if ($(this).data('postid') == '{$post.id}') {
                $(this).removeClass("text-secondary").addClass("text-primary").parents("details").attr("open", "open");
            }
        });
    });
</script>
<div class="container">
    <div class="row">
        <div class="col-md-3 h-100">
            {include common/navbar@ebcms/book-web}
        </div>
        <div class="col-md-9 content">
            <h1 class="mb-3">{$post.title}</h1>
            <div class="text-muted mb-2 py-1 px-2 bg-primary bg-gradient bg-opacity-10"><small>最近更新：{:date('Y-m-d H:i:s', $post['update_time'])}</small></div>
            {echo $post['body']}
        </div>
    </div>
</div>
{include common/footer@ebcms/book-web}