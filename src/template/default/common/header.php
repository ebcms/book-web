<!DOCTYPE html>
<html lang="zh-CN">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{$meta['title']??''} | Powered by EBCMS</title>
    <meta name="keywords" content="{$meta['keywords']??''}" />
    <meta name="description" content="{$meta['description']??''}" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1/dist/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1/dist/js/bootstrap.bundle.min.js"></script>
    <style>
        a {
            text-decoration: none;
        }

        .breadcrumb {
            color: #6c757d;
        }

        .breadcrumb a {
            color: #6c757d;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="my-3">
            <a href="{echo $router->build('/ebcms/book-web/book', ['book_id'=>$book['id']])}" class="fs-1 font-weight-bold"><span class="me-1">📔</span>{$book.title}</a>
        </div>
    </div>

    <script src="https://cdn.bootcdn.net/ajax/libs/highlight.js/10.1.1/highlight.min.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/highlight.js@10.1.2/styles/vs.css">
    <script>
        $(function() {
            $(".content table").addClass("table");
            $(".content a").addClass("px-2").append(' <svg t="1595730969467" class="icon" viewBox="0 0 1024 1024" version="1.1" xmlns="http://www.w3.org/2000/svg" p-id="3841" width="15" height="15"><path d="M719.168 207.168L576 64h384v384l-150.272-150.272-264.128 264.064-90.496-90.496 264.064-264.128zM192 960H64V64h384v128H192v640h640V576h128v384H192z" fill="#007bff" p-id="3842"></path></svg>').attr('target', '_blank');
            $.each($(".content code"), function(index, ele) {
                if ($(ele).parents("pre").length == 0) {
                    $(ele).addClass("mx-1");
                }
            });
            $("#navbar").show();
        });
        hljs.initHighlightingOnLoad();
    </script>
    <style>
        a {
            text-decoration: none;
        }

        .content pre>code {
            padding: 15px !important;
            background: #f6f8fa !important;
        }

        .content img {
            max-width: 100%;
        }
    </style>