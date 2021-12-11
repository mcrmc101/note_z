<?php namespace Mcrmc\Notez\Components;

use Cms\Classes\ComponentBase;
use Input;
use Validator;
use ValidationException;
use Redirect;
use Flash;
use Session;
use Auth;
use Event;
use DateTime;
use Mail;
use Mcrmc\Notez\Models\Note;
use Mcrmc\Notez\Models\Account;

class NoteForm extends ComponentBase
{
    public function componentDetails()
    {
        return [
            'name'        => 'NoteForm Component',
            'description' => 'No description provided yet...'
        ];
    }

    public function defineProperties()
    {
        return [];
    }

    public function onGoNotez(){
        return Redirect::to('notez');
    }

    public function onGoLogin(){
        return Redirect::to('login');
    }
    
    public function getAcc(){
        return Account::all();
    }
    
    public function getNote(){
        return Note::all();
    }
    
    public function onRenderHolder(){
        return ['#notediv' => $this->renderPartial('notez/holder')];
    }
    
    public function onRenderCatForm(){
        Redirect::to('notez');
        $this->page['uid'] = Input::get('uid');
        return ['#notediv' => $this->renderPartial('notez/cats')];
    }
    
    public function onRenderNoteForm(){
        Redirect::to('notez');
        $this->page['uid'] = Input::get('uid');
        return ['#notediv' => $this->renderPartial('notez/noteform')];
    }
    
    public function onRenderNoteList(){
        Redirect::to('notez');
        $this->page['uid'] = Input::get('uid');
        return ['#notediv' => $this->renderPartial('notez/notelist')];
    }

    public function onTextNote(){
        return ['#rendform' => $this->renderPartial('notez/textnote')];
    }

    public function onAudioNote(){
        return ['#rendform' => $this->renderPartial('notez/audionote')];
    }

    public function onImageNote(){
        return ['#rendform' => $this->renderPartial('notez/imagenote')];
    }
    
    public function onSetPass(){
        $aid = Input::get('aid');
        $acc = Account::find($aid);
        $acc->pword = e(Input::get('pwd'));
        $acc->haspass = 1;
        $acc->save();
        Flash::success('Password Saved');
        return Redirect::refresh();
    }
    
    public function onNewCat(){
        $aid = Input::get('aid');
        $acc = Account::find($aid);
        $cats = $acc->cats;
        if($cats == null){
            $cnt = 0;
            $cats = [];
        }
        else{
            $cats = json_decode($cats);
            $en = end($cats);
            $cnt = $en->cid;
        }
        $catname = Input::get('catname');
        $carr = [
            'cid' => ++$cnt,
            'cat' => $catname,
        ];
        array_push($cats,$carr);
        $acc->cats = json_encode($cats,false);
        $acc->save();
        Flash::success('Category Saved');
        return Redirect::refresh();
        
    }
    
    public function onNewNote(){
        $uid = Input::get('uid');
        $aid = Input::get('aid');
        $acc = Account::find($aid);
        $note = new Note();
        $note->userid = $uid;
        $note->accid = $aid;
        $note->type = e(Input::get('type'));
        $ncat = Input::get('ncat');
        $nt = e(Input::get('note'));
        $note->cat = $ncat;
        $ciphering = "AES-128-CTR";
        $iv_length = openssl_cipher_iv_length($ciphering); 
$options = 0; 
        $encryption_iv = '1234567891011121';
        $encryption_key = $acc->pword;
        
        $encryption = openssl_encrypt($nt, $ciphering, 
        $encryption_key, $options, $encryption_iv);
        
        
        
        
        $note->notez = $encryption;
        $note->save();
        Flash::success('Note Saved');
        return Redirect::refresh();
    }
    
    public function onDcryptNote(){
        
        $aid = Input::get('aid');
        $nid = Input::get('nid');
        $acc = Account::find($aid);
        $note = Note::find($nid);
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
        $this->page['dcr'] = $decryption;
        $this->page['type'] = $note->type;
        return ['#ddiv' => $this->renderPartial('notez/dcrypt')];
        
    }
    
    public function onDeleteNote(){
        $nid = Input::get('nid');
        $note = Note::find($nid);
        $note->delete();
        Flash::success('Note Deleted');
        return Redirect::refresh();
    }
    
        public function onDeleteCat(){
        $cid = Input::get('cid');
        $aid = Input::get('aid');
        $acc = Account::find($aid);
        $menu = json_decode($acc->cats);
        $cnt = 0;
        foreach($menu as $q){
            if($q->cid == $cid){
                
                unset($menu[$cnt]);
                if(count($menu) == 0){
                    $acc->cats = '';
                    $acc->save();
                    Flash::success('Category Deleted');
                    return Redirect::refresh();  
                }
                else{
                $menu = array_values($menu);
                $menu = json_encode($menu);
                $acc->cats = $menu;
                $acc->save();
                Flash::success('Category Deleted');
                return Redirect::refresh();
                }
            }
            $cnt++;
        }  
    }
    
}
