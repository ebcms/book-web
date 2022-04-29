<?php
$site = [
    'title' => $book['title'] . ' - ' . $config->get('site.title@ebcms.web'),
    'keywords' => $book['keywords'],
    'description' => $book['description']
];
?>
{include common/header@ebcms/book-web}
<div class="container">
    <div class="row">
        <div class="col-md-3 h-100">
            {include common/navbar@ebcms/book-web}
        </div>
        <div class="col-md-9 content">
            <h1 class="mb-3">{$book.title}</h1>
            <div class="text-muted mb-2 py-1 px-2 bg-primary bg-gradient bg-opacity-10"><small>更新时间：{:date('Y-m-d H:i:s', $book['update_time'])}</small></div>
            {echo $book['body']}
        </div>
    </div>
</div>
{include common/footer@ebcms/book-web}