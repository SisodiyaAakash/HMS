<?php

    $GLOBALS['PROJECT_ROOT'] = realpath($_SERVER["DOCUMENT_ROOT"]);

    $PROJECT_ROOT = $GLOBALS['PROJECT_ROOT'];

    $CAROUSEL_ROUTE_DIR_REL = 'uploads/carousel/';
    $CAROUSEL_ROUTE_DIR = $PROJECT_ROOT.'/uploads/carousel/';

    $PROFILE_IMG_UPLOAD_DIR = $PROJECT_ROOT.'/uploads/profile/';
    $ID_PROOF_UPLOAD_DIR = $PROJECT_ROOT.'/uploads/docs/';

    $MEMBER_PHOTO_UPLOAD_DIR_REL = 'uploads/members/';
    $MEMBER_PHOTO_UPLOAD_DIR = $PROJECT_ROOT.'/uploads/members/';

    $PLACES_THUMB_DIR_REL = 'uploads/place_thumb/';
    $PLACES_THUMB_DIR = $PROJECT_ROOT.'/uploads/place_thumb/';

    $PLACES_PHOTO_DIR_REL = 'uploads/places/';
    $PLACES_PHOTO_DIR = $PROJECT_ROOT.'/uploads/places/';

    $EVENT_PHOTO_UPLOAD_DIR_REL = "uploads/events/";
    $EVENT_PHOTO_UPLOAD_DIR = $PROJECT_ROOT."/uploads/events/";

    $BROCHURE_FILE_UPLOAD_DIR_REL = "uploads/brochures/";
    $BROCHURE_FILE_UPLOAD_DIR = $PROJECT_ROOT."/uploads/brochures/";

?>