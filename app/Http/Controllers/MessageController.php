<?php

namespace App\Http\Controllers;

use App\constants\Constant;
use App\enum\Order;
use App\Http\Requests\messages\StoreMessageRequest;
use App\repositories\contracts\MessageRepositoryContract;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

use function PHPUnit\Framework\isEmpty;

class MessageController extends Controller
{
    public function __construct(private MessageRepositoryContract $MessageRepository) { }
    public function index(Request $request)
    {
        $requestOrder = $request->get('order_by') ;

        $orderBy= null;
        if($requestOrder){
            $requestOrder == 'latest'
                ? session()->put(constant::$SESSION_MESSAGE_ORDER, Order::DESC)
                : session()->put(constant::$SESSION_MESSAGE_ORDER, Order::ASC);
        }

        $messages= $this->MessageRepository->all(session(Constant::$SESSION_MESSAGE_ORDER, Order::ASC) );
        return view('messages.index', [
            'messages'=>$messages ,
            'storagePath' => Constant::$FILES_UPLOADED_PATH,
            'currentUser' => Auth::user(),
            'isAdmin' => Auth::user() && Auth::user()->is_admin,
            'orderByLatest' => session(Constant::$SESSION_MESSAGE_ORDER, Order::ASC) == Order::DESC ? true: false,
        ]);
    }

    public function create()
    {
        return 'create';
    }

    public function store(StoreMessageRequest $request)
    {
        //is there file attached
        $file = $request->file('file');
        $storedFileName=null;
        if($file){
            $fileName = "image_.".$file->extension();
            $storedFileName = Storage::disk('public')->putFile("message_file_uploaded", $file);
        }
        //store in db
        $id =  $this->MessageRepository->store(
            title:$request->title ,
            message:$request->message ,
            file:$storedFileName ? basename($storedFileName):null,
            user_id:Auth::id(),
            parent_id:$request->parent_id
        );

        session()->flash('success', 'Message has been sent successfuly' );
        return back();
    }

    public function show(string $id)
    {
        $message = $this->MessageRepository->showWithReply($id);
        if($message){
            return view('messages.show',[
                'message' => $message,
                'storagePath' => Constant::$FILES_UPLOADED_PATH,
                'currentUser' => Auth::user(),
                'isAdmin' => Auth::user() && Auth::user()->is_admin
            ]);
        }
        return back()->with('error', 'Message not found' );
    }

    public function edit(string $id)
    {
        $message = $this->MessageRepository->show($id);
        return view('messages.edit', [
            'message' => $message,
            'storagePath' => Constant::$FILES_UPLOADED_PATH,
        ]);
    }

    public function update(Request $request, string $id)
    {
        //need to change/Remove the file from storage ***
        return 'update';
    }

    public function destroy(Request $request , string $id)
    {
        if(Auth::check()){
            $deleted = Auth::user()->is_admin
                ? $deleted = $this->MessageRepository->destroy($id)
                : $deleted = $this->MessageRepository->destroyWithUser($id , Auth::id());
            //file details
            $fileName= $deleted['fileName'];
            $filePath = Constant::$MESSAGE_IMAGE_DIR.DIRECTORY_SEPARATOR.$fileName;
            //delete if found
            !empty($fileName) ? Storage::disk('public')->delete($filePath): null;
            //
        // dd($request->is_parent_deleted == 1);
            return ( $request->is_parent_deleted
                ? redirect(route('message.index'))
                : back() )
                ->with('success', 'Message has been deleted successfuly' );
        }
        return redirect(route('message.index'))->with('error', 'You are not authorized to delete this message' );
    }
}

