<?php

declare(strict_types=1);

namespace App\Ebcms\BookWeb;

use App\Ebcms\BookWeb\Http\Book;
use App\Ebcms\BookWeb\Http\Post;
use App\Ebcms\BookWeb\Http\Search;
use DiggPHP\Database\Db;
use DiggPHP\Framework\AppInterface;
use DiggPHP\Framework\Framework;
use Psr\SimpleCache\CacheInterface;

class App implements AppInterface
{
    public static function onDispatch(
        Db $db,
        CacheInterface $cache
    ) {
        if (defined('EBCMS_BOOK_WEB_ROUTE')) {
            return;
        }
        if (!$books = $cache->get('ebcms.book.books')) {
            $books = $db->select('ebcms_book_book', '*');
            $cache->set('ebcms.book.books', $books, 3600);
        }
        foreach ($books as $book) {
            Framework::get('/book/' . $book['name'] . '/_search', Search::class,  [], [
                'book_id' => $book['id']
            ], '/ebcms/book-web/search');
            Framework::get('/book/' . $book['name'], Book::class, [], [
                'book_id' => $book['id']
            ], '/ebcms/book-web/book');
            Framework::get('/book/' . $book['name'] . '/{id}', Post::class,  [], [
                'book_id' => $book['id']
            ], '/ebcms/book-web/post');
        }
    }
}
