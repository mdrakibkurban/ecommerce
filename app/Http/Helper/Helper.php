<?php

function success_response($message = '', $code = 200){
    return response()->json([
        'success' => true,
        'message' => $message
  ],$code);
}

function errors_response($message = '', $code = 400){
    return response()->json([
        'success' => false,
        'message' => $message
  ],$code);
}

