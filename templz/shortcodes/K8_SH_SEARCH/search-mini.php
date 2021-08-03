<?php
if ($search_title) {
    echo '<p>' .  __($search_title, 'generatepress') . '</p>'; // WPCS: XSS OK.
}
get_search_form();
?>