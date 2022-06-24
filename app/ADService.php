<?php

namespace App;

class ADService
{
    public static function AD_login( $username, $password )
    {
        /* 
        //For testing purpose
        $users[0]['givenName'][0]="Admin Ghi";
        $users[0]['mail'][0]="admin.ghi@test.com";
        //return json_encode(array('result'=>true,'user'=>$users[0]));
        return {"result":true,"user":{"cn":{"count":1,"0":"admin ghi"},"0":"cn","givenname":{"count":1,"0":"admin ghi"},"1":"givenname","mail":{"count":1,"0":"admin.ghi@llm.gov.my"},"2":"mail","count":3,"dn":"CN=admin ghi,CN=Users,DC=llmnet,DC=gov,DC=my"}};
        die();
        */

        $atrributes = array('cn', 'givenname', 'mail','telephoneNumber');
        $dn  = "CN=Users,".env('BASE_DN');
        $filter = "(&(sAMAccountName=".$username."))";
       
        $ldap_conn = @ldap_connect(env('AD_SERVER')); 
        if ($ldap_conn)
        {
            ldap_set_option($ldap_conn, LDAP_OPT_REFERRALS, 0);
            ldap_set_option($ldap_conn, LDAP_OPT_PROTOCOL_VERSION, 3);
            $b = @ldap_bind($ldap_conn, $username.env('AD_ACCOUNT_SUFFIX'), $password); 
            if($b)
            {

                $result = ldap_search($ldap_conn, $dn, $filter, $atrributes); 
                $users = ldap_get_entries($ldap_conn, $result);
                $rescount = ldap_count_entries($ldap_conn,$result);


                ldap_unbind($ldap_conn);
            
                if($rescount==1){ 
                    return json_encode(array('result'=>true, 'user'=>$users[0]));
                }else{
                    return json_encode(array('result'=>false, 'error'=>"Username is not exists on AD"));
                }
            }else{
                return json_encode(array('result'=>false, 'error'=>"Failed to bind with service account credentials."));
            }
        }else{
            return json_encode(array('result'=>false, 'error'=>"Couldn't connect to AD!"));
        }
    }

    public static function AD_Search( $username )
    {
        /*
        //For testing purpose
        $users[0]['givenName'][0]="Admin Ghi";
        $users[0]['mail'][0]="admin.ghi@test.com";
        //return json_encode(array('result'=>true,'user'=>$users[0]));
        return {"result":true,"user":{"cn":{"count":1,"0":"admin ghi"},"0":"cn","givenname":{"count":1,"0":"admin ghi"},"1":"givenname","mail":{"count":1,"0":"admin.ghi@llm.gov.my"},"2":"mail","count":3,"dn":"CN=admin ghi,CN=Users,DC=llmnet,DC=gov,DC=my"}};
        die();
        */

        $atrributes = array('cn', 'givenname', 'mail','telephoneNumber');
        $dn  = "CN=Users,".env('BASE_DN');
        $filter = "(&(sAMAccountName=".$username."))";
       
        $ldap_conn = @ldap_connect(env('AD_SERVER')); 
        if ($ldap_conn)
        {
            ldap_set_option($ldap_conn, LDAP_OPT_REFERRALS, 0);
            ldap_set_option($ldap_conn, LDAP_OPT_PROTOCOL_VERSION, 3);
            $b = @ldap_bind($ldap_conn, env('AD_USERNAME').env('AD_ACCOUNT_SUFFIX'), env('AD_PASSWORD')); 
            if($b)
            {

                $result = ldap_search($ldap_conn, $dn, $filter, $atrributes); 
                $users = ldap_get_entries($ldap_conn, $result);
                $rescount = ldap_count_entries($ldap_conn,$result); 
                
                ldap_unbind($ldap_conn);
            
                if($rescount==1){ 
                    return json_encode(array('result'=>true,'user'=>$users[0]));
                }else{
                    return json_encode(array('result'=>false, 'error'=>"Username is not exists on AD"));
                }
            }else{
                return json_encode(array('result'=>false, 'error'=>"Failed to bind with service account credentials."));
            }
        }else{
            return json_encode(array('result'=>false, 'error'=>"Couldn't connect to AD!"));
        }
    }
   
}
?>