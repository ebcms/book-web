<div class="bg-light py-3 mb-3">
    <div class="px-3 mb-3">
        <form action="{echo $router->build('/ebcms/book-web/search',['book_id'=>$book['id']])}" method="GET">
            <div class="input-group">
                <input type="text" name="q" value="{:$request->get('q')}" class="form-control" psaceholder="请输入搜索词" aria-label="请输入搜索词" aria-describedby="search_btn">
                <button class="btn btn-primary" type="submit" id="search_btn">搜索</button>
            </div>
        </form>
    </div>
    {function mulu($db, $book_id, $pid, $router)}
    <?php
    $datas = $db->select('ebcms_book_post', '*', [
        'book_id' => $book_id,
        'pid' => $pid,
        'state' => 1,
        'ORDER' => [
            'rank' => 'DESC',
            'id' => 'ASC'
        ],
    ]);
    ?>
    <ul class="ps-3 mb-0" style="list-style:none;">
        {if $datas}
        {foreach $datas as $vo}
        <li class="mt-1" style="list-style:none;">
            {if $vo['type'] == 1}
            <details>
                <summary class="ms-1">{$vo.title}</summary>
                {:mulu($db, $book_id, $vo['id'], $router)}
            </details>
            {else}
            <svg t="1595425699202" class="icon" viewBox="0 0 1024 1024" version="1.1" xmlns="http://www.w3.org/2000/svg" p-id="4212" width="20" height="20">
                <path d="M288 320h448a32 32 0 0 0 0-64H288a32 32 0 0 0 0 64zM288 544h448a32 32 0 0 0 0-64H288a32 32 0 0 0 0 64zM544 704H288a32 32 0 0 0 0 64h256a32 32 0 0 0 0-64z" p-id="4213" fill="#aaa"></path>
                <path d="M896 132.928C896 77.28 851.552 32 796.928 32H227.04C172.448 32 128 77.28 128 132.928v758.144C128 946.72 172.448 992 227.04 992h435.008c1.568 0 2.912-0.672 4.416-0.896 8.96 1.6 18.464-0.256 25.984-6.528l192-160a31.424 31.424 0 0 0 10.816-27.2c0.16-1.184 0.736-2.208 0.736-3.424V132.928zM192 891.072V132.928C192 112.576 207.712 96 227.04 96h569.888C816.288 96 832 112.576 832 132.928V736h-96a96 96 0 0 0-96 96v96H227.04C207.712 928 192 911.424 192 891.072zM814.016 800L704 891.68V832a32 32 0 0 1 32-32h78.016z" p-id="4214" fill="#aaa"></path>
            </svg>
            <a href="{echo $router->build('/ebcms/book-web/post', ['book_id'=>$vo['book_id'], 'id'=>$vo['id']])}" data-postid="{$vo.id}" class="text-secondary">{$vo.title}</a>
            {/if}
        </li>
        {/foreach}
        {else}
        <li class="text-muted">(空)</li>
        {/if}
    </ul>
    {/function}
    <div id="navbar" style="display:none;">
        {:mulu($db, $book['id'], 0, $router)}
    </div>
</div>