<?php

namespace Modules\User\Http\Controllers\Admin;

use App\Models\User;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Modules\User\Entities\UserInfo;

class IndexController extends AdminController
{
    protected $title = '用户管理';

    public function grid(): Grid
    {
        $grid = new Grid(new User);

        $grid->actions(function ($actions) {
            $actions->disableDelete();
            $actions->disableView();
        });

        $grid->filter(function (Grid\Filter $filter) {
            $filter->column(1 / 2, function (Grid\Filter $filter) {
                $filter->like('username', '用户名');
            });

            $filter->column(1 / 2, function (Grid\Filter $filter) {
                $filter->like('info.nickname', '昵称');
            });
        });
        $grid->model()->orderBy('created_at', 'desc');
        $grid->column('id', 'ID');
        $grid->column('info.cover', '头像')->image('', 100, 100);
        $grid->column('username', '用户名');
        $grid->column('info.nickname', '昵称');
        $grid->column('created_at', '注册时间');

        return $grid;
    }

    public function form(): Form
    {
        $form = new Form(new User);

        $form->text('username', '手机号')->required();
        $form->password('password', '密码')->required();
        $form->text('info.nickname', '昵称')->required();
        $form->radioButton('info.gender', '性别')->options(UserInfo::GENDERS)->default(0);
        $form->image('info.cover', '用户头像')
            ->move('images/avatar/' . date('Y/m/d'))
            ->removable()
            ->uniqueName();

        return $form;
    }
}
