<?php
require_once(FRAMEWORK_PATH."system/user/CMSUser.php");

class userController
{
    public static function subscribe2rss()
    {
        $email = Request::getString('email',"POST");
        if ($email!=''){
            if(CMSUser::isEmailNotUsed($email))
                $query = "INSERT INTO fe_Users (email, isSubscriber) VALUES ('$email', 1)";
            else
                $query = "UPDATE fe_Users SET isSubscriber = 1 WHERE email = '$email'";
            Context::DB()->query($query);
            $response['success'] = true;
        }else{
            $response['success'] = false;
        }
        return $response;
    }

}
