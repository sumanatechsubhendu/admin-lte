<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Request;
use Inertia\Inertia;
use ProtoneMedia\LaravelQueryBuilderInertiaJs\InertiaTable;
use Spatie\QueryBuilder\AllowedFilter;
use Spatie\QueryBuilder\QueryBuilder;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //$users = User::latest()->paginate(10);
        $users = User::all();

        return Inertia::render('Admin/User/Index', ['users' => $users]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return Inertia::render('Post/Create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        Post::create(
            Request::validate([
                'title' => ['required', 'max:90'],
                'description' => ['required'],
            ])
        );

        return Redirect::route('posts.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        return Inertia::render('Post/Edit', [
            'post' => [
                'id' => $post->id,
                'title' => $post->title,
                'description' => $post->description
            ]
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Post $post)
    {
        $data = Request::validate([
                'title' => ['required', 'max:90'],
                'description' => ['required'],
            ]);
        $post->update($data);


        return Redirect::route('posts.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        $post->delete();

        return Redirect::route('posts.index');
    }

    public function dataTable(Request $request)
    {
        $perPage = isset($_GET['perPage']) ? $_GET['perPage'] : 10;
        $globalSearch = AllowedFilter::callback('global', function ($query, $value) {
            $query->where(function ($query) use ($value) {
                Collection::wrap($value)->each(function ($value) use ($query) {
                    $query
                        ->orWhere('users.first_name', 'LIKE', "%{$value}%")
                        ->orWhere('roles.name', 'LIKE', "%{$value}%")
                        ->orWhere('users.email', 'LIKE', "%{$value}%");
                });
            });
        });
        $users = QueryBuilder::for(User::class)
        ->select(['users.id', 'users.first_name', 'users.email', 'users.created_at', 'roles.name']) // Select the desired columns
        ->addSelect(\DB::raw("DATE_FORMAT(users.created_at, '%Y-%m-%d') as formatted_created_at"))
        ->join('roles', 'users.role_id', '=', 'roles.id') // Join with roles table
        ->defaultSort('users.first_name')
        ->allowedSorts(['id', 'first_name', 'email', 'name'])
        ->allowedFilters(['first_name', 'email', $globalSearch])
        ->paginate($perPage)
        ->withQueryString();
        //dd($users);

        return Inertia::render('User/User-dt', ['users' => $users])->table(function (InertiaTable $table) {
            $table->column('id', 'ID', searchable: false, sortable: true);
            $table->column('first_name', 'User Name', searchable: true, sortable: true);
            $table->column('email', 'Email Address', searchable: true, sortable: true);
            $table->column('name', 'Role Name', searchable: false, sortable: true);
            $table->column('formatted_created_at', 'Join Date', searchable: false, sortable: false);
        });
    }
}
