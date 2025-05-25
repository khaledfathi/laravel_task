<?php

namespace  App\constants;

class Constant {
    //file names
    public static $DEFAULT_USER_IMAGE_NAME = "default_user_image.svg";

    //Paths
    public  static $FILES_UPLOADED_PATH = "storage".DIRECTORY_SEPARATOR."message_file_uploaded".DIRECTORY_SEPARATOR;
    public static $MESSAGE_IMAGE_DIR = "message_file_uploaded";

    //session
    public static $SESSION_MESSAGE_ORDER= "order";
}
