<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Gate;
use Menu;

class AdminController extends Controller
{
    protected $template = 'admin.index';
    protected $content = false;
    protected $title;
    protected $vars;

    public function renderOutput()
    {
        $this->vars = array_add($this->vars, 'title', $this->title);

        $this->vars = array_add($this->vars, 'nav', $this->getMenu());

        $this->vars = array_add($this->vars, 'content', $this->content);

        return view($this->template)->with($this->vars);
    }

    /**
     * @return string
     * @throws \Throwable
     */
    public function getMenu()
    {
        $menu =  Menu::make('adminMenu', function ($menu) {

            if (Gate::allows('USERS_ADMIN')) {
                $menu->add('Пользователи', array('route' => 'home', 'class' => 'users'));
            }


            if (Gate::allows('VIEW_ADMIN')) {
                $menu->add('Главная', array('route' => 'home', 'class' => 'users'));
            }

        });

        return view('admin.navigation')->with('menu', $menu)->render();
    }
}
