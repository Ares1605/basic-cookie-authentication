<?php

require_once 'SessionManager.php';

(new SessionManager())->validate_session();
SessionManager::valid_session();
