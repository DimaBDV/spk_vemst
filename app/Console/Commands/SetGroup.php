<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class SetGroup extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'user:setGroup';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Установить пользователю группу';

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
        $users = $this->getAllUser();


        $this->info('Cписок всех пользователей');
        foreach ($users as $user){
           $this->comment('id = ' . $user->id . ' | name = ' . $user->name . ' | fathers_name = ' . $user->fathers_name . ' | email = ' . $user->email . ' | group = ' . $user->group);
        }

        $id = $this->ask('Укажите ID пользователя которого требуется сделать администратором');

        $this->comment('A - admin');
        $this->comment('U - user');

        $group = $this->ask('Укажите группу пользователя которую требуется установить пользователю');

        $this->setAdmin($id, $group);


    }

    protected function getAllUser(){
        return \App\User::select('id', 'name', 'fathers_name', 'email', 'group')->get();
    }

    protected function setAdmin($id, $group){
        $user = \App\User::find($id);
        $user->group = $group;
        $user->save();

        $this->info('Текущий статус пользователя.');
        $this->comment('id = ' . $user->id . ' | email = ' . $user->email . ' | group = ' . $user->group);
    }
}
