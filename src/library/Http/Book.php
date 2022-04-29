<?php

declare(strict_types=1);

namespace App\Ebcms\BookWeb\Http;

use App\Ebcms\Web\Http\Common;
use DiggPHP\Database\Db;
use DiggPHP\Request\Request;
use DiggPHP\Template\Template;
use Parsedown;

class Book extends Common
{
    public function get(
        Request $request,
        Template $template,
        Parsedown $parsedown,
        Db $db
    ) {
        if (!$book = $db->get('ebcms_book_book', '*', [
            'state' => 1,
            'id' => $request->get('book_id'),
        ])) {
            return $this->error('页面不存在~');
        }

        $parsedown->setMarkupEscaped(true);
        $book['body'] = $parsedown->text($book['body']);

        return $this->html($template->renderFromFile(($book['tpl_book'] ?: '/book') . '@ebcms/book-web', [
            'book' => $book,
            'meta' => [
                'title' => $book['title'],
                'keywords' => $book['keywords'],
                'description' => $book['description'],
            ],
        ]));
    }
}
