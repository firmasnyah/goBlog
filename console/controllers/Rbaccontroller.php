<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace console\controllers;

use Yii;
use yii\console\Controller;

class RbacController extends Controller
{
    public function actionInit()
    {
        $auth = Yii::$app->authManager;
        /**
         * Permissions
         */
        //create and add "createPost" permission
        $createPost = $auth->createPermission ('createPost');
        $createPost->description= 'User can create a post';
        $auth->add($createPost);
        
        //create and add "updatePost" permission
        $updatePost = $auth->createPermission('updatePost');
        $updatePost->description ='User can update post';
        $auth->add($updatePost);
        
        /**
         * Roles
         */
        
        //create and add "user' role
        $user = $auth->createRole ('user');
        $auth->add($user);
        
        $author = $auth->createRole('author');
        $auth->add($author);
        
        $admin = $auth->createRole('admin');
        $auth->add($admin);
        
        /**
         * 
         */
        
        $auth->addChild($author, $createPost);
        
        $auth->addChild($admin,$author);
        
        $auth->addChild($admin,$updatePost);
    }
    
//    public function actionCreateAuthorRule()
//    {
//        $auth = Yii::$app->authManager;
//        $rule = new \console\rbac\AuthorRule();
//        $auth ->add($rule);
//        
//        $updateOwnPost = $auth->createPermission ('updateOwnPost');
//    }
//}
}