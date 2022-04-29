<?php
$site = [
    'title' => '搜索 - ' . $book['title'] . ' - ' . $config->get('site.title@ebcms.web')
];
?>
{include common/header@ebcms/book-web}
<div class="container">
    <div class="row">
        <div class="col-md-3 h-100">
            {include common/navbar@ebcms/book-web}
        </div>
        <div class="col-md-9">
            {foreach $posts as $vo}
            <div class="card my-2">
                <div class="card-body">
                    <h5 class="card-title">
                        <?php
                        $vo['title'] = str_ireplace(htmlspecialchars($request->get('q')), '<strong><font color="#f00">' . htmlspecialchars($request->get('q')) . '</font></strong>', htmlspecialchars($vo['title']));
                        ?>
                        <a class="text-decoration-none stretched-link" href="{echo $router->build('/ebcms/book-web/post', ['book_id'=>$vo['book_id'], 'id'=>$vo['id']])}">{echo $vo['title']}</a>
                    </h5>
                    <div class="text-muted text-monospace">
                        <?php
                        $vo['body'] = str_ireplace(htmlspecialchars($request->get('q')), '<strong><font color="#f00">' . htmlspecialchars($request->get('q')) . '</font></strong>', htmlspecialchars($vo['body']));
                        ?>
                        {echo $vo['body']}
                    </div>
                </div>
            </div>
            {/foreach}
        </div>
    </div>
</div>
{include common/footer@ebcms/book-web}