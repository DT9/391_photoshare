<?php 
// If we know we don't need to change anything in the
// session, we can just read and close rightaway to avoid
// locking the session file and blocking other pages
# then at the very end of the script:
# session debugging
    session_start();

    session_destroy();

print_r($_SESSION);
?>
