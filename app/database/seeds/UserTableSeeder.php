<?php

    /**
     * Created by Elmar <aka Ramires> Abdurayimov <e.abdurayimov@gmail.com>
     * @copyright (C)Copyright 2014 eatech.org
     * Date: 12/13/14
     * Time: 12:36 AM
     */
    class UserTableSeeder extends Seeder
    {

        public function run ()
        {
            DB::table('roles')->delete();
            DB::table('users')->delete();

            $roles = array(
                'admin'     => 'Administrator',
                'manager'   => 'Project Manager',
                'developer' => 'Developer',
            );

            $users = array(
                array(
                    'first_name' => 'John',
                    'last_name'  => 'Doe',
                    'username'   => 'admin',
                    'email'      => 'e.abdurayimov+1@gmail.com',
                    'password'   => Hash::make('admin'),
                    'active'     => 1,
                    'role'       => 1,
                ),
                array(
                    'first_name' => 'John',
                    'last_name'  => 'Doe',
                    'username'   => 'manager',
                    'email'      => 'e.abdurayimov+2@gmail.com',
                    'password'   => Hash::make('manager'),
                    'active'     => 1,
                    'role'       => 2,
                )
            );

            $roleModels = array();
            foreach ($roles as $slug => $title) {
                $role         = new Role;
                $role->name   = $title;
                $role->slug   = $slug;
                $roleModels[] = $role->save();
            }

            foreach ($users as $user) {
                $userModel             = new User;
                $userModel->first_name = $user['first_name'];
                $userModel->last_name  = $user['last_name'];
                $userModel->username   = $user['username'];
                $userModel->email      = $user['email'];
                $userModel->password   = $user['password'];
                $userModel->active     = $user['active'];
                $userModel->role_id    = $user['role'];
                $userModel->save();
            }

//            $table = require(app_path() . '/database/seeds/wp_users.php');
//            foreach ($table as $row) {
//                DB::table('wp_users2')->insert($row);
//            }

            $wpUsers = DB::table('wp_users')->get();
            foreach ($wpUsers as $wpUser) {
                if (in_array($wpUser->user_login, array('pm', 'admin', 'm4a1fox'))) {
                    continue;
                }

                $display_name = explode(' ', $wpUser->display_name);

                $userModel             = new User;
                $userModel->wp_id      = $wpUser->ID;
                $userModel->first_name = $display_name[0];
                $userModel->last_name  = empty($display_name[1]) ? 'Doe' : $display_name[1];
                $userModel->username   = $wpUser->user_login;
                $userModel->email      = $wpUser->user_email;
                $userModel->password   = Hash::make('temp');
                $userModel->active     = 0;
                $userModel->role_id    = 3;
                $userModel->created_at = $wpUser->user_registered;
                $userModel->updated_at = $wpUser->user_registered;
                $userModel->save();
            }
        }
    }
