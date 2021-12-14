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
use Event;
use DateTime;
use Mail;
use Mcrmc\Notez\Models\Note;
use Mcrmc\Notez\Models\Account;

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

    //TODO!!!
        public function getAuthenticatedAccount()
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

    //Get Notes function quick
    public function getNotez(){
        $user = JWTAuth::parseToken()->authenticate();
        //TODO!!!
       // $acc = Account::where('userid',$user->id); 
        $notes = Note::select('created_at','id','cat','type')->where('userid','=',$user->id)->get();
        return json_encode($notes);
    }

    //get single note and decrypt

    public function getSelectedNote(Request $req){

        $user = JWTAuth::parseToken()->authenticate();
        
        $nid = $req->noteid;
        $note = Note::find($nid);
        $acc = Account::find($note->accid);
        //decrypting
        
        $ciphering = "AES-128-CTR";
        $encryption = $note->notez;
        $iv_length = openssl_cipher_iv_length($ciphering); 
        $options = 0;
        $decryption_iv = '1234567891011121'; 
        $encryption_iv = '1234567891011121';
// Store the decryption key 
        $decryption_key = $acc->pword;
        
        $decryption = openssl_decrypt ($encryption, $ciphering, 
        $decryption_key, $options, $encryption_iv);
        $narr = [
            'Category' => $note->cat,
            'Type' => $note->type,
            'Note' => $decryption
        ];
        //add unescaping
        return $narr;
    }

    //get acc number for user
    //not used
    public function getAcc(){
        $user = JWTAuth::parseToken()->authenticate();
        $acc = Account::where('userid','=',$user->id)->first();
        return $acc->id;
    }

    //get categories
    public function getCats(){
        $user = JWTAuth::parseToken()->authenticate();
        $acc = Account::where('userid','=',$user->id)->first();
        return $acc->cats;
    }

    public function testSave(Request $req){
        return $req;
    }

    public function saveNote(Request $req){
        $user = JWTAuth::parseToken()->authenticate();
        $acc = Account::where('userid','=',$user->id)->first();
        $accid = $acc->id;
        $note = new Note();
       

        $ciphering = "AES-128-CTR";
        $iv_length = openssl_cipher_iv_length($ciphering); 
        $options = 0; 
        //change for production
        $encryption_iv = '1234567891011121';
        //
        $encryption_key = $acc->pword;
        //add Escaping
        $encryption = openssl_encrypt($req->note, $ciphering, 
        $encryption_key, $options, $encryption_iv);
        $note->notez = $encryption;
        $note->userid = $user->id;
        $note->accid = $accid;
        $note->type = $req->type;
        $note->cat = $req->cat;
        $note->save();
        return 'Saved';
    }
}
