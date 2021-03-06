<?php

namespace App\Http\Controllers\Admin;

use App\User;
use Illuminate\Http\Request;

class IndexController extends AdminController
{
    public function show()
    {
        $this->title = trans('admin.admin');
        $this->breadcrumb = 'admin.index';
        $users = User::all();
        $this->content = view('admin.main')->with(compact('users'))->render();
        return $this->renderOutput();
    }
}
