<?php
function isMarkedForDelete(){
    return ( isset( $_POST['action'] ) and $_POST['action'] == "delete" );
}

