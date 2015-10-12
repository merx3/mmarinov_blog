@extends('layouts.admin_master')

@section('content')
    <div class="main_container">

        @include('partials.admin.sidebar')

        @include('partials.admin.top_nav')

        <div class="right_col" role="main">

            <div class="col-ls-12">
                <div class="x_panel">
                    <div class="x_title">
                        <h2>Articles</h2>
                        <a href="{{ route('admin.articles.create') }}" class="btn btn-success pull-right">New Article</a>
                        <div class="clearfix"></div>
                    </div>
                    <div class="x_content">
                        <table class="table table-hover">
                            <colgroup>
                                <col span="1" style="width: 2%;">
                                <col span="1" style="width: 15%;">
                                <col span="1" style="width: 55%;">
                                <col span="1" style="width: 6%;">
                                <col span="1" style="width: 5%;">
                                <col span="1" style="width: 7%;">
                                <col span="1" style="width: 4%;">
                            </colgroup>
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>Title</th>
                                <th>Description</th>
                                <th>Author</th>
                                <th>Views</th>
                                <th>Created</th>
                                <th>Published</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach ($articles as $article)
                                <tr>
                                    <th scope="row"><a href="{!! route('admin.articles.edit', $article->id) !!}" class="underlined">{{ $article->id }}</a></th>
                                    <td>{{ $article->title }}</td>
                                    <td>{{ $article->description }}</td>
                                    <td>{{ $article->author->name }}</td>
                                    <td>{{ $article->views_count }}</td>
                                    <td>{{ $article->created_at->format('d/m/Y') }}</td>
                                    <td>
                                        @if($article->is_published)
                                            <i class="fa fa-check"></i>
                                        @else
                                            <i class="fa fa-times"></i>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                            <tfoot>
                                <tr>
                                    <td colspan="7">
                                    {!! $articles->render() !!}
                                    </td>
                                </tr>
                            </tfoot>

                        </table>

                    </div>
                </div>
            </div>

        </div>
    </div>
@stop