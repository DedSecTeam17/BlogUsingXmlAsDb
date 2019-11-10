<?php
    /**
     * Created by PhpStorm.
     * User: Mohammed Elamin
     * Date: 01/12/2018
     * Time: 12:05
     */

    require  'config/XmlProvider.php';

    class AuthController extends Controller
    {


        public function __construct()
        {
            Parent::__construct('User');

        }


        function getLogin($param=false)
        {
            echo  print_r($param);
            return $this->view->render('auth.login');
        }


        function getRegister()
        {

            return $this->view->render('auth.register');
        }

        function loginStore($args = false)
        {
//
            $user = new User();
            $user->setEmail($this->getPostRequestData('email'));
            $user->setPassword($this->getPostRequestData('password'));
            $user_id= $this->model->login($user)->getId();
            if ($user_id<=0) {
                echo 'error';
                return Route::redirectTo(
                    Route::to('getLogin','AuthController',null,false));
            } else {
                $user->setId($user_id);
                Auth::getInstance()->authenticateNewUser($user);
                return Route::redirectTo(
                    Route::to('index','PhoneController',null,false));
            }




        }

        function registerStore()
        {
            $user = new User();
            $user->setEmail($this->getPostRequestData('email'));
            $user->setFullName($this->getPostRequestData('name'));
            $user->setPassword(Hash::passwordHashing($this->getPostRequestData('password')));
           if ($user->save($user)) {
                   return Route::redirectTo(
                       Route::to('getLogin','AuthController',null,false));


           }else{

               return Route::redirectTo(
                   Route::to('getLogin','AuthController','email already used',true));           }





        }


        public function getLogOut()
        {
            Auth::getInstance()->logout();
            return Route::redirectTo(
                Route::to('index', 'PhoneController', null, false));

        }


    }

