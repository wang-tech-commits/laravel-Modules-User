<?php

namespace Modules\User\Console;

use Illuminate\Console\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputOption;

class InstallCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'modules:install-user';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = '安装模块化User';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $this->createAdminMenu();
    }

    /**
     * Get the console command arguments.
     *
     * @return array
     */
    protected function getArguments()
    {
        return [
            ['example', InputArgument::REQUIRED, 'An example argument.'],
        ];
    }

    /**
     * Get the console command options.
     *
     * @return array
     */
    protected function getOptions()
    {
        return [
            ['example', null, InputOption::VALUE_OPTIONAL, 'An example option.', null],
        ];
    }

    /**
     * 创建后台操作菜单栏
     * @Author:<Mr.Wang>
     * @Date:2021-04-13
     * @return [type] [description]
     */
    protected function createAdminMenu()
    {
        $menu = config('admin.database.menu_model');

        $main = $menu::create([
            'parent_id' => 0,
            'order'     => 0,
            'title'     => '用户管理',
            'icon'      => 'fa-users',
        ]);

        $main->children()->createMany([
            [
                'order' => 1,
                'title' => '用户列表',
                'icon'  => 'fa-user',
                'uri'   => 'users',
            ],
        ]);
    }
}
