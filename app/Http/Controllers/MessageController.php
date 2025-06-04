<?php
namespace App\Http\Controllers;

use App\constants\Constant;
use App\enum\Order;
use App\Http\Requests\messages\StoreMessageRequest;
use App\Http\Requests\messages\UpdateMessageRequest;
use App\repositories\contracts\MessageRepositoryContract;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class MessageController extends Controller
{
    public function __construct(
        private MessageRepositoryContract $messageRepository
    ) {}
    public function index(Request $request)
    {
        $requestOrder = $request->get("order_by");

        $orderBy = null;
        if ($requestOrder) {
            $requestOrder == "latest"
                ? session()->put(Constant::$SESSION_MESSAGE_ORDER, Order::DESC)
                : session()->put(Constant::$SESSION_MESSAGE_ORDER, Order::ASC);
        }

        $messages = $this->messageRepository->all(
            session(Constant::$SESSION_MESSAGE_ORDER, Order::ASC)
        );
        return view("messages.index", [
            "messages" => $messages,
            "storagePath" => Constant::$FILES_UPLOADED_PATH,
            "defaultUserImage" => Constant::$DEFAULT_USER_IMAGE_NAME,
            "currentUser" => Auth::user(),
            "isAdmin" => Auth::user() && Auth::user()->is_admin,
            "orderByLatest" =>
                session(Constant::$SESSION_MESSAGE_ORDER, Order::ASC) ==
                Order::DESC
                    ? true
                    : false,
        ]);
    }

    public function create()
    {
        return "create";
    }

    public function store(StoreMessageRequest $request)
    {
        //is there file attached
        $file = $request->file("file");
        $storedFileName = null;
        if ($file) {
            $fileName = "image_." . $file->extension();
            $storedFileName = Storage::disk("public")->putFile(
                Constant::$MESSAGE_IMAGE_DIR,
                $file
            );
        }
        //store in db
        $id = $this->messageRepository->store(
            title: $request->title,
            message: $request->message,
            file: $storedFileName ? basename($storedFileName) : null,
            user_id: Auth::id(),
            parent_id: $request->parent_id
        );

        session()->flash("success", "Message has been sent successfuly");
        return back();
    }

    public function show(string $id)
    {
        $message = $this->messageRepository->showWithReply($id);
        if ($message) {
            return view("messages.show", [
                "message" => $message,
                "storagePath" => Constant::$FILES_UPLOADED_PATH,
                "defaultUserImage" => Constant::$DEFAULT_USER_IMAGE_NAME,
                "currentUser" => Auth::user(),
                "isAdmin" => Auth::user() && Auth::user()->is_admin,
            ]);
        }
        return back()->with("error", "Message not found");
    }

    public function edit(string $id)
    {
        $message = $this->messageRepository->show($id);
        return view("messages.edit", [
            "message" => $message,
            "storagePath" => Constant::$FILES_UPLOADED_PATH,
        ]);
    }

    public function update(UpdateMessageRequest $request, string $id)
    {
        $record = $this->messageRepository->show($id);
        $isThereOldFile = false;
        //handle file upload
        if ($record->file) {
            $isThereOldFile = true;
        }
        if ($request->delete_file) {
            //delete file
            $filePath =
                Constant::$MESSAGE_IMAGE_DIR .
                DIRECTORY_SEPARATOR .
                $record->file;
            Storage::disk("public")->delete($filePath);
            //update message file to null
            $isThereOldFile = false;
        }

        //update message
        $newFile = $request->file("file")
            ? basename(
                Storage::disk("public")->putFile(
                    Constant::$MESSAGE_IMAGE_DIR,
                    $request->file("file")
                )
            )
            : null;
        $this->messageRepository->update(
            id: $id,
            title: $request->title,
            message: $request->message,
            file: $newFile,
            nullableFile: !$isThereOldFile && !$newFile
        );

        //back to message page
        $backId = $request->parent_id ?? $id;
        return redirect(route("message.show", $backId))->with(
            "success",
            "Message has been updated successfuly"
        );
    }

    public function destroy(Request $request, string $id)
    {
        if (Auth::check()) {
            $deleted = Auth::user()->is_admin
                ? ($deleted = $this->messageRepository->destroy($id))
                : ($deleted = $this->messageRepository->destroyWithUser(
                    $id,
                    Auth::id()
                ));
            //file details
            $fileName = $deleted["fileName"];
            $filePath =
                Constant::$MESSAGE_IMAGE_DIR . DIRECTORY_SEPARATOR . $fileName;
            //delete if found
            !empty($fileName)
                ? Storage::disk("public")->delete($filePath)
                : null;
            //
            // dd($request->is_parent_deleted == 1);
            return ($request->is_parent_deleted
                ? redirect(route("message.index"))
                : back()
            )->with("success", "Message has been deleted successfuly");
        }
        return redirect(route("message.index"))->with(
            "error",
            "You are not authorized to delete this message"
        );
    }
}
