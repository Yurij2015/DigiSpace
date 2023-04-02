<?php

namespace App\Http\Controllers;

use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;

class BlogController extends Controller
{
    public function index(): Application|Factory|View
    {
        return view('blog.index', ['sideBarData' => $this->sideBarData()]);
    }

    public function show(string $slug)
    {
        return view('blog.post_show', ['slug' => $slug, 'sideBarData' => $this->sideBarData()]);
    }

    private function sideBarData(): array
    {
        return [
            'categories' => [
                ['name' => 'All categories', 'count' => 64, 'url' => 'categories'],
                ['name' => 'Software', 'count' => 23, 'url' => 'category/software'],
                ['name' => 'Development', 'count' => 10, 'url' => 'category/development'],
                ['name' => 'Programming', 'count' => 10, 'url' => 'category/programming']
            ],
            'latestPosts' => [
                [
                    'day' => '24',
                    'month' => 'may',
                    'year' => 2023,
                    'title' => 'Startup Software Development',
                    'url' => 'startup-software-development'
                ],
                [
                    'day' => '13',
                    'month' => 'may',
                    'year' => 2023,
                    'title' => 'Hybrid Cloud Management Software Solutions',
                    'url' => 'hybrid-cloud-management-software-solutions'
                ],
                [
                    'day' => '03',
                    'month' => 'may',
                    'year' => 2023,
                    'title' => 'Creating Better Software Through Design Thinking',
                    'url' => 'creating-better-software-through-design-thinking'
                ]
            ],
            'archive' => [
                ['id' => 1, 'url' => 'august-2022', 'monthYear' => 'August 2022'],
                ['id' => 2, 'url' => 'july-2022', 'monthYear' => 'July 2022'],
                ['id' => 3, 'url' => 'june-2022', 'monthYear' => 'June 2022'],
                ['id' => 4, 'url' => 'may-2022', 'monthYear' => 'May 2022'],
                ['id' => 5, 'url' => 'april-2022', 'monthYear' => 'April 2022'],
                ['id' => 6, 'url' => 'march-2022', 'monthYear' => 'March 2022']
            ]
        ];
    }
}
