<?php

declare(strict_types=1);

namespace App\Ebcms\BookWeb\Http;

use App\Ebcms\Web\Http\Common;
use DiggPHP\Database\Db;
use DiggPHP\Framework\Config;
use DiggPHP\Request\Request;
use DiggPHP\Template\Template;
use Parsedown;

class Post extends Common
{

    public function get(
        Request $request,
        Template $template,
        Parsedown $parsedown,
        Config $config,
        Db $db
    ) {
        if (!$post = $db->get('ebcms_book_post', '*', [
            'book_id' => $request->get('book_id'),
            'state' => 1,
            'type' => 2,
            'id' => $request->get('id'),
        ])) {
            return $this->error('页面不存在~');
        }

        if (!$book = $db->get('ebcms_book_book', '*', [
            'state' => 1,
            'id' => $post['book_id'],
        ])) {
            return $this->error('页面不存在~');
        }

        $parsedown->setMarkupEscaped($config->get('markdown.escaped@ebcms.book-web', false));
        $post['body'] = $parsedown->text($post['body']);

        return $this->html($template->renderFromFile(($book['tpl_post'] ?: '/post') . '@ebcms/book-web', [
            'post' => $post,
            'book' => $book,
            'meta' => [
                'title' => $post['title'] . ' - ' . $book['title'],
                'keywords' => $post['keywords'],
                'description' => $post['description'],
            ],
        ]));
    }
}
