<?php

declare(strict_types=1);

namespace App\Ebcms\BookWeb\Http;

use App\Ebcms\Web\Http\Common;
use DiggPHP\Database\Db;
use DiggPHP\Framework\Config;
use DiggPHP\Request\Request;
use DiggPHP\Template\Template;

class Search extends Common
{

    public function get(
        Config $config,
        Request $request,
        Db $db,
        Template $template
    ) {

        if (!$book = $db->get('ebcms_book_book', '*', [
            'id' => $request->get('book_id'),
            'state' => 1,
        ])) {
            return $this->error('页面不存在~');
        }

        $q = $request->get('q', '', ['trim']);
        if (strlen($q) < 2) {
            return $this->error('请输入关键词！');
        }

        $posts = $db->select('ebcms_book_post', '*',  [
            'book_id' => $book['id'],
            'type' => 2,
            'state' => 1,
            'OR' => [
                'title[~]' => $q,
                'keywords[~]' => $q,
                'description[~]' => $q,
                'body[~]' => $q,
            ],
        ]);

        $html = $template->renderFromFile('search@ebcms/book-web', [
            'posts' => $posts,
            'book' => $book,
            'meta' => [
                'title' => '搜索 - ' . $config->get('site.name@ebcms.web'),
                'keywords' => $request->get('q'),
                'description' => $request->get('q'),
            ],
        ]);
        return $this->html($html);
    }
}
