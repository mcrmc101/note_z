<?php namespace Mcrmc\Notez\Controllers;

use BackendMenu;
use Backend\Classes\Controller;
use RainLab\User\Models\User;
use Illuminate\Http\Request;
use Validator;
use ValidationException;
use Input;
use Auth;
use JWTAuth;

/**
 * Route Control Back-end Controller
 */
class RouteControl extends Controller
{
    /**
     * @var array Behaviors that are implemented by this controller.
     */
    public $implement = [
        'Backend.Behaviors.FormController',
        'Backend.Behaviors.ListController'
    ];

    /**
     * @var string Configuration file for the `FormController` behavior.
     */
    public $formConfig = 'config_form.yaml';

    /**
     * @var string Configuration file for the `ListController` behavior.
     */
    public $listConfig = 'config_list.yaml';

    public function __construct()
    {
        parent::__construct();

        BackendMenu::setContext('Mcrmc.Notez', 'notez', 'routecontrol');
    }

    public function testUser(){
        return 'Testing RouteControl';
    }

    ##check if isUser using $req from vue
    ##notused use jwtauth plugin instead

    public function isUser(Request $req){
        $userid = $req->userid;
        
        if(Auth::check($userid) === true){
            return true;
        }
        else{
            return false;
        }
    }

    ##login user uing $req from vue
     ##notused use jwtauth plugin instead
    public function loginUser(Request $req){
        $user = Auth::authenticate([
            'login' => $req->login,
            'password' => $req->password
        ]);
        if($user){
            return 'UserLoggedin!';
        }
        else{
            return 'UserNotLoggedIn';
        }
    }

// somewhere in your controller
    public function getAuthenticatedUser()
    {
        try {

            if (! $user = JWTAuth::parseToken()->authenticate()) {
                return response()->json(['user_not_found'], 404);
            }

        } catch (Tymon\JWTAuth\Exceptions\TokenExpiredException $e) {

            return response()->json(['token_expired'], $e->getStatusCode());

        } catch (Tymon\JWTAuth\Exceptions\TokenInvalidException $e) {

            return response()->json(['token_invalid'], $e->getStatusCode());

        } catch (Tymon\JWTAuth\Exceptions\JWTException $e) {

            return response()->json(['token_absent'], $e->getStatusCode());

        }

        // the token is valid and we have found the user via the sub claim
        return response()->json(compact('user'));
    }

    public function getNotes(){
        $user = JWTAuth::parseToken()->authenticate();
        return $user;
    }
}
