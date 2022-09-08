<?php

function response($data, $status) {
    http_response_code($status);
    echo json_encode($data); die;
}